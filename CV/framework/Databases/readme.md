
## to myself

    Rappel de la commande SQL.

```SQL
CREATE TABLE urls (id INT NOT NULL AUTO_INCREMENT, url varchar(50), PRIMARY KEY ( id ) );
CREATE TABLE pages (id INT NOT NULL AUTO_INCREMENT, urlid INT NOT NULL, title varchar(50), content TEXT, UNIQUE KEY (urlid), FOREIGN KEY (urlid) REFERENCES urls(id), PRIMARY KEY (id));

INSERT INTO urls VALUES (null, 'accueil.html'),(null, 'a-propos.html'),(null, '404.html');
INSERT INTO pages VALUES (null, 1, 'accueil', 'Accueil du site'), (null, 2, 'A propos', 'Pour en savoir plus.'), (null, 3, '404.html', "Cette page n'existe pas");

```

```SQL
   DESCRIBE page;
```

```SQL
    INSERT INTO page VALUES (null, 'test.html', 'test', "content");
```