<link rel="stylesheet" href="vue/components/gestionnaire/battle/updateBattle.css">
<div class="corps">
    <div class="Modif">
        <p>Modification d'une Data Battle</p>
        <form action="/gestionnaire/updateBattle" method="post">
            <input type="hidden" name="types" value="battle">
            <input type="hidden" name="id" value="<?= $_GET['id'] ;?>">
            <label id="nom" >Nouveau nom :</label>
            <input type="text" name="libelle" class="bouton-input-text">
            <label id="dateDebut">Date de Début :</label>
            <input type="date" name="debut" class="bouton-input-text">
            <label id="dateFin">Date de Fin :</label>
            <input type="date" name="fin" class="bouton-input-text">
            <input type="submit" class="bouton" value="Changer les Informations">
        </form>
    </div>
</div>


<script type="module" src="https://unpkg.com/ionicons@7.1.0/dis t/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
