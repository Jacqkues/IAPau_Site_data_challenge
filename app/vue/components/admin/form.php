
<link rel="stylesheet" href="./vue/components/admin/admin.css">
<div>
<div class="manage-header">
    <?php if(isset($user)) { ?>
            <h1>Modifier un utilisateur</h1>
        <?php } else { ?>
            <h1>Ajouter un utilisateur</h1>
        <?php } ?>

        <a href="/admin" class="bouton">Anuler</a>
</div>



<form action="<?php if(isset($user)){echo "/admin/updateUser";}else{ echo "/admin/addUser";}?>" method="post">
    <select name="type" placeholder="Type" >
        <option value="admin" <?php if(isset($user) && $user->getType() == "admin"){ echo "selected";}?>>Admin</option>
        <option value="gestionnaire" <?php if(isset($user) && $user->getType() == "gestionnaire"){ echo "selected";}?>>Gestionnaire</option>
        <option value="user" <?php if(isset($user) && $user->getType() == "user"){ echo "selected";}?>>User</option>
    </select>
    <input type="hidden" name="id" value="<?php if(isset($user)){echo $user->getId();}?>">
    <input type="text" name="nom" placeholder="Nom" value="<?php if(isset($user)){echo $user->getNom();}?>">
    <input type="text" name="prenom" placeholder="Prénom" value="<?php if(isset($user)){echo $user->getPrenom();}?>">
    <input type="text" name="etablissement" placeholder="etablissement" value="<?php if(isset($user)){echo $user->getEtablissement();}?>">
    <input type="text" name="nivEtude" placeholder="nivEtude" value="<?php if(isset($user)){echo $user->getNivEtude();}?>">
    <input type="text" name="numTel" placeholder="numTel" value="<?php if(isset($user)){echo "+33 ". $user->getNumTel();}?>">
    <input type="text" name="mail" placeholder="mail" value="<?php if(isset($user)){echo $user->getMail();}?>">
    <input type="date" name="dateDeb"  value="<?php if(isset($user)){echo $user->getDateDeb();}?>">
    <input type="date" name="dateFin"  value="<?php if(isset($user)){echo $user->getDateFin();}?>">

    <input type="submit" class="bouton" value="Valider">

</form>



</div>