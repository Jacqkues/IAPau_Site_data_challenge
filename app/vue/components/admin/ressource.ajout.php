<link rel="stylesheet" href="./vue/components/admin/admin.css">
<div>
    <?php if(isset($challenge)){ ?>
            <h1>Ajout de Ressources au challenge :  <?= $challenge->getLibelle()?></h1>
        <?php } else { ?>
            <h1>Ajout de Ressources</h1>
            <?php } ?>

<form action="/admin/addRessource" method="post">
    <input type="text" name="titre" id="" placeholder="Titre">
    <input type="text" name="lien" id="" placeholder="Lien">
    <input type="text" name="type" id="" placeholder="Type">
    
     <?php  if(isset($challenge)){ ?>
        <input type="hidden" name="challenge" value="<?= $challenge->getIdChallenge()?>">
     <?php }else{ ?>
        <select name="challenge" id="">
            <?php foreach($challenges as $challenge){ ?>
                <option value="<?= $challenge->getIdChallenge()?>"><?= $challenge->getLibelle()?></option>
            <?php } ?>
        </select>
        <?php } ?>
        <input type="submit" value="Ajouter" class="bouton">

</form>
</div>