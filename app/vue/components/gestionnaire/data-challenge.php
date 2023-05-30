<div class="data-challenge">
  <link rel="stylesheet" href="./vue/components/gestionnaire/gestionnaire.css">
  <div class="manage-header">
    <h1>Data Challenge</h1>
    <a class="bouton" href="/gestionnaire">Ajouter</a>
  </div>


  <div class="list-container">
    <div class="list-header user-info">
      <span class="challenge-title">Titre</span>
      <span>Debut</span>
      <span>Fin</span>
    </div>


    <?php foreach ($dataChallenges as $challenge) { ?>

      <div class="list-content">
        <div class="user-info">
          <span class="challenge-title">
            <?= $challenge->getLibelle() ?>
          </span>
          <span>
            <?= $challenge->getTempsDebut() ?>
          </span>
          <span>
            <?= $challenge->getTempsFin() ?>
          </span>
          <a href="/gestionnaire?details-challenge&challenge=<?= $challenge->getIdChallenge() ?>" class="bouton">Équipes</a>
          <a href="/dataChallenge?challenge=<?= $challenge->getIdChallenge() ?>" class="bouton">Détails</a>
        </div>
      </div>
    <?php } ?>
  </div>


  <div class="manage-header">
    <h1>Data Battle</h1>
    <a class="bouton" href="/gestionnaire">Ajouter</a>
  </div>


  <div class="list-container">
    <div class="list-header user-info">
      <span class="challenge-title">Titre</span>
      <span>Debut</span>
      <span>Fin</span>
    </div>


    <?php foreach ($dataChallenges as $challenge) { ?>

      <div class="list-content">
        <div class="user-info">
          <span class="challenge-title">
            <?= $challenge->getLibelle() ?>
          </span>
          <span>
            <?= $challenge->getTempsDebut() ?>
          </span>
          <span>
            <?= $challenge->getTempsFin() ?>
          </span>
          <a href="/gestionnaire?details-challenge&challenge=<?= $challenge->getIdChallenge() ?>" class="bouton">Équipes</a>
          <a href="/dataChallenge?challenge=<?= $challenge->getIdChallenge() ?>" class="bouton">Détails</a>
        </div>
      </div>
    <?php } ?>
  </div>
</div>