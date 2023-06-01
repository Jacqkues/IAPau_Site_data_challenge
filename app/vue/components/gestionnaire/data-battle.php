<link rel="stylesheet" href="vue/components/gestionnaire/data-battle.css">
<link rel="stylesheet" href="./vue/components/gestionnaire/gestionnaire.css">

<div class="manage-header">
    <h1>Data Battle</h1>
  </div>


  <div class="list-container">
    <div class="list-header user-info">
      <span class="challenge-title">Titre</span>
      <span>Debut</span>
      <span>Fin</span>
    </div>


    <?php foreach ($dataBattle as $battle) { ?>

      <div class="list-content">
        <div class="user-info">
          <span class="challenge-title">
            <?= $battle->getLibelle() ?>
          </span>
          <span>
            <?= $battle->getTempsDebut() ?>
          </span>
          <span>
            <?= $battle->getTempsFin() ?>
          </span>
          <a class="bouton" href="/gestionnaire?updateBattle&id=<?= $battle->getIdChallenge() ;?>">Modifier</a>
          <a href="/gestionnaire?detail-battle&id=<?= $battle->getIdChallenge(); ?>" class="bouton">Détails</a>
        </div>
      </div>
    <?php } ?>
  </div>
