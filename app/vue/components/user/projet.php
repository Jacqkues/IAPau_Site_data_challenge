<h1>Vos projets</h1>
<link rel="stylesheet" href="./vue/components/user/equipe.css">
<?php if (isset($_GET['rendu']) && isset($_GET['id'])) { ?>
    <div class="overlay">
        <div class="disp">
            <div class="title">
                <h1>Nouveau lien</h1>
                <a href="/user?onglet=Mes%20projets">X</a>
            </div>

            <form action="/user/rendu" method="post">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <input type="text" name="lien" placeholder="Lien github" class="bouton-input-text">
                <input type="submit" value="Enregistrer" class="bouton">
            </form>
        </div>
    </div>
<?php } ?>
<div class="container">

    <?php foreach ($equipes as $equipe) { 
        try{
            $projet = $p->getProjetData($equipe->getIdProjet());
        }
        catch(Exception $e){
            $projet = null;
        }

        
        ?>
        <?php if(isset($projet)) {?>
        <div class="card">

            <h1>
                <?= $projet->getLibelle() ?>
            </h1>
            <p>
                <?= $projet->getDescription() ?>
            </p>
            <div>
                <p class="wrap">Votre projet : <?= $rendus->getRenduByTeam($equipe->getId())->getLien()?></p>
                <p>Derniere modification : <?= $rendus->getRenduByTeam($equipe->getId())->getDateRendu()?></p>
            </div>
            <br>
            <div>
                <?php if($_SESSION['user']->getId() == $equipe->getIdChef()){?>
                <a href="/user?onglet=Mes%20projets&rendu&id=<?= $equipe->getId() ?>" class="bouton">Modifier le rendu</a>
                <a href="" class="bouton-secondaire ">Répondre au questionnaire</a>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    <?php } ?>

</div>