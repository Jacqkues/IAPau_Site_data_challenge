<div class="main">
    <div>
        <a href="/user?onglet=Mes projets">Retour</a>

        <h1>Questions : </h1>
        
            <?php foreach ($questions as $question) { 
                if(!($reponses->existReponseByEquipe($idEquipe,$question->getIdQuestion()))){
                ?>
                <form action="/user/saveResponse" method="post">
                <p>
                    <?= $question->getQuestion() ?>
                </p>
                <input type="hidden" name="idBattle" value="<?= $_GET['id']; ?>">
                <input type="hidden" name="idQuestion" value="<?=$question->getIdQuestion() ?>">
                <input type="hidden" name="idEquipe" value="<?= $idEquipe ?>">
                <textarea name="reponse" id="" cols="50" rows="10"></textarea>
                <input type="submit" value="Envoyer" class="bouton">
            <?php } } ?>
            
        </form>

    </div>
</div>

<style>
    .main{
        width:100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    a{
        color: black;
    }
    
</style>