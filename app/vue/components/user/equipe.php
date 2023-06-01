<link rel="stylesheet" href="./vue/components/user/equipe.css">

<?php if (isset($_GET['error'])) { ?>
    <div class="error">
        <?php
        switch ($_GET['error']) {
            case "echecAjoutMembre":
                echo "L'utilisateur est déja présent dans l'équipe";
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
    <h1>Vos equipes : </h1>
    <br>
    <a href="/user?onglet=Mes%20equipes&new=true" class="bouton">Creer une equipe</a>
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
                <p>Vous etes le chef de l'equipe</p>
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

                    <a href="" class="bouton">Details</a>
                    <?php if ($equipe->getIdChef() == $_SESSION['user']->getId()) { ?>
                        <a href="/user?onglet=Mes%20equipes&addTo=<?= $equipe->getId() ?>" class="bouton">Ajouter Membre</a>
                        <a href="/user/deleteEquipe?id=<?= $equipe->getId() ?>" class="bouton red">Supprimer</a>
                    <?php } ?>
                </div>

            </div>
        </div>
    <?php } ?>
</div>

<script>
    const input = document.getElementById('autocomplete-input');
    const dropdown = document.getElementById('autocomplete-dropdown');

    input.addEventListener('input', function () {
        const userInput = input.value;

        if (userInput.length > 0) {
            // Send AJAX request to the backend
            const request = new XMLHttpRequest();
            console.log('/autocomplete?query=' + userInput)
            request.open('GET', '/autocomplete?query=' + userInput, true);
            console.log('ok')
            request.onload = function () {
                if (request.status >= 200 && request.status < 400) {
                    console.log(request.responseText)
                    const response = JSON.parse(request.responseText);

                    // Update the dropdown with the suggestions
                    dropdown.innerHTML = '';
                    response.forEach(function (suggestion) {
                        const option = document.createElement('div');
                        option.className = 'dropdown-item';
                        option.textContent = suggestion;
                        option.onclick = function () {
                            input.value = suggestion;
                            dropdown.innerHTML = '';
                        };
                        dropdown.appendChild(option);
                    });
                }
            };

            request.send();
        } else {
            // Clear the dropdown if the input is empty
            dropdown.innerHTML = '';
        }
    });
</script>