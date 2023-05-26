<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./vue/components/signin-login/signin-login.css">
    <link rel="stylesheet" href="./vue/global-components.css">
  </head>
  <body>
    <h2>Inscription</h2>
    <form action="/tryregister" method="post">
      <input class="bouton-input-text" id="focus" type="text" name="prenom" placeholder="Votre prénom" required>
      <input class="bouton-input-text" type="text" name="nom" placeholder="Votre nom" required>
      <input class="bouton-input-text" type="email" name="email" placeholder="Votre email" required>
      <input class="bouton-input-text" type="password" name="mdp" placeholder="Votre mot de passe" required>
      <div class="cursus">
        <input class="bouton-input-text" name="etablissement" type="text" placeholder="Établissement">
        <select name="niv_etudes" class="bouton-input-text">
          <option value="">Niveau d'études</option>
          <option value="L1">L1</option>
          <option value="L2">L2</option>
          <option value="L3">L3</option>
          <option value="M1">M1</option>
          <option value="M2">M2</option>
          <option value="D">Doctorant</option>
        </select>
      </div>
      <?php
        if (isset($_GET['error'])) {
          echo "<p class='error'>".$_GET['error']."</p>";
        }
      ?>
      <p>Vous avez déjà un compte ? <a href="/login?methode=connexion">Connectez-vous !</a></p>
      <input class="bouton" type="submit" value="S'inscrire">
    </form>
  </body>
</html>