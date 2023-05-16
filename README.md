# IA Pau : Data Challenge website

## Git usage

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
git rebase main                   # récupère modifs de main (ça vous met à jour)
git checkout main                 # on se place sur main
git merge <votre-nom>/<nom-modif> # on fusionne votre branche avec main
```
**/!\ Un merge peut entrainer des conflits, c'est à dire un choix que ```git``` n'arrive pas à faire entre une vieille et une nouvelle modif.**

---

© 2023, CY Tech ING1