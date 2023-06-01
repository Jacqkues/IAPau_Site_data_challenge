<link rel="stylesheet" href="./vue/components/admin/admin.css">
<div>
    <h1>
        Ajout d'un projet au Data Challenge : <?= $challenge->getLibelle(); ?>
    </h1>


    <form action="/admin/addProjet" method="post">
            <input type="hidden" name="id" class="bouton-input-text" value="<?= $challenge->getIdChallenge(); ?>">
            <input type="text" name="titre" id="" class="bouton-input-text" placeholder="Titre">
            <textarea name="description" id="" class="bouton-input-text" cols="30" rows="10" placeholder="Description"></textarea>
            <input type="text" name="lienimg" class="bouton-input-text" placeholder="Lien de l'image">
            <input type="submit" value="Créer" class="bouton">
    </form>
</div>