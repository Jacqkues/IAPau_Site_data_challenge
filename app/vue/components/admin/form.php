<link rel="stylesheet" href="./vue/components/admin/admin.css">

<?php if (isset($_GET['error'])) { ?>
    <div class="error">
        <?php
        switch ($_GET['error']) {
            case "champVide":
                echo "Vérifié tous les champs";
                break;
        }
        ?>
    </div>
<?php } ?>

<div>
    <div class="manage-header">
        <?php if (isset($user)) { ?>
            <h1>Modifier un utilisateur</h1>
        <?php } else { ?>
            <h1>Ajouter un utilisateur</h1>
        <?php } ?>

        <a href="/admin" class="bouton">Annuler</a>
    </div>



    <form action="<?php if (isset($user)) {
        echo "/admin/updateUser";
    } else {
        echo "/admin/addUser";
    } ?>" method="post">

        <select name="type" placeholder="Type" class="bouton-input-text">
            <option value="admin" <?php if (isset($user) && $user->getType() == "admin") {
                echo "selected";
            } ?>>Admin
            </option>
            <option value="gestionnaire" <?php if (isset($user) && $user->getType() == "gestionnaire") {
                echo "selected";
            } ?>>Gestionnaire</option>
            <option value="user" <?php if (isset($user) && $user->getType() == "user") {
                echo "selected";
            } ?>>Etudiant
            </option>
        </select>

        <input type="hidden" name="id" value="<?php if (isset($user)) {
            echo $user->getId();
        } ?>" class="bouton-input-text">
        <input type="text" name="nom" placeholder="Nom" required value="<?php if (isset($user)) {
            echo $user->getNom();
        } ?>" class="bouton-input-text">
        <input type="text" name="prenom" placeholder="Prénom" required value="<?php if (isset($user)) {
            echo $user->getPrenom();
        } ?>" class="bouton-input-text">
        <input type="text" name="etablissement" placeholder="etablissement" required value="<?php if (isset($user)) {
            echo $user->getEtablissement();
        } ?>" class="bouton-input-text">

        <select name="nivEtude" class="bouton-input-text">
            <option value="" <?php if (isset($user) && $user->getNivEtude() == "") {
                echo "selected";
            } ?>>-- Non étudiant
                --</option>
            <option value="L1" <?php if (isset($user) && $user->getNivEtude() == "L1") {
                echo "selected";
            } ?>>L1</option>
            <option value="L2" <?php if (isset($user) && $user->getNivEtude() == "L2") {
                echo "selected";
            } ?>>L2</option>
            <option value="L3" <?php if (isset($user) && $user->getNivEtude() == "L3") {
                echo "selected";
            } ?>>L3</option>
            <option value="M1" <?php if (isset($user) && $user->getNivEtude() == "M1") {
                echo "selected";
            } ?>>M1</option>
            <option value="M2" <?php if (isset($user) && $user->getNivEtude() == "M2") {
                echo "selected";
            } ?>>M2</option>
            <option value="D" <?php if (isset($user) && $user->getNivEtude() == "D") {
                echo "selected";
            } ?>>Doctorant
            </option>
        </select>

        <input type="text" name="numTel" placeholder="numTel" value="<?php if (isset($user)) {
            echo "+33 " . $user->getNumTel();
        } ?>" class="bouton-input-text">
        <input type="email" name="mail" placeholder="mail" required value="<?php if (isset($user)) {
            echo $user->getMail();
        } ?>" class="bouton-input-text" required>
        <input type="date" name="dateDeb" value="<?php if (isset($user)) {
            echo $user->getDateDeb();
        } ?>" class="bouton-input-text">
        <input type="date" name="dateFin" value="<?php if (isset($user)) {
            echo $user->getDateFin();
        } ?>" class="bouton-input-text">

        <input type="submit" class="bouton" value="Valider">

    </form>



</div>