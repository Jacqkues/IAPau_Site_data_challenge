    <link rel="stylesheet" href="./vue/components/gestionnaire/gestionnaire.css">
    <link rel="stylesheet" href="./vue/components/gestionnaire/battle/reponse.css">

    <div class="corps">
        <h1>Voici les réponses du Questionnaire: </h1>

        <div class="Question-Reponse">
            <?php 
            $compte = 0;
            foreach($questions as $question){ ?>
                <div class="question">
                    <div class="titre">
                        <span id="question">Question : <?= $question->getQuestion(); ?> </span>
                    </div>
                    <?php foreach($reponses as $reponse){
                        if($reponse->getIdQuestion() == $question->getIdQuestion() ){ ?>
                        <div class="reponse">
                            <div class="equipe">
                                <p>L'équipe <?= $reponse->getIdEquipe() ?> a proposé la réponse : </p>
                                <span class="bouton-input-text"> <?= $reponse->getReponse() ?> </span> 
                            </div>
                                <?php if($reponse->getNote()){?>
                                    <ion-icon id="check" name="checkmark-done-outline"></ion-icon>
                                <?php }
                                else{ ?>
                                    <ion-icon id="notCheck" name="close-outline"></ion-icon>
                                <?php }
                                ?>
                            <form action="gestionnaire/addPoint" method="post">
                                <input type="hidden" name="note" value="<?= $reponse->getNote() ?>">
                                <input type="hidden" name="idRep" value="<?= $reponse->getIdReponse() ?>">
                                <input type="hidden" name="idQ" value="<?= $_GET['id'] ?>">
                                <input type="hidden" name="id" value="<?= $reponse->getIdEquipe() ?>">
                                <select name="score" class="bouton-input-text">
                                    <option value=0>0</option>
                                    <option value=1>1</option>
                                    <option value=2>2</option>
                                    <option value=3>3</option>
                                    <option value=4>4</option>
                                    <option value=5>5</option>
                                </select>
                                <input type="submit" value='Noter' class="bouton">
                            </form>
                        </div>
                        <?php }
                    }
                    ?>
                </div>
        <?php } ?>

        </div>

    </div>


<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>