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
            $loginPage = new View("./vue/components/login/login.php");
            $loginPage->assign("error", $error);
            $loginPage->show();
        }
        if ($user != null) {
            if (password_verify($mdp, $user->getMdp())) {
                $_SESSION['user'] = $user;
                return true;
            }
        }

    }

    public function logout()
    {
        unset($_SESSION['user']);
    }

    public function index()
    {
        if (isset($_SESSION['user'])) {
            header('Location: /');
            exit();
        }
        $loginPage = new View("./vue/components/login/login.php");
        $loginPage->show();

    }


}