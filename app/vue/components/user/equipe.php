<link rel="stylesheet" href="./vue/components/user/equipe.css">

<?php if (isset($_GET['error'])) { ?>
    <div class="error">
        <?php
        switch ($_GET['error']) {
            case "echecAjoutMembre":
                echo "L'utilisateur est déja présent dans l'équipe";
                break;
            case "tailleMax":
                echo "L'équipe est pleine";
                break;
            case "nomOrPrenomEmpty":
                echo "Cet utilisateur semble avoir son nom ou son prénom vide.";
                break;
            default:
                echo "Erreur";
                break;
        }
        ?>
    </div>
<?php } ?>


<?php if (isset($_GET['new'])) { ?>
    <div class="overlay">
        <div class="disp">
            <div class="title">
                <h1>Creer une equipe</h1>
                <a href="/user?onglet=Mes%20equipes">X</a>
            </div>

            <form action="/user/newequipe" method="post">
                <input type="text" name="nom" placeholder="Nom de l'equipe" class="bouton-input-text">
                <input type="submit" value="Creer" class="bouton">
            </form>
        </div>
    </div>
<?php } ?>

<?php if (isset($_GET['addTo']) && $eq->getEquipe($_GET['addTo'])->getIdChef() == $_SESSION["user"]->getId()) { ?>
    <div class="overlay">
        <div class="disp">
            <div class="title">
                <h1>Ajouter utilisateur</h1>
                <a href="/user?onglet=Mes%20equipes">X</a>
            </div>


            <form action="/addEquipe" method="post">
                <input type="hidden" name="id" value="<?= $_GET['addTo'] ?>">
                <input type="text" name="nom" autocomplete="off" id="autocomplete-input" class="bouton-input-text"
                    placeholder="nom prenom">
                <div id="autocomplete-dropdown"></div>
                <input type="submit" value="Ajouter" class="bouton">
            </form>
        </div>
    </div>
<?php } ?>

<div>
    <h1>Vos équipes : </h1>
    <br>
    <a href="/user?onglet=Mes%20equipes&new=true" class="bouton">Créer une equipe</a>
    <br>
    <br>
</div>

<div class="container">
    <?php foreach ($equipes as $equipe) { ?>
        <div class="card">
            <h3>
                <?= strtoupper($equipe->getNom()) ?>
            </h3>
            <?php if ($equipe->getIdChef() == $_SESSION['user']->getId()) { ?>
                <p>Vous êtes le chef de l'equipe</p>
            <?php } else { ?>
                <p>CHEF :
                    <?= $u->getUser($equipe->getIdChef())->getNom() ?>
                </p>
            <?php } ?>
            <p>NOMBRES DE MEMBRES :
                <?= count($u->getUserByEquipe($equipe->getId())) ?>
            </p>

            <p>SCORE :
                <?= $equipe->getScore() ?>
            </p>
            <p>PROJET :
                <?php
                if ($equipe->getIdProjet() == -1) {
                    echo "Aucun";
                } else {
                    echo $p->getProjetData($equipe->getIdProjet())->getLibelle();
                }
                ?>
            </p>

            <div>
                <div class="footer">

                    <a onclick="openPopup()" class="bouton">Détails</a>
                    <?php if ($equipe->getIdChef() == $_SESSION['user']->getId()) { ?>
                        <a href="/user?onglet=Mes%20equipes&addTo=<?= $equipe->getId() ?>" class="bouton">Ajouter Membre</a>
                        <a href="/user/deleteEquipe?id=<?= $equipe->getId() ?>" class="bouton red"
                            onclick="return confirmAction(event)">Supprimer</a>
                    <?php } ?>
                </div>

            </div>
        </div>
    <?php } ?>

    <div class="popup">
        <h2>Choisissez une équipe :</h2>
        <div class="header">
            <span>Mb 1</span>
            <span>Mb 2</span>
            <span>Mb 3</span>
            <span>Mb 4</span>
            <span>Mb 5</span>
            <span>Mb 6</span>
            <span>Mb 7</span>
            <span>Mb 8</span>
        </div>

        <?php foreach ($equipes as $equipe) { ?>
            <div class="equipe" onclick="inscrireEquipe(<?= $equipe->getId() . ', ' . $_GET['challenge'] ?>)">
                <?php foreach ($users->getUserByEquipe($equipe->getId()) as $user) { ?>
                    <span>
                        <?= $user->getPrenom() . " " . $user->getNom() ?>
                    </span>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <div class="popup-overlay"></div>
</div>

<script src="./vue/components/user/user.js" defer></script>
<script src="./vue/ConfirmAction.js" defer></script>