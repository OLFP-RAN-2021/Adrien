# Programmation Orientée Objet

Exemple (presque) complet de OOP en PHP.

Contient :

-   1 [index.php](index.php),
-   6 classes :
    -   Une classe abstraite [AbtractCrayon](includes/class-AbstractCrayon.php),
    -   Une classe anonyme [$CartoucheEncre](includes/class-anonyme.php),
    -   Deux classes concrètes (dont un héritage chaîné depuis la classe abstraite),
        -   [Crayon](./includes/class-Crayon.php)
            -   hérite de [AbtractCrayon](includes/class-AbstractCrayon.php),
            -   implémente interface [Ecrire](includes/interface-Ecrire.php),
            -   utilise le trait [Trouer](includes/trait-Trouer.php),
        -   [Stylo](includes/class-Stylo.php)
            -   hérite de [Crayon](includes/class-Crayon.php),
    -   Un trait [Trouer](includes/trait-Trouer.php),
    -   Une interface [Ecrire](includes/interface-Ecrire.php),
-   2 designs patterns :
    -   Un fluent
    -   Un singleton

-------------

Tout ça pour faire un `index.php` :

```php
    $stylo = stylo::getSingleton(new $CartoucheEncre('green'));
    $stylo
        ->rediger('Voici un message !')
        ->rediger('Voici le deuxième message !');
```
Qui affiche en vert :

```
    Voici un message !
    Voici le deuxième message !
```