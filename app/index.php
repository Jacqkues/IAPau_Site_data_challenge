<?php
use Controlleur\MessageControlleur;
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
use Controlleur\ChallengeDescControlleur;
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
$messageControlleur = new MessageControlleur();
$challengeDescController = new ChallengeDescControlleur();

//gardes 
$adminGuard = new AuthGuard($authController,"isAdmin");
$gestionnaireGuard = new AuthGuard($authController,"isGestionnaire");
$userGuard = new AuthGuard($authController,"isLogged");
$adminOrGestionnaireGuard = new AuthGuard($authController,"isAdminOrGestionnaire");

//les pages 
$loginPage = new Route("/login",$authController,"index");
$mainPage = new Route("/",$mainControlleur,"index");
$loginHandler = new Route("/trylogin",$authController,"login");
$registerHandler = new Route("/tryregister",$authController,"register");
$logout = new Route("/logout",$authController,"logout");
$challengeDesc = new Route("/dataChallenge",$challengeDescController,"index");

$autocomplete = new Route("/autocomplete",$userControlleur,"autocomplete");
$addToEquipe = new Route("/addEquipe",$userControlleur,"addToEquipe");


//les pages protegees
$adminDashboard = new ProtectedRoute("/admin",$adminControlleur,"index",$adminGuard);
$gestionnaireDashboard = new ProtectedRoute("/gestionnaire", $gestionnaireControlleur, "index", $gestionnaireGuard);
$userPage = new ProtectedRoute("/user",$userControlleur,"index",$userGuard);
$deleteUser = new ProtectedRoute("/admin/deleteUser",$adminControlleur,"deleteUser",$adminGuard);
$addUser = new ProtectedRoute("/admin/addUser",$adminControlleur,"addUser",$adminGuard);
$updateUser = new ProtectedRoute("/admin/updateUser",$adminControlleur,"updateUser",$adminGuard);
$publierMessage = new ProtectedRoute("/publierMessage", $messageControlleur, "publierMessage", $adminOrGestionnaireGuard);
$addChallenge = new ProtectedRoute("/admin/addChallenge",$adminControlleur,"addDataChallenge",$adminGuard);
$addProjet = new ProtectedRoute("/admin/addProjet",$adminControlleur,"addProjet",$adminGuard);
$deleteProjet = new ProtectedRoute("/admin/deleteProjet",$adminControlleur,"deleteProjet",$adminGuard);
$deleteChallenge = new ProtectedRoute("/admin/deleteChallenge",$adminControlleur,"deleteDataChallenge",$adminGuard);
$addRessource = new ProtectedRoute("/admin/addRessource",$adminControlleur,"addRessource",$adminGuard);
$deleteRessource = new ProtectedRoute("/admin/deleteRessource",$adminControlleur,"deleteRessource",$adminGuard);
$userUpdateUser = new ProtectedRoute("/user/updateUser", $userControlleur, 'updateUser',$userGuard);
$userUpdateMDP = new ProtectedRoute("/user/updateUserPSW", $userControlleur,"updateUserPSW", $userGuard);
$dataChallengeDetails = new ProtectedRoute("/gestionnaire/dataChallengeDetails",$gestionnaireControlleur,"deleteRessource",$adminGuard);
$gestUpdateBattle = new ProtectedRoute("/gestionnaire/updateBattle",$gestionnaireControlleur,"updateBattle",$gestionnaireGuard);
$gestAddQuestionnaire = new ProtectedRoute("/gestionnaire/addQuestionnaire", $gestionnaireControlleur,"addQuestionnaire",$gestionnaireGuard);
$addpartenaire = new ProtectedRoute("/admin/addpartenaire",$adminControlleur,"addPartenaire",$adminGuard);
$removepartenaire = new ProtectedRoute("/admin/removepartenaire",$adminControlleur,"removePartenaire",$adminGuard);
$postDefi = new ProtectedRoute("/admin/postDefi",$adminControlleur,"postDefi",$adminGuard);
$masqDefi = new ProtectedRoute("/admin/masqDefi",$adminControlleur,"masqDefi",$adminGuard);
$createEquipe = new ProtectedRoute("/user/newequipe",$userControlleur,"newequipe",$userGuard);
$deleteEquipe = new ProtectedRoute("/user/deleteEquipe",$userControlleur,"deleteequipe",$userGuard);
$updateRendu = new ProtectedRoute("/user/rendu",$userControlleur,"Updaterendu",$userGuard);
//ajout des pages au router

$router->addRoute($loginPage);
$router->addRoute($mainPage);
$router->addRoute($loginHandler);
$router->addRoute($registerHandler);
$router->addRoute($adminDashboard);
$router->addRoute($gestionnaireDashboard);
$router->addRoute($userPage);
$router->addRoute($logout);
$router->addRoute($deleteUser);
$router->addRoute($addUser);
$router->addRoute($updateUser);
$router->addRoute($publierMessage);
$router->addRoute($addChallenge);
$router->addRoute($addProjet);
$router->addRoute($deleteProjet);
$router->addRoute($deleteChallenge);
$router->addRoute($challengeDesc);
$router->addRoute($addRessource);
$router->addRoute($deleteRessource);
$router->addRoute($userUpdateUser);
$router->addRoute($userUpdateMDP);
$router->addRoute($gestUpdateBattle);
$router->addRoute($gestAddQuestionnaire);
$router->addRoute($dataChallengeDetails);
$router->addRoute($addpartenaire);
$router->addRoute($removepartenaire);
$router->addRoute($postDefi);
$router->addRoute($masqDefi);
$router->addRoute($autocomplete);
$router->addRoute($addToEquipe);
$router->addRoute($createEquipe);
$router->addRoute($deleteEquipe);
$router->addRoute($updateRendu);
$router->handleRequest();


