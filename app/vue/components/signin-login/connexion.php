<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./vue/components/signin-login/signin-login.css">
    <link rel="stylesheet" href="./vue/global-components.css">
  </head>
  <body>
    <h2>Connexion</h2>
    <form action="/trylogin" method="post">
      <input class="bouton-input-text" type="email" id="focus" name="email" placeholder="Votre email" required>
      <input class="bouton-input-text" type="password" name="mdp" placeholder="Votre mot de passe" required>
      <?php
        if (isset($_GET['error'])) {
          echo "<p class='error'>".$_GET['error']."</p>";
        }
      ?>
      <p>Pas encore de compte ? <a href="/login?methode=inscription">Inscrivez-vous !</a></p>
      <input class="bouton" type="submit" value="Connexion">
    </form>
  </body>
</html>