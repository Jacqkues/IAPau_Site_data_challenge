<h1>Les rendus :</h1>

    <?php foreach ($listprojet as $projet) { ?>
        <h1>
            <?= $projet->getLibelle() ?>
        </h1>
        <div class="container">
        <?php foreach ($rendus->getRenduByProjet($projet->getIdProjet()) as $rendu) { ?>
            <div class="card">
                <p class="wrap">
                  Lien :  <a href="<?= $rendu->getLien() ?>"> <?= $rendu->getLien() ?> </a>
                </p>
                <p>
                  Date rendu :  <?= $rendu->getDateRendu() ?>
                </p>
                <p>
                 Equipe :   <?= $eq->getEquipe($rendu->getIdEquipe())->getNom() ?>
                </p>

                <a href="/gestionnaire/resultAnalyse?id=<?= $rendu->getLien() ?>" class="bouton">Analyser</a>
            </div>
        <?php } ?>
        </div>
    <?php } ?>



<style>
    a {
        color: black;
    }
</style>