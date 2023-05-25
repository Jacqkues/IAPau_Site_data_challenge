<html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./vue/components/challenges-dispo/challenges-dispo.css">
  <link rel="stylesheet" href="./vue/global-components.css">
</head>

<body>

  <?php foreach ($challengesDispo as $challenge) { ?>
    <section id="challenges" class="challenges">
      <div class="challenge">
        <img src="<?= 'vue/assets/challenge.jpg' ?>" alt="challenge">
        <div class="challenge__desc">
          <h3>
            <?= $challenge->getLibelle() ?>
          </h3>
          <p class="date">
            <?= $challenge->getTempsDebut() . " - " . $challenge->getTempsFin() ?>
          </p>
          <a href="/dataChallenge?challenge=<?= $challenge->getIdChallenge() ?>" class="bouton">En savoir +</a>
        </div>
      </div>
    </section>
  <?php } ?>
</body>

</html>