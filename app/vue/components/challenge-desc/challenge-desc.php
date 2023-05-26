<html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./vue/components/challenge-desc/challenge-desc.css">
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
            <a href="/handleParticipationProjet?projet=<?= $projetData->getIdProjet() ?>" class="bouton">Participer</a>
          </div>
        </div>
      <?php } ?>
    </section>
  </article>
</body>

</html>