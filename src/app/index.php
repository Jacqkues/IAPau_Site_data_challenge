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

use Controlleur\AuthControlleur;
use Controlleur\MainControlleur;
use jmvc\Router;
use jmvc\Route;

//router de l'application
$router = new Router();


//nox controleurs
$mainControlleur = new MainControlleur();
$authController = new AuthControlleur();

//les pages 
$loginPage = new Route("/login",$authController,"index");
$mainPage = new Route("/",$mainControlleur,"index");
//ajout des pages au router
$router->addRoute($loginPage);
$router->addRoute($mainPage);


$router->handleRequest();


