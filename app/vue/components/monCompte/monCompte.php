<link rel="stylesheet" href="vue/components/monCompte/monCompte.css">
<div class ="corps">
    <h1 id="titreCompte">Mon Compte</h1>
    <div class="corpsInfo">
        <h2 id="titreInfo">Informations Personnelles</h2>

        <div class="infoUser">
            <div class="user">
                <form action="<?php  echo "/user/updateUser"; ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $user->getId();?>" class="outon-input-text">
                    <div class="ensemble">
                        <p>Nom:</p>
                        <input type="text" name="nom" placeholder=" <?= $user->getNom(); ?>" class="bouton-input-text " required>
                    </div>
                    <div class="ensemble">
                        <p>Prénom:</p>
                        <input type="text" name="prenom" placeholder=" <?= $user->getPrenom(); ?>" class="bouton-input-text " required>
                    </div>
                    <div class="ensemble">
                        <p>Email:</p>
                        <input type="text" name="mail" placeholder=" <?= $user->getMail(); ?>" class="bouton-input-text " required>
                    </div>
                    <div class="ensemble">
                        <p>Etablissement:</p>
                        <input type="text" name="etablissement" placeholder=" <?= $user->getEtablissement(); ?>" class="bouton-input-text " required>
                    </div>
                    <div class="ensemble">
                        <p>Niveau d'étude:</p>
                        <select name="nivEtude" class="bouton-input-text">
                            <option value=""><?= $user->getNivEtude();?></option>
                            <option value="L1">L1</option>
                            <option value="L2">L2</option>
                            <option value="L3">L3</option>
                            <option value="M1">M1</option>
                            <option value="M2">M2</option>
                            <option value="D">Doctorant</option>
                        </select>
                    </div>
                    <div class="ensemble">
                        <p>Numéro de téléphone</p>
                        <input type="text" name="numTel" placeholder=" <?= $user->getNumTel(); ?>" class="bouton-input-text " required>
                    </div>
                    <input type="submit" value="Enregistrer les modifications" class="bouton">
                </form>
            </div>
        </div>
    </div>
    <div class="corpsStat">
        <h2 id="titreStat">Statistiques</h2>
        <ul>
            <li>Membre depuis : <?php
            $moisFrancais = array(
                'January' => 'Janvier',
                'February' => 'Février',
                'March' => 'Mars',
                'April' => 'Avril',
                'May' => 'Mai',
                'June' => 'Juin',
                'July' => 'Juillet',
                'August' => 'Août',
                'September' => 'Septembre',
                'October' => 'Octobre',
                'November' => 'Novembre',
                'December' => 'Décembre'
            );
            // Conversion de la date en timestamp
            $dateTimestamp = strtotime($user->getDateDeb()); 
            // Obtention du nom du mois en anglais
            $moisAnglais = date('F', $dateTimestamp); 
            // Traduction du nom du mois en français
            $moisFrancais = $moisFrancais[$moisAnglais];
            // Obtention de l'année
            $annee = date('Y', $dateTimestamp); 
            $dateFormatee = $moisFrancais . ' ' . $annee;
            echo '<p id="statUser">'.$dateFormatee.'</p>'?></li>
            <li><?php echo '<p id="statUser">'.'0'.'</p>';?> Data Challenges terminés</li>
            <li>En moyenne à la <?php echo '<p id="statUser">'.'0'.'</p>';?> position</li>
        </ul>
    </div>
    <div class="boutonMC">
        <div class="mdp">
            <a id="lien" href="/user?updateMDP&id=<?= $user->getId() ?> ">Réinitialiser mon mot de passe <ion-icon name="arrow-forward-outline"></a>
        </div>
        <div class="contactAdmin">
            <a href="mailto:admin@cy-tech.fr" id="lien" >Contacter un administrateur <ion-icon name="arrow-forward-outline"></ion-icon> </a>
        </div>
    </div>

</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="updateMDP.js"></script>