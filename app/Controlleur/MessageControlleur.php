<?php

namespace Controlleur;

use Exception;
use jmvc\Controlleur;

use Model\MessagerieRepository;
use Model\UserRepository;
use Lib\DatabaseConnection;

class MessageControlleur implements Controlleur
{
  private $messagerieRepo;

  private $userRepo;

  public function __construct()
  {
    $this->messagerieRepo = new MessagerieRepository(new DatabaseConnection());
    $this->userRepo = new UserRepository(new DatabaseConnection());
  }

  public function publierMessage()
  {
    if (
      isset($_POST['objet'])
      && isset($_POST['categorie'])
      && isset($_POST['contenu'])
    ) {
      $user = $_SESSION['user'];
      $publié = $this->messagerieRepo->addMessage(
        $user->getId(),
        $user->getType(),
        $_POST['objet'],
        $_POST['contenu'],
        date("Y-m-d"),
        $_POST['categorie']
      );

      if (!$publié) {
        throw new Exception("Publication message impossible");
      } else {
        header('Location: /' .$_SESSION['user']->getType(). '?onglet=Messagerie');
      }
    }
  }

  public function index()
  {
  }
}