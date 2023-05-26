

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Data Challenge · Connexion</title>
    <link rel="stylesheet" href="./vue/components/signin-login/signin-login.css">
    <link rel="stylesheet" href="./vue/global-components.css">
    <script src="vue/components/signin-login/signin-login.js" defer></script>
  </head>
  <body>
    <header>
      <?php include "./vue/components/header/header.php"; ?>
    </header>

    <section>
      <?php 
      if(isset($_GET['methode']) && $_GET['methode'] == "inscription" ) {
        include "./vue/components/signin-login/inscription.php";
      } else {
        include "./vue/components/signin-login/connexion.php";
      }
      ?>
    </section>

    <section>
      <h2>Venez challenger vos données</h2>
      <p>IA Pau organise des Data Challenges avec les entreprises partenaires pour amener les meilleurs étudiants de la francophonie à travailler sur des projets concrets liés à leurs données.</p>
    </section>
  </body>
</html>