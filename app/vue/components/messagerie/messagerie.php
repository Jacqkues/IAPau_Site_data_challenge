<link rel="stylesheet" href="vue/components/messagerie/messagerie.css">
<script src="./vue/components/messagerie/messagerie.js" defer></script>
<div class="safe-zone">
  <?php foreach ($messages as $message) { ?>
    <div class="message">
      <div class="en-tete">
        <p class="date-auteur">
          <?= $message->getDateEnvoi() ?> ·
          <?= $users->getUser($message->getIdAuteur())->getPrenom() . " " . $users->getUser($message->getIdAuteur())->getNom() ?>
          ·
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
    <form method="post"
      action="/publierMessage?categorie=<?= isset($_GET['categorie']) ? $_GET['categorie'] : "GÉNÉRAL" ?>"
      class="publier">
      <div class="champs">
        <div class="haut">
          <input type="text" name="objet" placeholder="Objet" class="bouton-input-text">
          <select name="categorie" class="bouton-input-text">
            <option value="GÉNÉRAL" <?=
              !isset($_GET['categorie']) || $_GET['categorie'] == "GÉNÉRAL" ? "selected" : ""
              ?>>
              GÉNÉRAL
            </option>
            <?php foreach ($categories as $categorie) { ?>
              <option value="<?= $categorie->getLibelle() ?>" <?=
                  isset($_GET['categorie']) && $_GET['categorie'] == $categorie->getLibelle() ? "selected" : ""
                  ?>>
                <?= $categorie->getLibelle() ?>
              </option>
            <?php } ?>
          </select>
        </div>
        <input type="text" name="contenu" placeholder="Message" class="bas bouton-input-text">
      </div>
      <input type="submit" value="Publier" class="bouton">
    </form>
  <?php } ?>

  <?php if ($type == "user") { ?>
    <select name="categorie" class="bouton-input-text user-select">
      <option value="GÉNÉRAL" <?=
        !isset($_GET['categorie']) || $_GET['categorie'] == "GÉNÉRAL" ? "selected" : ""
        ?>>
        GÉNÉRAL
      </option>
      <?php foreach ($equipes as $equipe) { ?>
        <?php foreach ($challengerepo->getChallengesByUser($user->getId()) as $challenge) { ?>
          <option value="<?= $challenge->getLibelle() ?>" <?=
              isset($_GET['categorie']) && $_GET['categorie'] == $challenge->getLibelle() ? "selected" : ""
              ?>>
            <?= $challenge->getLibelle() ?>
          </option>
        <?php } ?>
      </select>
    <?php } ?>
  <?php } ?>
</div>