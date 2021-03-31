# Exemple de fonction récusrsive en PHP

La fonction récursive permet dexplorer une aborescance dont vous ignorez la profondeur.
Vous évitez ainsi d'empiler les boucles les unes dans les autres manuellement : une seule doit suffire.


Voici un exemple de dossier à explorer.
```
    index.php
    dossier/
        foot.txt
        sous-dossier/
            bar.yaml
```

Voici un exemple de retour (script appelé en console):
```shell
$ php index.php 
array(2) {
  [0] => string(17) "./dossier/foo.txt"
  [1] => array(1) {
    [0]=> string(31) "./dossier/sous-dossier/bar.yaml"
  }
} 

```