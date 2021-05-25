# 

Dans l'état actuel : on va opérer des reqêtes simple.

    PS : les dossiers `SQLElement` et `SQLQueries` seront développés ultérieurement pour construire une réprensentation complète des tables et des structures de données.


## 1. Requête simple retournant un tableu.

```php
<?php
    $data = Query::on()
        ->select()
        ->from('pages')
        ->execute()
        ->fetchAll(\PDO::FETCH_ASSOC);

    echo '<pre>' . print_r($data, 1) . '</pre></br>';
```

Will return :

```
Array
(
    [0] => Array
        (
            [id] => 1
            [urlid] => 1
            [title] => accueil
            [content] => Accueil du site
        )

    [1] => Array
        (
            [id] => 2
            [urlid] => 2
            [title] => A propos
            [content] => Pour en savoir plus.
        )

    [2] => Array
        (
            [id] => 3
            [urlid] => 3
            [title] => 404.html
            [content] => Cette page n'existe pas
        )
)
```

## 2. Requête imbriquée et jointure à gauche retrounée dans une callback.

```php
<?php
   $data = Query::on()
        ->select()
        ->from('pages')
        ->join('id', 'pages_meta.id', SQL::JOIN_LEFT)
        ->nest(
            'urlid',
            Query::on()
                ->select('id')
                ->from('urls')
                ->where('url', SQL::EQUAL, 'accueil.html')
        )
        ->execute()
        ->fetch();
```

Will return :

```
Array
(
    [0] => Array
        (
            [id] => 1
            [urlid] => 1
            [authorid] => 1
            [title] => accueil
            [content] => Accueil du site
            [keyword] => accueil
            [categorie] => page
            [publication] => 2021-05-18 18:27:16
            [edition] => 
        )
)
```


## 3. Insert 

```php
    Query::on()
        ->insert(
            'urls',
            [
                [null, 'test.html'],
                [null, 'test1.html'],
                [null, 'test2.html']
            ],
        )
        ->execute()
        ->fetch();

```




## to myself

    Rappel de la commande SQL.

    Vais je supprimer SQLElements ? 

```SQL
CREATE TABLE urls (
    id INT NOT NULL AUTO_INCREMENT, 
    url VARCHAR(50), 
    PRIMARY KEY ( id ) );

CREATE TABLE pages_meta (
    id INT NOT NULL AUTO_INCREMENT, 
    keyword VARCHAR(250),
    categorie VARCHAR(50),
    publication DATETIME, 
    edition DATETIME,
    PRIMARY KEY (id));

CREATE TABLE pages (
    id INT NOT NULL AUTO_INCREMENT, 
    urlid INT NOT NULL, 
    authorid INT NOT NULL, 
    title VARCHAR(50), 
    content TEXT, 
    UNIQUE KEY (urlid), 
    FOREIGN KEY (urlid) 
    REFERENCES urls(id), 
    -- FOREIGN KEY (authorid) 
    -- REFERENCES users(id), 
    PRIMARY KEY (id));

INSERT INTO urls VALUES 
    (null, 'accueil.html'),
    (null, 'a-propos.html'),
    (null, '404.html');

INSERT INTO pages VALUES 
    (null, 1, 1, 'accueil', 'Accueil du site'), 
    (null, 2, 1, 'A propos', 'Pour en savoir plus.'), 
    (null, 3, 0, '404', "Cette page n'existe pas");

INSERT INTO pages_meta VALUES 
    (null, 'accueil', 'page', 'CURRENT_TIME()', null), 
    (null, 'A propos', 'page', 'CURRENT_TIME()', null), 
    (null, '404', 'page', 'CURRENT_TIME()', null);

```

```SQL
   DESCRIBE page;
```

```SQL
    INSERT INTO page VALUES (null, 'test.html', 'test', "content");
```
