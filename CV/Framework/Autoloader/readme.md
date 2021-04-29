# Autoloader

Peut charger les composants totalements compatibles PSR-4 comme Yaml, et les "moins" standards comme Twig (dont le namespace ne reflète pas fidèlement la structure des dossiers avec son fichu "src/"). 

Fonctionne à l'aide d'une classes statique et de son trait.

## usage

### Basic : recursive browsing

The recursive browsing help PHP to looking a file in complex directory.

* Also the class :

```
    \MyNamespace\Loader\MyClass
 ```

* Can be stored in :

```
    Vendor/mything/src/Loader/default/MyClass.php
``` 

### Advanced : direct include

For an optimal working.

Add your directory to registre like : 

```php
    'MyNamespace' => 'Vendor/MyNamespace/src/',
```

Be sure namespace matching clearly with componants folders. 
 
 ```
    \MyNamespace\Loader\MyClass
 ```

Must be stored in tranparent folder

```
    Vendor/MyNamespace/src/Loader/MyClass.php
``` 
Like i did for my Framework.