<?php 
if(isset($error)) {
  echo "<p>$error</p>";
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Data Challenge · Connexion</title>
    <link rel="stylesheet" href="./vue/components/login/login.css">
    <link rel="stylesheet" href="./vue/global-components.css">
  </head>
  <body>
    <header>
      <?php include "./vue/components/header/header.php"; ?>
    </header>

    <section>
      <h2>Connexion</h2>
      <form action="/trylogin" method="post">
        <input type="email" id="eail" name="email" placeholder="Votre email" required>
        <input type="password" id="mdp" name="mdp" placeholder="Votre mot de passe" required>
        <input class="bouton" type="submit" value="Connexion">
      </form>
    </section>

    <section>
      <h2>Venez challenger vos données</h2>
      <p>IA Pau organise des Data Challenges avec les entreprises partenaires pour amener les meilleurs étudiants de la francophonie à travailler sur des projets concrets liés à leurs données.</p>
    </section>
  </body>
</html>