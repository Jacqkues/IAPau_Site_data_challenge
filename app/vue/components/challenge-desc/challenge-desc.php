<html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./vue/components/challenge-desc/challenge-desc.css">
  <script src="vue/components/challenge-desc/challenge-desc.js" defer></script>
</head>

<body>
  <header>
    <?php include "./vue/components/header/header.php" ?>
  </header>

  <article>
    <img src="<?= "vue/assets/challenge.jpg" ?>" alt="challenge">
    <section>
      <div class="en-tete">
        <p class="date">
          <?= $challenge->getTempsDebut() . " - " . $challenge->getTempsFin() ?>
        </p>
        <h2>
          <?= $challenge->getLibelle() ?>
        </h2>
      </div>

      <?php foreach ($projetsData as $projetData) { ?>
        <div class="projet">
          <img src="vue/assets/projet.jpg" alt="projet" class="projet-img">
          <div class="projet-desc">
            <p class="titre-projet">
              <?= $projetData->getLibelle() ?>
            </p>
            <p>
              <?= $projetData->getDescription() ?>
            </p>
            <a class="bouton" onclick="openPopup()">Participer</a>
          </div>
        </div>
      <?php } ?>
    </section>
  </article>

  <?php if (isset($_SESSION['user'])) { ?>
    <div class="popup">
      <h2>Choisissez une équipe :</h2>
      <div class="header">
        <span>Mb 1</span>
        <span>Mb 2</span>
        <span>Mb 3</span>
        <span>Mb 4</span>
        <span>Mb 5</span>
        <span>Mb 6</span>
        <span>Mb 7</span>
        <span>Mb 8</span>
      </div>

      <?php foreach ($equipes as $equipe) { ?>
        <div class="equipe">
          <?php foreach ($userRepo->getUserByEquipe($equipe->getId()) as $user) { ?>
            <span>
              <?= $user->getPrenom() . " " . $user->getNom() ?>
            </span>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  <?php } ?>
</body>

</html>