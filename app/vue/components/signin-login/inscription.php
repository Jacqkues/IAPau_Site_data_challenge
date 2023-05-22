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
      <input type="text" name="nom" placeholder="Votre prénom" required>
      <input type="text" name="nom" placeholder="Votre nom" required>
      <input type="email" id="eail" name="email" placeholder="Votre email" required>
      <input type="password" id="mdp" name="mdp" placeholder="Votre mot de passe" required>
      <div class="cursus">
        <input type="text" placeholder="Établissement">
        <select name="niv-etudes" id="niv-etudes">
          <option value="">Niveau d'études</option>
          <option value="L1">L1</option>
          <option value="L2">L2</option>
          <option value="L3">L3</option>
          <option value="M1">M1</option>
          <option value="M2">M2</option>
          <option value="D">Doctorant</option>
        </select>
      </div>
      <p>Vous avez déjà un compte ? <a href="/login?methode=connexion">Connectez-vous !</a></p>
      <input class="bouton" type="submit" value="Connexion">
    </form>
  </body>
</html>