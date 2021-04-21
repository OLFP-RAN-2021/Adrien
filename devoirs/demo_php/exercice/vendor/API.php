<?php

/**
 * Petite API Improvisée :.
 *
 *  Pages :
 *      fetch('includes/api.php?page=foo.html')
 *
 *  Articles :
 *      fetch('includes/api.php?article=foo.html')
 * 
 *  Si vous ne précisez pas le contenu de la variable : 
 *  L'API va retourner tout le tableau. 
 *  
 */

// Si url contient la variable page
if (isset($_GET['page'])) {

    // récupréer les pages
    $list = include '../data/pages.php';

    // si page non précisée : tout envoyer
    if (empty($_GET['page'])) {
        sendJson($list);
    } else {
        // parcourir avec une boucle
        foreach ($list as $data) {

            // si entrée existe matche avec la requête
            if ($data['url'] == $_GET['page']) {

                // Envoyer la page demandé
                sendJson($data);
            }
        }
    }
}

// Si url contient la variable article
if (isset($_GET['article'])) {

    // récupréer les articles
    $list = include '../data/articles.php';

    // si page non précisée : tout envoyer
    if (empty($_GET['article'])) {
        sendJson($list);
    } else {
        // parcourir avec une boucle
        foreach ($list as $data) {

            // si entrée existe matche avec la requête
            if ($data['url'] == $_GET['article']) {

                // Envoyer l'article demandé
                sendJson($data);
            }
        }
    }
}

// Sinon : http error code 404 (not found)
// fetch.response.status == 404
http_response_code(404);
exit;


/**
 * Cette fonction transforme un tableau data en JSON et l'envoie automatiquement.
 * @param array data : tableau à envoyer
 * @return void 
 */
function sendJson(array $data): void
{
    // modiefier en-tête http
    header('Content-Type: application/json');

    // formater en JSON et afficher
    echo json_encode($data, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);

    // fin de script
    exit;
}
