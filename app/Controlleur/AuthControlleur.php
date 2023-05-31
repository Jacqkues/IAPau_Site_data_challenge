<?php

namespace Controlleur;

use jmvc\Controlleur;
use jmvc\View;
use Model\Entites\User;
use Model\UserRepository;
use Lib\DatabaseConnection;
use Exception;



class AuthControlleur implements Controlleur
{

    public function login()
    {
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $userRepo = new UserRepository(new DatabaseConnection());
        $user = null;
        try {
            $user = $userRepo->findByEmail($email);
        } catch (Exception $e) {
            $error = "L'utilisateur n'existe pas";
            header('Location: /login?methode=connexion&error=' . $error);
            exit();
        }

        if ($user->getDateFin() < date("Y-m-d")) {
            try {
                $userRepo->deleteUser($user->getId());
            } catch (Exception $e) {
                echo $e;
            }
            $error = "L'utilisateur n'existe plus, le délai est dépassé.";
            header('Location: /login?methode=connexion&error=' . $error);
            exit();
        }

        if ($user != null) {
            if (password_verify($mdp, $user->getMdp())) {
                $_SESSION['user'] = $user;
                if ($user->getType() == "admin") {
                    header('Location: /admin');
                    exit();
                } else if ($user->getType() == "gestionnaire") {
                    header('Location: /gestionnaire');
                    exit();
                } else {
                    header('Location: /user');
                    exit();
                }
            } else {
                $error = "Mot de passe incorrect";
                header('Location: /login?methode=connexion&error=' . $error);
                exit();
            }
        }

    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: /');
        exit();
    }

    public function isAdmin(): bool
    {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if ($user->getType() == "admin") {
                return true;
            }
        }
        return false;
    }

    public function isLogged(): bool
    {
        if (isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }

    public function isCurrentUser($id): bool
    {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if ($user->getId() == $id) {
                return true;
            }
        }
        return false;
    }

    public function isGestionnaire(): bool
    {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if ($user->getType() == "gestionnaire") {
                return true;
            }
        }
        return false;
    }

    public function isAdminOrGestionnaire(): bool {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user']->getType() == "gestionnaire" || $_SESSION['user']->getType() == "admin";
        }
        return false;
    }

    public function register()
    {
        if (
            !(
                isset($_POST['nom'])
                && isset($_POST['prenom'])
                && isset($_POST['email'])
                && isset($_POST['mdp'])
                && isset($_POST['etablissement'])
                && isset($_POST['niv_etudes'])
            )
        ) {
            $error = "Veuillez remplir tous les champs";
            header("Location: /login?methode=inscription&error=" . $error);
            exit();
        }

        $userRepo = new UserRepository(new DatabaseConnection());
        foreach ($userRepo->getUsers() as $existing_user) {
            if (strtolower($existing_user->getMail()) == strtolower($_POST['email'])) {
                $error = "Cet utilisateur existe déjà.";
                header("Location: /login?methode=inscription&error=" . $error);
                exit();
            }
        }

        $user = new User();
        $user->setNom($_POST['nom']);
        $user->setPrenom($_POST['prenom']);
        $user->setMail($_POST['email']);
        $user->setMdp(password_hash($_POST['mdp'], PASSWORD_DEFAULT));
        $user->setEtablissement($_POST['etablissement']);
        $user->setNivEtude($_POST['niv_etudes']);
        $user->setDateDeb(date("Y-m-d"));
        $user->setDateFin(date("Y-m-d", strtotime("+5 year")));
        $user->setType("user");
        $user->setNumTel(0);

        $userRepo->addUser($user);

        $_SESSION['user'] = $userRepo->findByEmail($_POST['email']);

        header('Location: /user');
        exit();
    }


    public function index()
    {
        $loginPage = new View("./vue/components/signin-login/signin-login.php");
        $loginPage->show();
    }
}