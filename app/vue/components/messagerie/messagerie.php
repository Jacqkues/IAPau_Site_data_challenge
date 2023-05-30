<link rel="stylesheet" href="vue/components/messagerie/messagerie.css">
<div class="safe-zone">
  <?php foreach ($messages as $message) { ?>
    <div class="message">
      <div class="en-tete">
        <p class="date-auteur">
          <?= $message->getDateEnvoi() ?> ·
          <?= $users->getUser($message->getIdAuteur())->getPrenom()." ".$users->getUser($message->getIdAuteur())->getNom() ?> ·
          <?= $message->getCategorie() ?>
        </p>
        <h2>
          <?= $message->getObjet() ?>
        </h2>
      </div>
      <p class="contenu">
        <?= $message->getContenu() ?>
      </p>
    </div>
  <?php } ?>

  <?php if ($type == "admin" || $type == "gestionnaire") { ?>
    <form method="post" action="/publierMessage" class="publier">
      <div class="champs">
        <div class="haut">
          <input type="text" name="objet" placeholder="Objet" class="bouton-input-text">
          <select name="categorie" class="bouton-input-text">
            <option value="GÉNÉRAL">GÉNÉRAL</option>
            <?php foreach ($categories as $categorie) { ?>
              <option value="<?= $categorie->getLibelle() ?>"><?= $categorie->getLibelle() ?></option>
            <?php } ?>
          </select>
        </div>
        <input type="text" name="contenu" placeholder="Message" class="bas bouton-input-text">
      </div>
      <input type="submit" value="Publier" class="bouton">
    </form>
  <?php } ?>
</div>