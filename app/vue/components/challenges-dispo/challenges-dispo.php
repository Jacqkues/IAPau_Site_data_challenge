<link rel="stylesheet" href="./vue/components/challenges-dispo/challenges-dispo.css">

<section id="challenges" class="challenges">
  <?php foreach ($challengesDispo as $challenge) { ?>
    <div class="challenge">
      <img src="<?php
      try {
        $lien_ressource_challenge = $detenir->getDetenirByChallenge($challenge->getIdChallenge());
        echo ($ressource->getRessources($lien_ressource_challenge[0]->getIdRessource()))->getLien();
      } catch (\Exception $e) {
        echo "vue/assets/challenge.jpg";
      }
      ?>" alt="challenge">
      <div class="challenge__desc">
        <h3>
          <?=strtoupper($challenge->getLibelle()) ?>
        </h3>
        <p class="date">
          <?= $challenge->getTempsDebut() . " - " . $challenge->getTempsFin() ?>
        </p>
        <a href="/dataChallenge?challenge=<?= $challenge->getIdChallenge() ?>" class="bouton">En savoir +</a>
      </div>
    </div>
  <?php } ?>
</section>