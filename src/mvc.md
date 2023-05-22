# Architecture du projet  

- MVC : Model View Controller
```
    app/
    controllers/
            home.php
            user.php
        models/
            user.php
        views/
            home.php
            user.php
    public/
        css/
        js/
        index.php
    config/
        database.php
    core/
        router.php    
``` 

- modele est l'ensemble des fichiers qui peuvent interagir avec la base de données

- view est l'ensemble des fichiers qui peuvent interagir avec l'utilisateur

- controller est l'ensemble des fichiers qui peuvent interagir avec le modele et la vue

## Exemple :
model :
```php 
    function get_user($id){
        $sql = "SELECT * FROM user WHERE id = $id";
        return $sql;
    }
```

view: 
```php

    <h1>Mon profil</h1>
    <p>Mon nom est <?= $user->name ?></p>
    <p>Mon email est <?= $user->email ?></p>
```

controller:
```php
        require 'models/user.php';
        $user = get_user($id);
        require 'views/profil.php';
    
```

tips : au lieu de faire 
```php
    <?php echo $user->name ?>
```
on peut faire 
```php
    <?= $user->name ?>
```