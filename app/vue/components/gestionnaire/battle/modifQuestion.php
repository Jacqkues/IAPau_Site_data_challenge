<link rel="stylesheet" href="./vue/components/gestionnaire/gestionnaire.css">
<link rel="stylesheet" href="./vue/components/gestionnaire/battle/modifQuestion.css">

<div class="corps">
    <h1>Modification des Questions</h1>
    <div class="question">
        <div class="modfQ">

            <?php 
            $compte = 0;
            foreach($questions as $question){ 
                $compte++; ?>
                <div class="modif">
                    <form action="/gestionnaire/updateQuestion" method="post">
                        <input type="hidden" name="id" value="<?= $question->getIdQuestion(); ?>">
                        <input type="hidden" name="idQuest" value="<?= $question->getIdQuestionnaire()?>">
                        <label id="question">Question <?= $compte ?></label>
                        <input type="text" name="question" value="<?= $question->getQuestion(); ?>" class="bouton-input-text">
                        <input type="submit" value="Modifier" class="bouton">
                        <a href="/gestionnaire/deleteQuestion?id=<?= $question->getIdQuestion()?>&idQ=<?= $question->getIdQuestionnaire()?>" class="bouton">Supprimer </a>
                    </form>
                </div>
            <?php } ?>
        </div>
            <div class="ajout">
            <form action="/gestionnaire/ajoutQuestion" method="post">
                <label id="question">Ajout d'une question:</label>
                <input type="text" placeholder="Votre Question" name="question" class="bouton-input-text">
                <input type="hidden" value=" <?= $_GET['id']?>" name="idQuestionnaire">
                <input type="submit" value="Ajouter" class="bouton">
            </form>
        </div>
    </div>
</div>