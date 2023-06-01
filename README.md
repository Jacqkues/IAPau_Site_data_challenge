# IA Pau : Data Challenge website

Site web pour administrer, manager et participer aux Data Challenges de l'association IA Pau.

## Lancer l'api Java

```bash
cd analyse_code
java CodeAnalyserAPI.java
```

## Lancer un serveur php

```bash
php -S localhost:1234 -t app/   # lancer le serveur
```
  
Ouvrir le navigateur à l'adresse : [http://localhost:1234](http://localhost:1234)

## Installer installer la base de données

Ouvrir un client MySQL, et exécuter le script d'installation :
```SQL
source app/sql/bdd.sql
```

## Connexion à la base de données

Ouvrir le fichier ```app/lib/DatabaseConnection.php``` et ajuster cette ligne
```php
$this->database = new PDO('mysql:host=localhost;dbname=Challenge;charset=utf8', 'user', 'password');
```
en remplacant ```user``` et ```password``` par vos identifiants.


## Créer un administrateur

Procédure à suivre pour créer un administrateur à la mise en place du site :

- Ouvrez un navigateur à l'url du serveur php lancé précédemment : [http://localhost:1234/](http://localhost:1234/).
- Cliquez sur le bouton ```Inscription``` en haut à droite, puis inscrivez-vous comme si vous étiez un utilisateur quelconque.
- Ouvrez un client MySQL, et exécutez la requête suivante :
```SQL
USE challenge;
UPDATE user SET types = "admin" WHERE idUser = 1;
COMMIT;
```
- Sur le site, déconnectez-vous puis reconnectez-vous. Vous êtes maintenant administrateur.

---

© 2023, CY Tech ING1