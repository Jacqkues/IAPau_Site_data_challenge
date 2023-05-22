# IA Pau : Data Challenge website

## Lancer serveur php

```bash
php -S localhost:1234 -t app/   # lancer le serveur
```
  
Ouvrir le navigateur à l'adresse : [http://localhost:1234](http://localhost:1234)

## Connexion BDD

Ouvrir le fichier ```app/lib/DatabaseConnection.php``` et ajuster cette ligne
```php
$this->database = new PDO('mysql:host=localhost;dbname=Challenge;charset=utf8', 'user', 'password');
```

## Créer nouvelle page - nouveau composant

- Créer un dossier dans ```app/vue/components/``` avec le nom de votre composant,
- Y ajouter les fichiers ```<nom>.php```, ```<nom>.css``` et ```<nom>.js``` si nécessaire,
- Importer votre fichier ```<nom>.css``` dans votre fichier ```.php``` MAIS AUSSI ```vue/global-components.css```, qui permet d'avoir les styles par défaut (pour les boutons par exemple). 

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

- Formattage d'un commit : ```<type>(<scope>): <subject>```, avec :

  - **type :** feat, fix, docs, style, refactor, test, chore
  - **scope :** nom de la fonctionnalité
  - **subject :** description de la modification

- Envoyer sur github : 

```bash
git push origin <votre-nom>/<nom-modif>
```

- Pour fusionner votre branche avec la branche main :

```bash
# s'assurer d'être à jour sur la branche main
git checkout main
git pull origin main
# récupérer les modifs de main (ça vous met à jour)
git checkout <votre-nom>/<nom-modif>
git rebase main
# on retourne sur main
git checkout main
# et on fusionne
git merge <votre-nom>/<nom-modif> 
```

**/!\ Un merge peut entrainer des conflits, c'est à dire un choix que ```git``` n'arrive pas à faire entre une vieille et une nouvelle modif.**

- Mettre a jour ```main``` sur github :

```bash
git push origin main
```

---

© 2023, CY Tech ING1