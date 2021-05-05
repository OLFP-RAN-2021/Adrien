# Les Exceptions en PHP

## Dilème : comment rapporter une erreur ?

Dans le cas de la POO : et suivant les principes [SOLID](https://fr.wikipedia.org/wiki/SOLID_(informatique)) : chaque composant du programme devra fonctionner indépendament des autres.

Il faut alors mettre en place un système de repport d'erreur :

-   Écrit en **Orienté Objet**,
-   **Personnalisable**,
-   Capable d'intégrer des **erreurs inaccessibles** à la compilation ou à l'execution de PHP.
    -   **Sans stopper** l'exécution du programme.
    -   Exemple : une erreur de connexion à une base de donnée, elle même étant souvant sur un autre serveur !
-   Et retourne **la pile d'appel**

On peut ainsi, soit renvoyer les erreurs vers un debbuger, soit les journaliser plus facilement.

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



Mon [exemple de la démo](exemple.php).
