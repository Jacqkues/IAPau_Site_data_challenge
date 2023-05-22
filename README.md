# IA Pau : Data Challenge website

## Installation

```bash
npm i                       # installer les dépendences nécessaires
npx parcel src/index.html   # lancer le serveur
```
  
Ouvrir le navigateur à l'adresse : [http://localhost:1234](http://localhost:1234)

## Connexion BDD

Créer un fichier ```src/php/credentials.php``` et y ajouter ce code : 
```php
<?php
define("USER", "<votre user>");
define("PASSWORD", "<votre mot de passe>");
define("HOST", "localhost");
define("BASE", "Challenge");
```

## Créer nouvelle page

- Créer un fichier ```<nom>.html``` dans le dossier ```src/pages```
- Créer un fichier ```<nom>.scss``` dans le dossier ```src/style```
- Importer votre fichier ```<nom>.scss``` MAIS AUSSI ```src/style/global-components.scss```, qui permet d'avoir les styles par défaut (pour les boutons par exemple), et les variables globales (couleurs, paddings, ...). 

## Git usage

### Correction pb connexion git

Le dossier git a été créé avec une méthode de connexion en https, pour éviter une erreur de connexion si vous utilisez SSH, voici la procédure :  
```
git remote remove origin
git remote add origin git@github.com:Jacqkues/IAPau_Site_data_challenge.git
```

### Branches 

**1 modification = 1 branche.**
  
- Créer une branche : 
```bash
git checkout -b <votre-nom>/<nom-modif>
```
  
- Commits :
```bash
git add .
git commit -m "<message>"
```  
- Formattage d'un commit : ```<type>(<scope>): <subject>```  
Où :
  - **type :** feat, fix, docs, style, refactor, test, chore
  - **scope :** nom de la fonctionnalité
  - **subject :** description de la modification

- Envoyer sur github : 
```bash
git push origin <votre-nom>/<nom-modif>
```

- Pour fusionner votre branche avec la branche main : 
```bash
git checkout main
git pull origin main              # s'assurer d'être à jour sur main
git checkout <votre-nom>/<nom-modif>
git rebase main                   # récupère modifs de main (ça vous met à jour)
git checkout main                 # on se place sur main
git merge <votre-nom>/<nom-modif> # on fusionne votre branche avec main
```
**/!\ Un merge peut entrainer des conflits, c'est à dire un choix que ```git``` n'arrive pas à faire entre une vieille et une nouvelle modif.**

- Mettre a jour ```main``` sur github :
```bash
git push origin main
```

---

© 2023, CY Tech ING1