<?php 

/**
 * Fonction Récursive
 * Pratique pour explorer une aborescance dont vous ignorez la profondeur. 
 * 
 * @param string $path : chemin à parcourir
 * @return array $list : liste de fichiers trouvées
 */
function browse(string $path)
{
    // liste de fichier à retrourner
    $return = [];

    // faire une liste du contenu du dossier demandé
    $folder = glob($path.'/*');

    // parcourir le contenu d'un dossier dans la variable $file
    // qui représente un fichier ou dossier à chaque boucle
    foreach ($folder as $file) {
        
        // le chemin est un dossier : appeler la fonction en elle même
        // et ajouter à la liste le résultat de la fonction interne.
        if (is_dir($file)) {
            $return[] = browse($file);
        } 
        //  sinon, ajouter le fichier à la liste
        else {
            $return[] = $file;
        }
    }

    //  retrurner la liste
    return $return;var_dump(browse('./dossier'));
}

// executer la fonction browse :
var_dump( browse('./dossier') );
//  PS : var_dump = console.log() mais en PHP !