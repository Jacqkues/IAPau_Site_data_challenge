<link rel="stylesheet" href="./vue/components/admin/admin.css">
<div>
    <h1>Ajout d'un data Challenge</h1>

    <form action="/admin/addChallenge" method="post">
        <input type="text" name="titre" placeholder="Titre" class="bouton-input-text" required>
        <input type="date" name="debut" id="" class="bouton-input-text" required>
        <input type="date" name="fin" id="" class="bouton-input-text" required>

        <input type="submit" value="Créer" class="bouton">
    </form>
</div>