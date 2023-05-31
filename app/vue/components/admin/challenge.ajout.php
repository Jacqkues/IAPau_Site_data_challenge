<link rel="stylesheet" href="./vue/components/admin/admin.css">
<div>
    <h1>Ajout d'un data Challenge</h1>

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
    let selectType = document.getElementById("selectType");
    let battle = document.getElementById("battle");
    battle.style.display = "none";
    selectType.addEventListener("change", function () {
        if (selectType.value === "battle"){
            battle.style.display = "flex";
        } else {
            battle.style.display = "none";
        }
    })
</script>