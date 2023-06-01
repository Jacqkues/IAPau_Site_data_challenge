<link rel="stylesheet" href="vue/components/gestionnaire/battle/updateBattle.css">
<div class="corps">
    <div class="Questionnaire">
        <p>Création du Questionnaire</p>
        <form action="/gestionnaire/addQuestionnaire" method="post">
            <input type="hidden" name="idBattle" value="<?= $_GET['id'] ?>">
            <label id="dateDeb">Date de commencement du Questionnaire:</label>
            <input type="date" name="debut" class="bouton-input-text">
            <label id="dateFin">Date de fin du Questionnaire:</label>
            <input type="date" name="fin" class="bouton-input-text">
            <input type="submit" class="bouton" value="Initialiser le Questionnaire">
        </form>
    </div>
</div>


<script type="module" src="https://unpkg.com/ionicons@7.1.0/dis t/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
