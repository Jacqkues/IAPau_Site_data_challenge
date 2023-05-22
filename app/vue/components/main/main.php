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

    <section id="challenges" class="challenges">
      <div class="challenge">
        <img src="vue/assets/challenge.jpg" alt="challenge">
        <div class="challenge__desc">
          <p class="date">17/05/2023</p>
          <h3>Titre data challenge</h3>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tristique ut nisl ac blandit. Duis nec maximus tortor, eu tempus tortor. Duis eget malesuada eros.
          </p>
          <a href="" class="bouton">En savoir +</a>
        </div>
      </div>
      <div class="challenge">
        <img src="vue/assets/challenge.jpg" alt="challenge">
        <div class="challenge__desc">
          <p class="date">17/05/2023</p>
          <h3>Titre data challenge</h3>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tristique ut nisl ac blandit. Duis nec maximus tortor, eu tempus tortor. Duis eget malesuada eros.
          </p>
          <a href="" class="bouton">En savoir +</a>
        </div>
      </div>
    </section>
  </body>
</html>