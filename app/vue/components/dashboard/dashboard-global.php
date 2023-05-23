<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./vue/components/dashboard/dashboard-global.css">
    <link rel="stylesheet" href="./vue/global-components.css">
  </head>
  <body>
    <header>
      <?php include "./vue/components/header/header.php"; ?>

      <div class="compte">
        <a class="bouton" href="/logout">Déconnexion</a>
      </div>
    </header>

    <article>
      <section>
        <div class="utilisateur">
          <h2><?= $prenom." ".$nom ?></h2>
          <p><?= $type ?></p>
        </div>
        <div class="onglets">
          <?php 
          foreach ($onglets as $onglet) {
            echo "<a href='/".$type."?onglet=".$onglet."' class='onglet'>".$onglet."</a>";
          }
          ?>
        </div>
      </section>

      <?php include $onglet_courant ?>
    </article>
  </body>
</html>