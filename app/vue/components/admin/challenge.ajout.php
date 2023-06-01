<link rel="stylesheet" href="./vue/components/admin/admin.css">
<?php if (isset($_GET['error'])) { ?>
    <div class="error">
        <?php
        switch ($_GET['error']) {
            case "champVide":
                echo "Vérifié tous les champs";
                break;
        }
        ?>
    </div>
<?php } ?>
<div>
    <h1>Ajout d'un Data <span id="type_defi">Challenge</span></h1>
    <form action="/admin/addChallenge" method="post">
        <input type="text" name="titre" placeholder="Titre" class="bouton-input-text" required>
        <input type="date" name="debut" id="" class="bouton-input-text" required>
        <input type="date" name="fin" id="" class="bouton-input-text" required>
        <select name="type" id="selectType" class="bouton-input-text">
            <option value="challenge">Data Challenge</option>
            <option value="battle">Data Battle</option>
        </select>
        <div class="flexcol" id="battle">
            <input type="text" name="titreProjet" id="" placeholder="titre" class="bouton-input-text">
            <textarea name="descriptionProjet" id="" cols="30" rows="10" placeholder="description" class="bouton-input-text"></textarea>
            <input type="text" name="lienProjet" id="" placeholder="lien image" class="bouton-input-text">
        </div>
        <input type="submit" value="Créer" class="bouton">
    </form>
</div>


<script>
    const selectType = document.getElementById("selectType");
    const battle = document.getElementById("battle");
    const type_defi = document.querySelector("#type_defi");
    battle.style.display = "none";
    selectType.addEventListener("change", function () {
        if (selectType.value === "battle"){
            battle.style.display = "flex";
            type_defi.innerHTML = "Battle";
        } else {
            battle.style.display = "none";
            type_defi.innerHTML = "Challenge";
        }
    })
</script>