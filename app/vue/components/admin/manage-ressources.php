<link rel="stylesheet" href="./vue/components/admin/admin.css">

<div>
    <h1>Ressources</h1>
    <h3>Data Challenge</h3>
    <select>
        <?php foreach($dataChallenges as $dataChallenge){ ?>
            <option value="<?= $dataChallenge->getIdChallenge() ?>"><?= $dataChallenge->getLibelle() ?></option>
        <?php } ?>
    </select>

    

</div>