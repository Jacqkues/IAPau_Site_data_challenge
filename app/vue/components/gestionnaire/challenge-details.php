<div class="data-challenge-details">
  <link rel="stylesheet" href="./vue/components/gestionnaire/gestionnaire.css">
  <div class="manage-header">
    <h1>Équipes</h1>
    <a class="bouton" href="/gestionnaire">Retour</a>
  </div>


  <div class="list-container">
    <div class="list-header user-info colonnes-equipes">
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

      <div class="list-content">
        <div class="user-info colonnes-equipes">
          <?php foreach ($membres->getMembreByTeam($equipe->getId()) as $membre) { ?>
            <span>
              <?= $users->getUser($membre->getIdUser())->getPrenom() . " " . $users->getUser($membre->getIdUser())->getNom() ?>
            </span>
          <?php } ?>
        </div>
      </div>
    <?php } ?>
  </div>
</div>