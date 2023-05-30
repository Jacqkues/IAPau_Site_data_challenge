
<link rel="stylesheet" href="vue/components/updateMDP/updateMDP.css">
<div class="corps">
    <p>Souhaitez-vous changer de mot de passe?</p>
    <form action="/user/updateUserPSW" method="post">
        <input type="hidden" name="id" value="<?php echo $user->getId();?>">
        <label id='mdpL'>Choisissez votre mot de passe</label>
        <input type="password" id="mdp" name="mdp"- placeholder="Mot de passe" class="bouton-input-text" required>
        <label id="confirmMdpL">Confirmez votre mot de passe</label>
        <input type="password" id="confirm" name="confirm" placeholder="Mot de passe" class="bouton-input-text" required>
        <?php if(isset($_GET['error']) && $_GET['error'] == "diff" ){ ?>
        <p class="error"> ⚠️ Veuillez entrez le même mot de passe ⚠️ 
        </p><?php } ?>
        <input type="submit" class="bouton" value="Valider">
    </form>
</div>



