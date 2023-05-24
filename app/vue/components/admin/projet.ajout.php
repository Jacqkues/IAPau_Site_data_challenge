<link rel="stylesheet" href="./vue/components/admin/admin.css">
<div>
    <h1>
        Ajout d'un projet au Data Challenge : <?= $challenge->getLibelle(); ?>
    </h1>


    <form action="/admin/addProjet" method="post">
            <input type="hidden" name="id" value="<?= $challenge->getIdChallenge(); ?>">
            <input type="text" name="titre" id="" placeholder="Titre">
            <textarea name="description" id="" cols="30" rows="10" placeholder="Description"></textarea>
            <input type="text" name="lienimg" placeholder="Lien de l'image">
            <input type="submit" value="Crée" class="bouton">
    </form>
</div>