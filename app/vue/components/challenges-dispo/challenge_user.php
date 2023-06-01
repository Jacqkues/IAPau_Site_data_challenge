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

            <p>Jour restant :  
                <?php
                $date1 = new DateTime($challenge->getTempsFin());
                $date2 = new DateTime(date("Y-m-d H:i:s"));
                $interval = $date1->diff($date2);
                echo $interval->format('%a jours');
                ?>
            </p>
            <a href="/dataChallenge?challenge=<?= $challenge->getIdChallenge() ?>" class="bouton">En savoir +</a>
        </div>
    <?php } ?>
</div>