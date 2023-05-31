<h1>Vos projets :</h1>



<?php foreach ($projets as $projet) { ?>

<div class="list-content">
  <div class="user-info">
    <span class="challenge-title">
      <?= $projet->getLibelle() ?>
    </span>
    <span>
      <?= $projet->getDescription() ?>
    </span>
    <a href="/gestionnaire?details-challenge&challenge="
      class="bouton">Équipes</a>
    <a href="/dataChallenge?challenge=" class="bouton">Détails</a>
  </div>
</div>
<?php } ?>