# PHP

## include

Inclure manuellement un fichier avec `include`.
```php
    include 'path/to/file.php';         // inclure le fichier
    include_once 'path/to/file.php';    // inclure une seule fois le fichier
    require 'path/to/file.php';         // inclure le fichier mais plante si pas possble
    require_once 'path/to/file.php';    // inclure une seule fois mais plante si pas possble
```
### Cas particulier : importer une configuration
Créer un fichier de configuration et qui `return` tableau de valeurs : 
```php
    <?php return [
        'name' => 'PI',
        'value' => 3.1415,
        // etc..
    ];
```

Importer la configuration dans une variable : 
```php
    $config = include 'path/to/file.php';  
```

## Echo 
Pour afficher du contenu en PHP : utiliser l'instruction `echo`.
```php
    echo 'Ma super phrase.';
```

## Variables 
Il est possible de stocker temporairement des objets à l'aide de variables, préfixées d'un `$`.
```php
    $mavariable = 'Ma super phrase.';
    echo $mavariable;
```

## Maths
Les opération mathématiques de bases sont bien sûr disponibles.

### opérateurs mathématiques : 
* additioner `+`
* multiplier `*`
* soustraire `-`
* diviser `/`
* modulo `%`
### fonctions mathématiques :
* round : arrondir
* sqrt *square root* : racine carré
* pow *puissance* : élevation de puissance

### Exemple : ici, calcul de l'hypoténuse (Pythagore).
```php
    $c1 = 3;
    $c2 = 4;
    echo round( sqrt( pow($c1, 2) + pow($c2, 2) ), 2);
    // affiche 5
```


## les tableaux

### tableaux numériques 
```php
    $tableau = [ 42, -5, 3.1415926, 'Adrien', ['sous-tableau'] ];
    
    $tableau[0]; // 42
    $tableau[3]; // 'Adrien'
    $tableau[4][0]; // 'sous-tableau'

    // Ajoute au tableau
    $tableau[] = 'Ajoute une entrée';

    // Ecraser une valeur : 
    $tableau[0] = 58;

    // Effacer une valeur : 
    unset($tableau[0]);

```

### tableaux associatifs 
```php
    $tableau = [ 'surname' => 'Adrien' ];
    $tableau['surname']; // 'Adrien'
```





------------------------------------------

# Les fonctions

PHP permet aussid de faire des fonctions. 

## les paramètres
```php
    function maFonction( $simple, $initialise = null, array $tableaux = [], ...$spread )
    { ... }
```
* `$simple` : paramètre simple mais obligatoire, peut contenir tout et n'importe quoi.
* `$initialise` : paramètre simple mais facultatif car initialisé comme `null`.
* `$tableaux` : paramètre typé : celui ci ne peut contenir que des tableaux, facultatif, initialisé comme tableaux vide.
* `...$spread` : retourne un tableaux de paramètres facultatifs suplémentaires.

## la valeur de retour
Depuis PHP 7.3 il est possible de typer le retour de fonction. Ici, on attend une chaine de caractères.
```php
    function afficheUneChaine() : string
    { 
        return 'Retourne cette chaine.';
    }
```

## fonctions nommées
```php
    function maFonction( $params )
    {
        echo $params;
    }
    // 'Affiche ce texte'
    maFonction('Affiche ce texte');
```

## fonctions anonymes ou `closure`
```php
    $maFoncton = function( $params )
    {
        echo $params;
    }
    // 'Affiche ce texte'
    $maFoncton('Affiche ce texte');
```

## fonctions de rappel ou `callback`
Il possible de passer une fonction comme argument de fonction.

```php
    
    function ceTexte( $param )
    {
        return $param;
    }

    function affiche ( $callback )
    {
        echo $callback();
    }

    // 'Affiche ce texte'
    affiche( ceTexte( 'Affiche ce texte' ) );
```

------------------------------------------

# Orienté objet



```php
    // creation d'un objet quelconque
    $obj = new stdClass();

    // définition des propriétées 
    $props = ['age' => 33, 'prenom' => 'adrien'];
    
    // affiche rien (propriétée non assignées à l'objet)
    echo $obj -> age;               
    
    // assignation : nom = 'age' et  valeur = 33
    foreach( $props as $nom => $valeur ) {
        $obj -> $nom = $valeur;     
    }
    
    // affiche adrien
    echo $obj -> prenom;
                    
    // affiche 33 
    echo $obj -> age;               

```