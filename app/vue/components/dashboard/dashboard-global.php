<?php
$nom = "Travaux";
$prenom = "Louis";
$type = "Etudiant";
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Data Challenge · Dashboard</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./vue/components/dashboard/dashboard-global.css">
    <link rel="stylesheet" href="./vue/global-components.css">
  </head>
  <body>
    <header>
      <?php include "./vue/components/header/header.php"; ?>

      <div class="compte">
        <a class="bouton" href="/logout">Déconnexion</a>
      </div>
    </header>

    <article>
      <section>
        <div class="utilisateur">
          <h2><?= $prenom." ".$nom ?></h2>
          <p><?= $type ?></p>
        </div>
        <div class="onglets">
          <a href="" class="onglet">Mon compte</a>
          <a href="" class="onglet">Challenges disponibles</a>
        </div>
      </section>
      <section></section>
    </article>
  </body>
</html>