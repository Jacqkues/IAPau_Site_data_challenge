<?php

namespace Controlleur;

use jmvc\Controlleur;
use jmvc\View;

use Model\UserRepository;

use Lib\DatabaseConnection;

class ChallengeDescControlleur implements Controlleur
{

  public function __construct()
  {
  }

  public function index()
  {
    $challengeDesc = new View("./vue/components/challenge-desc/challenge-desc.php");
    $challengeDesc->show();
  }
}