<h1>Connexion</h1>

<?php if(isset($error)){
        echo "<p>$error</p>";
}
?>
    
<form action="/trylogin" method="post">
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="mdp">Mot de passe</label>
        <input type="password" id="mdp" name="mdp" required>
    </div>
    <div>
        <input type="submit" value="Se connecter">
    </div>
</form>

