
## to myself

    Rappel de la commande SQL.

```SQL
   CREATE TABLE page ( id INT NOT NULL AUTO_INCREMENT, url varchar(50), title varchar(50), content TEXT, UNIQUE KEY (url), PRIMARY KEY (id) ); 
```

```SQL
   DESCRIBE page;
```

```SQL
    INSERT INTO page VALUES (null, 'test.html', 'test', "content");
```