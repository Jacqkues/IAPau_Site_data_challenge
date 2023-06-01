<link rel="stylesheet" href="./vue/components/challenges-dispo/challenges-dispo.css">
<h1>Les Challenges : </h1>

<div class="container">
    <?php foreach ($challengesDispo as $challenge) { ?>
        <div class="card">
            <h3>
                <?= strtoupper($challenge->getLibelle()) ?>
            </h3>
            <p class="date">
                <?= $challenge->getTempsDebut() . " - " . $challenge->getTempsFin() ?>
            </p>
            <p class="type">
                DATA <?= strtoupper($challenge->getType()) ?>
            </p>

            <p class="nbP">Nombre de Projets : 4</p>
            <a href="/dataChallenge?challenge=<?= $challenge->getIdChallenge() ?>" class="bouton">En savoir +</a>
        </div>
    <?php } ?>
</div>