<?php
spl_autoload_register(function ($class) {
    // Define the base directory for your classes
    $baseDir = __DIR__ . '/';

    // Convert namespace separators to directory separators
    $class = str_replace('\\', '/', $class);

    // Build the full path to the class file
    $file = $baseDir . $class . '.php';
    // If the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
//chargement des dépendances
use Controlleur\AuthControlleur;
use Controlleur\MainControlleur;
use Controlleur\AdminControlleur;
use Controlleur\GestionnaireControlleur;
use Controlleur\UserControlleur;
use jmvc\Router;
use jmvc\Route;
use jmvc\ProtectedRoute;
use jmvc\AuthGuard;

session_start();

//router de l'application
$router = new Router();



//nos controleurs
$mainControlleur = new MainControlleur();
$authController = new AuthControlleur();
$adminControlleur = new AdminControlleur();
$gestionnaireControlleur = new GestionnaireControlleur();
$userControlleur = new UserControlleur();

//gardes 
$adminGuard = new AuthGuard($authController,"isAdmin");
$gestionnaireGuard = new AuthGuard($authController,"isGestionnaire");
$userGuard = new AuthGuard($authController,"isLogged");

//les pages 
$loginPage = new Route("/login",$authController,"index");
$mainPage = new Route("/",$mainControlleur,"index");
$loginHandler = new Route("/trylogin",$authController,"login");
$loginHandler = new Route("/tryRegister",$authController,"register");
$logout = new Route("/logout",$authController,"logout");

//les pages protegees
$adminDashboard = new ProtectedRoute("/admin",$adminControlleur,"index",$adminGuard);
$gestionnaireDashboard = new ProtectedRoute("/gestionnaire",$gestionnaireControlleur,"index",$gestionnaireGuard);
$userPage = new ProtectedRoute("/user",$userControlleur,"index",$userGuard);
$deleteUser = new ProtectedRoute("/admin/deleteUser",$adminControlleur,"deleteUser",$adminGuard);
$addUser = new ProtectedRoute("/admin/addUser",$adminControlleur,"addUser",$adminGuard);
$updateUser = new ProtectedRoute("/admin/updateUser",$adminControlleur,"updateUser",$adminGuard);
//ajout des pages au router

$router->addRoute($loginPage);
$router->addRoute($mainPage);
$router->addRoute($loginHandler);
$router->addRoute($adminDashboard);
$router->addRoute($gestionnaireDashboard);
$router->addRoute($userPage);
$router->addRoute($logout);
$router->addRoute($deleteUser);
$router->addRoute($addUser);
$router->addRoute($updateUser);

echo "<script src='./index.js'></script>";
$router->handleRequest();


