<link rel="stylesheet" href="./vue/components/admin/admin.css">
<div>
    <?php if (isset($challenge)) { ?>
        <h1>Ajout de Ressources au challenge :
            <?= $challenge->getLibelle() ?>
        </h1>
    <?php } else if (isset($ressource)) { ?>
            <h1>Modification de Ressources</h1>
    <?php } ?>

    <form action="/admin/addRessource" method="post">
        
        <input type="text" name="titre" id="" class="bouton-input-text" placeholder="Titre" value="<?php if(isset($ressource)) echo $ressource->getNom(); ?>">
        <input type="text" name="lien" id="" class="bouton-input-text" placeholder="Lien" value="<?php if(isset($ressource)) echo $ressource->getLien(); ?>">
        <input type="text" name="type" id="" class="bouton-input-text" placeholder="Type" value="<?php if(isset($ressource)) echo $ressource->getTypes(); ?>">
        <?php if (isset($challenge)) { ?>
            <input type="hidden" name="challenge" value="<?= $challenge->getIdChallenge() ?>">
        <?php } ?>
        
        <?php if (isset($ressource)) { ?>
            <input type="hidden" name="id" value="<?= $ressource->getId() ?>">
        <?php } ?>
        <input type="submit" value="<?php if(isset($ressource)) { echo "Modifier"; } else { echo "Ajouter" ;} ?>  " class="bouton">
    </form>
</div>