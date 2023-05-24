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
            $loginPage = new View("./vue/components/signin-login/signin-login.php");
            $loginPage->assign("error", $error);
            $loginPage->show();
        }
        if ($user != null) {
            if(password_verify($mdp, $user->getMdp())){
                $_SESSION['user'] = $user;
                if($user->getType() == "admin"){
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
                $loginPage = new View("./vue/components/signin-login/signin-login.php");
                $loginPage->assign("error", $error);
                $loginPage->show();
            }
        }

    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: /');
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

    public function register()
    {
        if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['mdp']) && isset($_POST['etablissement']) && isset($_POST['niv_etudes'])) {
            $error = "Veuillez remplir tous les champs";
            $loginPage = new View("./vue/components/signin-login/signin-login.php");
            $loginPage->assign("error", $error);
            $loginPage->show();
        }

        $userRepo = new UserRepository(new DatabaseConnection());
        $user = new User($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['etablissement'], $_POST['niv_etudes']);
        $userRepo->addUser($user);
        $this->login();
    }


    public function index()
    {
        if (isset($_SESSION['user'])) {
            header('Location: /');
            exit();
        }
        $loginPage = new View("./vue/components/signin-login/signin-login.php");
        $loginPage->show();
    }
}