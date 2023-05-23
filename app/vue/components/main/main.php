<!DOCTYPE html>
<html>
  <head>
    <title>IA Pau · Data Challenge</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./vue/components/main/main.css">
    <link rel="stylesheet" href="./vue/global-components.css">
  </head>
  <body>
    <header>
      <?php include "./vue/components/header/header.php"; ?>

      <div class="compte">
        <a class="bouton" href="/login?methode=connexion">Connexion</a>
        <a class="bouton bouton-secondaire" href="/login?methode=inscription">Inscription</a>
      </div>
    </header>

    <section class="accueil">
      <h2>Data Challenge</h2>
      <h3>Plateforme d'accès à votre espace</h3>
      <a href="/#challenges" class="bouton">Voir les challenges</a>
    </section>

    <?php include "vue/components/challenges-dispo/challenges-dispo.php" ?>
  </body>
</html>