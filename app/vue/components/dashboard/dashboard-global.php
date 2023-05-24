<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./vue/components/dashboard/dashboard-global.css">
    <link rel="stylesheet" href="./vue/global-components.css">
    <title><?= $title ?></title>
  </head>
  <body>

    
    <article>
    <a href="/" class="logo">
      <img src="vue/assets/logo.png" alt="logo-IA-Pau">
      <h1>IA Pau</h1>
    </a>
    
      <section>
        <div class="mtop">
        <div class="utilisateur">
          <h2><?= $prenom." ".$nom ?></h2>
          <p><?= $type ?></p>
        </div>

        <div class="onglets">
          <?php foreach ($onglets as $onglet) { ?>
            <a href="/<?= $type ?>?onglet=<?= $onglet ?>" class="<?php if($onglet == $onglet_courant) { echo "onglet-active"; }else{ echo "onglet";}?>">
              <div class="onglet">
            <?= $onglet ?>
            </div>
          </a>
            
          <?php } ?>

          <a href="/logout" class="onglet">
            <div class="onglet">
            Deconnexion
            </div>
          </a>

        </div>
        </div>
      </section>
      
      <div class="content-container">
        <?= $content ?>
      </div>
      
      
    </article>
  </body>
</html>