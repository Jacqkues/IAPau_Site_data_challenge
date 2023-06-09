<link rel="stylesheet" href="./vue/components/admin/admin.css">



<div class="flexcol">
    <div>
        <div class="manage-header">
            <h1>
                <?= $challenge->getLibelle() ?>
            </h1>
            <?php if ($challenge->getIsPublied() == "0") { ?>
                <a href="/admin/postDefi?id=<?= $challenge->getIdChallenge(); ?>" class="bouton">Publier</a>
            <?php } else { ?>
                <a href="/admin/masqDefi?id=<?= $challenge->getIdChallenge(); ?>" class="bouton">Retirer</a>
            <?php } ?>
        </div>
        <p>
            <strong>Data
                <?= $challenge->getType() ?>
            </strong>
        </p>
        <br>
        <p>Debut :
            <?= $challenge->getTempsDebut() ?>
        </p>
        <p>Fin :
            <?= $challenge->getTempsFin() ?>
        </p>
    </div>

    <div class="manage-header">
        <?php if ($challenge->getType() != "battle") { ?>
            <h3>Projets Associés</h3>
            <a class="bouton" href="/admin?addP&id=<?= $challenge->getIdChallenge() ?>">Ajouter</a>
        <?php } ?>
    </div>


    <div class="list-container">
        <div class="list-header user-info">
            <span>Titre</span>
            <span>Description</span>
        </div>


        <?php foreach ($projets as $projet) { ?>

            <div class="list-content">
                <div class="user-info">
                    <span>
                        <?= $projet->getLibelle() ?>
                    </span>
                    <span class="wrap">
                        <?= $projet->getDescription() ?>
                    </span>
                </div>
                <div class="btn-setting">
                    <a
                        href="/admin/deleteProjet?id=<?= $projet->getIdProjet() ?>&idChallenge=<?= $challenge->getIdChallenge() ?>" onclick="return confirmAction(event)"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" >
                            <path fill="black"
                                d="M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6v12M8 9h8v10H8V9m7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5Z" />
                        </svg></a>
                    <a
                        href="/admin?projetConf&id=<?= $projet->getIdProjet() ?>&idChallenge=<?= $challenge->getIdChallenge() ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="black"
                                d="M19.9 12.66a1 1 0 0 1 0-1.32l1.28-1.44a1 1 0 0 0 .12-1.17l-2-3.46a1 1 0 0 0-1.07-.48l-1.88.38a1 1 0 0 1-1.15-.66l-.61-1.83a1 1 0 0 0-.95-.68h-4a1 1 0 0 0-1 .68l-.56 1.83a1 1 0 0 1-1.15.66L5 4.79a1 1 0 0 0-1 .48L2 8.73a1 1 0 0 0 .1 1.17l1.27 1.44a1 1 0 0 1 0 1.32L2.1 14.1a1 1 0 0 0-.1 1.17l2 3.46a1 1 0 0 0 1.07.48l1.88-.38a1 1 0 0 1 1.15.66l.61 1.83a1 1 0 0 0 1 .68h4a1 1 0 0 0 .95-.68l.61-1.83a1 1 0 0 1 1.15-.66l1.88.38a1 1 0 0 0 1.07-.48l2-3.46a1 1 0 0 0-.12-1.17ZM18.41 14l.8.9l-1.28 2.22l-1.18-.24a3 3 0 0 0-3.45 2L12.92 20h-2.56L10 18.86a3 3 0 0 0-3.45-2l-1.18.24l-1.3-2.21l.8-.9a3 3 0 0 0 0-4l-.8-.9l1.28-2.2l1.18.24a3 3 0 0 0 3.45-2L10.36 4h2.56l.38 1.14a3 3 0 0 0 3.45 2l1.18-.24l1.28 2.22l-.8.9a3 3 0 0 0 0 3.98Zm-6.77-6a4 4 0 1 0 4 4a4 4 0 0 0-4-4Zm0 6a2 2 0 1 1 2-2a2 2 0 0 1-2 2Z" />
                        </svg></a>

                </div>
            </div>

        <?php } ?>
    </div>

    <div class="manage-header" style="margin-top:50px;">
        <h3>Ressources Associés</h3>
        <a class="bouton" href="/admin?addR&id=<?= $challenge->getIdChallenge() ?>">Ajouter</a>
    </div>

    <div class="list-container">
        <div class="list-header user-info">
            <span>Titre</span>
            <span>Url</span>
        </div>

        <?php foreach ($ressources as $res) { ?>

            <div class="list-content">
                <div class="user-info">
                    <span>
                        <?= $res->getNom() ?>
                    </span>
                    <span class="wrap">
                        <?= $res->getLien() ?>
                    </span>
                </div>
                <div class="btn-setting">
                    <a
                        href="/admin/deleteRessource?id=<?= $res->getId() ?>&idChallenge=<?= $challenge->getIdChallenge() ?>" onclick="return confirmAction(event)"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="black"
                                d="M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6v12M8 9h8v10H8V9m7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5Z" />
                        </svg></a>
                    <a href="/admin?addR&idRes=<?= $res->getId() ?>"> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path fill="black"
                                d="M19.9 12.66a1 1 0 0 1 0-1.32l1.28-1.44a1 1 0 0 0 .12-1.17l-2-3.46a1 1 0 0 0-1.07-.48l-1.88.38a1 1 0 0 1-1.15-.66l-.61-1.83a1 1 0 0 0-.95-.68h-4a1 1 0 0 0-1 .68l-.56 1.83a1 1 0 0 1-1.15.66L5 4.79a1 1 0 0 0-1 .48L2 8.73a1 1 0 0 0 .1 1.17l1.27 1.44a1 1 0 0 1 0 1.32L2.1 14.1a1 1 0 0 0-.1 1.17l2 3.46a1 1 0 0 0 1.07.48l1.88-.38a1 1 0 0 1 1.15.66l.61 1.83a1 1 0 0 0 1 .68h4a1 1 0 0 0 .95-.68l.61-1.83a1 1 0 0 1 1.15-.66l1.88.38a1 1 0 0 0 1.07-.48l2-3.46a1 1 0 0 0-.12-1.17ZM18.41 14l.8.9l-1.28 2.22l-1.18-.24a3 3 0 0 0-3.45 2L12.92 20h-2.56L10 18.86a3 3 0 0 0-3.45-2l-1.18.24l-1.3-2.21l.8-.9a3 3 0 0 0 0-4l-.8-.9l1.28-2.2l1.18.24a3 3 0 0 0 3.45-2L10.36 4h2.56l.38 1.14a3 3 0 0 0 3.45 2l1.18-.24l1.28 2.22l-.8.9a3 3 0 0 0 0 3.98Zm-6.77-6a4 4 0 1 0 4 4a4 4 0 0 0-4-4Zm0 6a2 2 0 1 1 2-2a2 2 0 0 1-2 2Z" />
                        </svg></a>

                </div>
            </div>

        <?php } ?>
    </div>

</div>
<script src="./vue/ConfirmAction.js"></script>