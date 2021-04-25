<?php
//print errors
// ini_set('display_errors', '1');


/**
 * Cette fonction est un tri a bulle. 
 * 
 */
function triabulle(array &$tab)
{
    /**
     * do { ... } while ( cond );
     * FAIRE { code } TANT QUE ( condition == vraie );
     * 
     * Cette boucle s'éxecutera au moins une fois. 
     * Ne serait-ce que pour vérifier qu'il n'y ait pas de changement à faire.
     * 
     * Initialisé à false : le booleen '$chg' va me servir à noter un changement; 
     */
    do {
        $chg = false;

        // $i va parcourir les entrés du tableau
        for ($i = 0; $i < count($tab); $i++) {

            // $n (n pour "next') va représenter la clé de l'élément suivant. 
            $n = $i + 1;

            // si l'élément suivant existe (pour garder une base de comparaison)
            if (isset($tab[$n])) {

                // si les valeurs ne sont pas dans le bon ordre, les inverser
                if ($tab[$i] > $tab[$n]) {
                    $t = $tab[$i];          // |
                    $tab[$i] = $tab[$n];    // | inverse la valeur des deux clés.
                    $tab[$n] = $t;          // |
                    $chg = true;            // faire une autre boucle do-while. 
                }
            }
        }
        // Si un chagement a été opérer : reboublec. Sinon, fermer la boucle.
    } while ($chg);
    // retourner le tableau
    return $tab;
}

// tableau essais
$tab = [42, 0, 1024, 28, -3.14, 128, 256, 13, 56, 4096, -279];
// afficher tableau à trie
echo 'Tableau à trier : ' . "\n<pre>\n" . print_r($tab, 1) . "\n</pre>\n";
// afficher résultet
echo "\n</pre>\n" . print_r(triabulle($tab), 1) . "\n</pre>\n";
