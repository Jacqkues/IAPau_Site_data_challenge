<?php

namespace Controlleur;

use jmvc\Controlleur;
use jmvc\View;

use Model\DataChallengeRepository;
use Model\Entites\projetData;
use Model\EquipeRepository;
use Model\MembreRepository;
use Model\ProjetDataRepository;
use Model\UserRepository;
use Model\DetenirRepository;
use Model\RessourceRepository;

use Lib\DatabaseConnection;

class ChallengeDescControlleur implements Controlleur
{

  private $challengeRepo;

  private $projetDataRepo;
  private $equipeRepo;
  private $membreRepo;
  private $userRepo;
  private $detenir;
  private $ressource;

  public function __construct()
  {
    $db = new DatabaseConnection();
    $this->challengeRepo = new DataChallengeRepository($db);
    $this->projetDataRepo = new ProjetDataRepository($db);
    $this->equipeRepo = new EquipeRepository($db);
    $this->membreRepo = new MembreRepository($db);
    $this->userRepo = new UserRepository($db);
    $this->detenir = new DetenirRepository($db);
    $this->ressource = new RessourceRepository($db);
  }

  public function index()
  {
    $challengeDesc = new View("./vue/components/challenge-desc/challenge-desc.php");
    $challengeDesc->assign("challenge", $this->challengeRepo->getDataChallenge($_GET['challenge']));
    $challengeDesc->assign("detenir", $this->detenir);
    $challengeDesc->assign("ressource", $this->ressource);

    // recup user
    if (!isset($_SESSION['user'])) {
      $user = null;
    } else {
      $user = $_SESSION['user'];

      // recup equipes ou array vide
      try {
        $challengeDesc->assign("equipes", $this->equipeRepo->getEquipeByUser($user->getId()));
      } catch (\Exception $e) {
        $challengeDesc->assign("equipes", []);
      }
    }

    $challengeDesc->assign("userRepo", $this->userRepo);

    // recup projets ou array vide
    try {
      $challengeDesc->assign("projetsData", $this->projetDataRepo->getProjetByChallenge($_GET['challenge']));
    } catch (\Exception $e) {
      $challengeDesc->assign("projetsData", []);
    }


    $challengeDesc->show();
  }
}