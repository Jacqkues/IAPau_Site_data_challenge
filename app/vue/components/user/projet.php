<h1>Vos projets</h1>

<?php foreach($projets as $projet) { ?>
    <h1><?= $projet->getLibelle() ?></h1>

<?php } ?>