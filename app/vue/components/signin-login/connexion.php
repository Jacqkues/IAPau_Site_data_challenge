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
      <input class="bouton-input-text" type="email" id="eail" name="email" placeholder="Votre email" required>
      <input class="bouton-input-text" type="password" id="mdp" name="mdp" placeholder="Votre mot de passe" required>
      <p>Pas encore de compte ? <a href="/login?methode=inscription">Inscrivez-vous !</a></p>
      <input class="bouton" type="submit" value="Connexion">
    </form>
  </body>
</html>