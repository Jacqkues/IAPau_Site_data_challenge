<link rel="stylesheet" href="vue/components/gestionnaire/battle/updateBattle.css">
<div class="corps">
    <div class="Modif">
        <p>Modification d'une Data Battle</p>
        <form action="/gestionnaire/updateBattle" method="post">
            <input type="hidden" name="id" value="<?= $_GET['id'] ;?>">
            <label id="nom">Nouveau nom :</label>
            <input type="text" name="libelle" class="bouton-input-text">
            <label id="dateDebut">Date de Début :</label>
            <input type="date" name="debut" class="bouton-input-text">
            <label id="dateFin">Date de Fin :</label>
            <input type="date" name="fin" class="bouton-input-text">
            <input type="submit" class="bouton" value="Changer les Informations">
        </form>
    </div>

    <div class="Questionnaire">
        <p>Création du Questionnaire</p>
        <form action="/gestionnaire/addQuestionnaire" method="post">
            <input type="hidden" name="idBattle" value="<?= $_GET['id'] ?>">
            <label id="lienQ">Lien du Questionnaire:</label>
            <input type="text" name="lien" class="bouton-input-text">
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
