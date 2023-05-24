

<div>
    <link rel="stylesheet" href="./vue/components/admin/admin.css">
    <div class="manage-header">
        <h1>Data Challenge</h1>
        <a class="bouton" href="/admin?newData">+ ajouter</a>
    </div>
    

    <div class="list-container">
        <div class="list-header user-info">
            <span>Titre</span>
            <span>Description</span>
            <span>Fin</span>
        </div>
    

        <?php foreach($dataChallenges as  $challenge) { ?>
            
                <div class="list-content">
                    <div class="user-info">
                    <span><?= $challenge->getLibelle() ?></span>
                    <span><?= $challenge->getTempsDebut() ?></span>
                    <span><?= $challenge->getTempsFin() ?></span>
                    </div>
                    <div class="btn-setting">
                        <a href="/admin/deleteChallenge?id=<?= $challenge->getIdChallenge() ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="black" d="M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6v12M8 9h8v10H8V9m7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5Z"/></svg></a>
                        <a href="/admin?config&id=<?= $challenge->getIdChallenge() ?>"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="black" d="M19.9 12.66a1 1 0 0 1 0-1.32l1.28-1.44a1 1 0 0 0 .12-1.17l-2-3.46a1 1 0 0 0-1.07-.48l-1.88.38a1 1 0 0 1-1.15-.66l-.61-1.83a1 1 0 0 0-.95-.68h-4a1 1 0 0 0-1 .68l-.56 1.83a1 1 0 0 1-1.15.66L5 4.79a1 1 0 0 0-1 .48L2 8.73a1 1 0 0 0 .1 1.17l1.27 1.44a1 1 0 0 1 0 1.32L2.1 14.1a1 1 0 0 0-.1 1.17l2 3.46a1 1 0 0 0 1.07.48l1.88-.38a1 1 0 0 1 1.15.66l.61 1.83a1 1 0 0 0 1 .68h4a1 1 0 0 0 .95-.68l.61-1.83a1 1 0 0 1 1.15-.66l1.88.38a1 1 0 0 0 1.07-.48l2-3.46a1 1 0 0 0-.12-1.17ZM18.41 14l.8.9l-1.28 2.22l-1.18-.24a3 3 0 0 0-3.45 2L12.92 20h-2.56L10 18.86a3 3 0 0 0-3.45-2l-1.18.24l-1.3-2.21l.8-.9a3 3 0 0 0 0-4l-.8-.9l1.28-2.2l1.18.24a3 3 0 0 0 3.45-2L10.36 4h2.56l.38 1.14a3 3 0 0 0 3.45 2l1.18-.24l1.28 2.22l-.8.9a3 3 0 0 0 0 3.98Zm-6.77-6a4 4 0 1 0 4 4a4 4 0 0 0-4-4Zm0 6a2 2 0 1 1 2-2a2 2 0 0 1-2 2Z"/></svg></a>
                       
                    </div>
                </div>
            
        <?php } ?>
        </div>
    
</div>