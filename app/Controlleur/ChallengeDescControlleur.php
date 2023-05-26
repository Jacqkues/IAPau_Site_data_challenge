<?php

namespace Controlleur;

use jmvc\Controlleur;
use jmvc\View;

use Model\DataChallengeRepository;
use Model\Entites\projetData;
use Model\ProjetDataRepository;
use Model\UserRepository;

use Lib\DatabaseConnection;

class ChallengeDescControlleur implements Controlleur
{

  private $challengeRepo;

  private $projetDataRepo;

  public function __construct()
  {
    $this->challengeRepo = new DataChallengeRepository(new DatabaseConnection());
    $this->projetDataRepo = new ProjetDataRepository(new DatabaseConnection());
  }

  public function index()
  {
    $challengeDesc = new View("./vue/components/challenge-desc/challenge-desc.php");
    $challengeDesc->assign("challenge", $this->challengeRepo->getDataChallenge($_GET['challenge']));
    try {
      $challengeDesc->assign("projetsData", $this->projetDataRepo->getProjetByChallenge($_GET['challenge']));
    } catch (\Exception $e) {
      $challengeDesc->assign("projetsData", []);
    }
    $challengeDesc->show();
  }
}