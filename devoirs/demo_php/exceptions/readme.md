# Les Exceptions en PHP

## Dilème : comment rapporter une erreur ?

Il existe déjà des fonctions comme `trigger_error()`, mais elles sont **trop limitées** pour des architectures complexes !

Dans le cas de la POO : et suivant les principes [SOLID](<https://fr.wikipedia.org/wiki/SOLID_(informatique)>) : chaque composant du programme devra
fonctionner indépendament des autres.

Il faut alors mettre en place un système de repoort d'erreur :

-   Écrit en **Orienté Objet**,
-   **Personnalisable**,
-   Capable d'intégrer des **erreurs inaccessibles** à la compilation ou à l'execution de PHP.
    - Sans nécéssairement stopper l'exécution du programme.
    - Exemple : une erreur de connexion à une base de donnée, elle même étant souvant sur un autre serveur !


# L'exception

Il s'agit d'un objet de class `Exception` que l'on va instacier avec un message et "jeter" `throw`, dans l'idée de 
"l'attraper" `catch` un peu plus loin dans le programme.

```php 
    throw new Exception("Je ne peux pas diviser par 0.");
```

Nous pourrons la capturer à l'éxecution du code si une erreur surviens.


```php 
    try {

        // try to do something

    } catch (Exception $error) {
        var_dump($error);
    }
```



# Exemples :

Mon [exemple de la démo](exemple.php);

```php
/**
 * Créer une exception personalisée.
 */
class MathException extends LogicException
{
    function __construct(...$params)
    {
        parent::__construct(...$params);
    }
}


/**
 * Ma petite librairie de méthodes mathématiques.
 */
class Math
{
    /**
     * Diviser une valeur.
     *
     * @param int|float $a
     * @param int|float $b
     * @return array
     */
    function divide($a, $b): array
    {
        if (0 == $b) {
            throw new MathException("Je ne peux pas diviser par 0.", 1);
            return null;
        } else {
            return [$a / $b, $a % $b];
        }
    }
}

/**
 * Diviser une valeur.
 *
 * @param int|float $a
 * @param int|float $b
 * @return array
 */
function diviser($a, $b): array
{
    $math = new Math;
    return $math->divide($a, $b);
}

/**
 * Exemple : je tente de diviser par 0.
 * J'attrape les erreurs avec catch(Exception $error)
 */
try {
    var_dump(diviser(4, 0));
} catch (Exception $error) {
    var_dump($error);
}
```
