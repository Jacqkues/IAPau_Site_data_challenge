<?php

namespace Controlleur;
use jmvc\Controlleur;
use jmvc\View;
use Model\User;
use Model\UserRepository;
use Lib\DatabaseConnection;

class AuthControlleur implements Controlleur{

    public function login(){
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $userRepo = new UserRepository(new DatabaseConnection());
        $user = $userRepo->findByEmail($email);
        if($user === null){
            $error = "L'utilisateur n'existe pas";
            require('./vue/Auth/login.php');
        }

        if(password_verify($mdp, $user->getMdp())){
            $_SESSION['user'] = $user;
            return true;
        }
    }

    public function logout(){
        unset($_SESSION['user']);
    }

    public function index() {
        if(isset($_SESSION['user'])){
            header('Location: /');
            exit();
        }
        $loginPage = new View("./vue/Auth/login.php");
        $loginPage->show();
        
    }


}