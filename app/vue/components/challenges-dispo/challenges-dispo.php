<link rel="stylesheet" href="./vue/components/challenges-dispo/challenges-dispo.css">

<section id="challenges" class="challenges">
  <?php foreach ($challengesDispo as $challenge) { ?>
    <div class="challenge">
      <img src="<?php
      try {
        foreach ($detenir->getDetenirByChallenge($challenge->getIdChallenge()) as $lien_ress_chall) {
          $ress = $ressource->getRessources($lien_ress_chall->getIdRessource());
          if ($ress->getTypes() == 'image') {
            $lien = $ress->getLien();
          }
          echo $lien;
        }
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