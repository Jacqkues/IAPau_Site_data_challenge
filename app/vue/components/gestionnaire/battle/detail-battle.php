
<link rel="stylesheet" href="vue/components/gestionnaire/battle/detail-battle.css">
<link rel="stylesheet" href="./vue/components/gestionnaire/gestionnaire.css">

<div class="corps" >
    <h1>Data Battle : <?= $battle->getLibelle() ?></h1>
    <div class="info">
        <h3>Information sur la Data Battle:</h3>
        <ul>
            <li>Date de début : <span> <?= $battle->getTempsDebut(); ?> </span></li>
            <li>Date d'arrêt : <span> <?= $battle->getTempsFin(); ?> </span> </li>
            <li>        <?php 
            if($battle->getIsPublied()){
        ?>
        La Data Battle est publiée
        <?php
            }
            else{
        ?>
        La Data Battle n'est pas encore publiée
        <?php }?></li>
        </ul>
    </div>

    <div class="questionnaire">
        <h3>Questionnaires du data challenge</h3>

        <div class="manage-header">
            <a class="bouton" href="/gestionnaire?addQuestionnaire&id=<?= $_GET['id'] ?>">Ajouter</a>
        </div>
        <div class="list-container">
            <div class="list-header user-info">
                <span class="challenge-title">Lien</span>
                <span>Debut</span>
                <span>Fin</span>
            </div>
        <?php 
            foreach($questionnaires as $questionnaire){?>
            <div class="list-content">
                <div class="user-info">
                    <span class="challenge-title"><a href="<?= $questionnaire->getLien() ?>"> <?= $questionnaire->getLien() ?> </a></span>
                    <span><?= $questionnaire->getDebut() ?></span>
                    <span><?= $questionnaire->getFin() ?></span>
                    <a class="bouton" href="/gestionnaire?modifQuestion&id=<?= $questionnaire->getId() ?>">Questions</a>
                    <a class="bouton" href="/gestionnaire?Reponse&id=<?= $questionnaire->getId() ?>">Réponses</a>
                    <a href="/gestionnaire/deleteQuestionnaire?id=<?= $questionnaire->getId() ?>&idB=<?= $_GET['id'] ?>"><ion-icon name='close-outline'></ion-icon></a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>