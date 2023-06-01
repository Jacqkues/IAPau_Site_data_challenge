<link rel="stylesheet" href="./vue/components/admin/admin.css">


<div class="overlay" id="ol">
    <div class="ct">
        <div>
            <button class="closeBtn" id="c1">X</button>
            <h1>Nouvelle ressource</h1>

        </div>
        <form action="/admin/addRessource" method="post">
            <input type="hidden" name="mnr">
            <?php if (isset($challenge)) { ?>
                <input type="hidden" name="challenge" value="<?= $challenge->getIdChallenge() ?>">
            <?php } ?>

            <input type="text" name="titre" id="" placeholder="nom" class="bouton-input-text">
            <input type="text" name="lien" id="" placeholder="lien" class="bouton-input-text">
            <input type="text" name="type" id="" placeholder="type" class="bouton-input-text">
            <input type="submit" value="Ajouter au data challenge" class="bouton">
        </form>
    </div>
</div>

<div class="overlay" id="ol1">
    <div class="ct">
        <div>
            <button class="closeBtn" id="c2">X</button>
            <h1>Nouvelle ressource</h1>

        </div>
        <form action="/admin/addRessource" method="post">
            <input type="hidden" name="mnr">
            <?php if (isset($challenge)) { ?>
                <input type="hidden" name="idChallenge" value="<?= $challenge->getIdChallenge() ?>">
            <?php } ?>

            <?php if (isset($idProjet)) { ?>
                <input type="hidden" name="projetId" value="<?= $idProjet ?>">
            <?php } ?>
            <input type="text" name="titre" id="" placeholder="nom" class="bouton-input-text">
            <input type="text" name="lien" id="" placeholder="lien" class="bouton-input-text">
            <input type="text" name="type" id="" placeholder="type" class="bouton-input-text">
            <input type="submit" value="Ajouter au projet" class="bouton">
        </form>
    </div>
</div>



<div class="flexcol">
    <h1>Ressources</h1>
   

    <div class="list-container">
        <div class="list-header user-info">
            <span>Titre</span>
            <span>Debut</span>
            <span>Fin</span>
        </div>


        <?php foreach ($dataChallenges as $ch) { ?>

            <div class="list-content">
                <div class="user-info">
                    <span>
                        <?= $ch->getLibelle() ?>
                    </span>
                    <span>
                        <?= $ch->getTempsDebut() ?>
                    </span>
                    <span>
                        <?= $ch->getTempsFin() ?>
                    </span>
                </div>
                <div class="btn-setting">

                    <?php if (isset($challenge) && $challenge->getIdChallenge() == $ch->getIdChallenge()) { ?>
                        <a id="formChallenge" class="bouton-secondaire" href="/admin?onglet=Ressource">Annuler</a>
                    <?php } else { ?>
                        <a class="bouton" id="formChallenge"
                            href="/admin?onglet=Ressource&idChallenge=<?= $ch->getIdChallenge(); ?>">voir
                            ressources</a>
                    <?php } ?>

                </div>
            </div>

        <?php } ?>

    </div>
    <?php if (isset($ressources)) { ?>

        <h3>
            Ressources du Data <?= $challenge->getType() ?> 
            <i>
                <?= $challenge->getLibelle() ?>
            </i> :
        </h3>
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
                            href="/admin/deleteRessource?id=<?= $res->getId() ?>&idChallenge=<?= $challenge->getIdChallenge() ?>&mnr" onclick="return confirmAction(event)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="black"
                                    d="M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6v12M8 9h8v10H8V9m7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5Z" />
                            </svg>
                        </a>
                        <a href="/admin?addR&idRes=<?= $res->getId() ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="black"
                                    d="M19.9 12.66a1 1 0 0 1 0-1.32l1.28-1.44a1 1 0 0 0 .12-1.17l-2-3.46a1 1 0 0 0-1.07-.48l-1.88.38a1 1 0 0 1-1.15-.66l-.61-1.83a1 1 0 0 0-.95-.68h-4a1 1 0 0 0-1 .68l-.56 1.83a1 1 0 0 1-1.15.66L5 4.79a1 1 0 0 0-1 .48L2 8.73a1 1 0 0 0 .1 1.17l1.27 1.44a1 1 0 0 1 0 1.32L2.1 14.1a1 1 0 0 0-.1 1.17l2 3.46a1 1 0 0 0 1.07.48l1.88-.38a1 1 0 0 1 1.15.66l.61 1.83a1 1 0 0 0 1 .68h4a1 1 0 0 0 .95-.68l.61-1.83a1 1 0 0 1 1.15-.66l1.88.38a1 1 0 0 0 1.07-.48l2-3.46a1 1 0 0 0-.12-1.17ZM18.41 14l.8.9l-1.28 2.22l-1.18-.24a3 3 0 0 0-3.45 2L12.92 20h-2.56L10 18.86a3 3 0 0 0-3.45-2l-1.18.24l-1.3-2.21l.8-.9a3 3 0 0 0 0-4l-.8-.9l1.28-2.2l1.18.24a3 3 0 0 0 3.45-2L10.36 4h2.56l.38 1.14a3 3 0 0 0 3.45 2l1.18-.24l1.28 2.22l-.8.9a3 3 0 0 0 0 3.98Zm-6.77-6a4 4 0 1 0 4 4a4 4 0 0 0-4-4Zm0 6a2 2 0 1 1 2-2a2 2 0 0 1-2 2Z" />
                            </svg>
                        </a>

                    </div>
                </div>

            <?php } ?>

        </div>
        <bouton class="bouton" id="addRes">+ Ajouter</bouton>
    <?php } ?>

    <?php if (isset($challenge)) { ?>
        <h3>
            Projet de
            <i>
                <?= $challenge->getLibelle() ?>
            </i> :
        </h3>
        <div class="list-container">
            <div class="list-header user-info">
                <span>Titre</span>
                <span>Description</span>
            </div>


            <?php if (isset($projetList)) { ?>
                <?php foreach ($projetList as $projet) { ?>

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
                            <?php if (isset($idProjet) && $idProjet == $projet->getIdProjet()) { ?>
                                <a id="formChallenge" class="bouton-secondaire"
                                    href="/admin?onglet=Ressource&idChallenge=<?= $challenge->getIdChallenge(); ?>">Annuler</a>
                            <?php } else { ?>
                                <a class="bouton" id="formProjet"
                                    href="/admin?onglet=Ressource&idChallenge=<?= $challenge->getIdChallenge(); ?>&idProjet=<?= $projet->getIdProjet() ?>">Voir
                                    Ressources</a>
                            <?php } ?>

                        </div>
                    </div>

                <?php } ?>
            <?php } ?>
        </div>
    <?php } ?>




    <?php if (isset($projetressources)) { ?>
        <div class="list-container">
            <h3>Ressources</h3>
            <div class="list-header user-info">
                <span>Titre</span>
                <span>Url</span>
            </div>

            <?php foreach ($projetressources as $res) { ?>

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
                            href="/admin/deleteRessource?id=<?= $res->getId() ?>&idChallenge=<?= $challenge->getIdChallenge() ?>&mnr" onclick="return confirmAction(event)"><svg
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
        <bouton class="bouton" id="addres1">+ Ajouter</bouton>
    <?php } ?>

</div>

<script src="./vue/components/admin/manageRessources.js"></script>
<script src="./vue/ConfirmAction.js"></script>