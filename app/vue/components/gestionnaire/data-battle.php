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
            <?= $battle->getLibelleBattle() ?>
          </span>
          <span>
            <?= $battle->getDebut() ?>
          </span>
          <span>
            <?= $battle->getFin() ?>
          </span>
          <a class="bouton" href="/gestionnaire?updateBattle&id=<?= $battle->getIdBattle() ;?>">Modifier</a>
          <a href="/gestionnaire?detail-battle&id=<?= $battle->getIdBattle(); ?>" class="bouton">Détails</a>
        </div>
      </div>
    <?php } ?>
  </div>
