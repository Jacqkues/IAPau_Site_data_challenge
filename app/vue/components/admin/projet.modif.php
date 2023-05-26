<link rel="stylesheet" href="./vue/components/admin/admin.css">

<div class="overlay" id="ol">
    <div class="ct">
        <div>
            <button class="closeBtn">X</button>
            <h1>Nouvelle ressource</h1>

        </div>
        <form action="/admin/addRessource" method="post">
            <input type="hidden" name="idChallenge" value="<?= $_GET['idChallenge']; ?>">
            <input type="hidden" name="projetId" value="<?= $projet->getIdProjet() ?>">
            <input type="text" name="titre" id="" placeholder="nom">
            <input type="text" name="lien" id="" placeholder="lien">
            <input type="text" name="type" id="" placeholder="type">
            <input type="submit" value="Ajouter au projet" class="bouton">
        </form>
    </div>
</div>


<div class="center-content">
    <div class="main-content">
        <img src="<?= $projet->getLienImg() ?>" alt="">
        <h1>
            <?= $projet->getLibelle() ?>
        </h1>
        <p>
            <?= $projet->getDescription() ?>
        </p>
        <h2>Partenaires</h2>

        <button class="bouton">+ Ajouter</button>
        <h2>Ressources générale</h2>
        <div class="ressources">
            <?php foreach ($ressources as $ressource) { ?>
                <div class="ressource">
                    <h3>
                        <?= $ressource->getNom() ?>
                    </h3>
                    <a class="wrap" href="<?= $ressource->getLien() ?>"><?= $ressource->getLien() ?></a>
                </div>
            <?php } ?>

            <h2>Ressources projet</h2>
            <?php foreach ($projetressources as $ressource) { ?>
                <div class="ressource">
                    <h3>
                        <?= $ressource->getNom() ?>
                    </h3>
                    <a class="wrap" href="<?= $ressource->getLien() ?>"><?= $ressource->getLien() ?></a>
                </div>
            <?php } ?>
           
            <button class="bouton" id="addRes">+ Ajouter</button>
        </div>
    </div>
    <style>
        .content-container {
            margin-top: 3vw;
            margin-bottom: 0;
            margin-left: 300px;
            width: calc(100% - 300px);

        }
    </style>
    <script src="./vue/components/admin/manageProjet.js"></script>