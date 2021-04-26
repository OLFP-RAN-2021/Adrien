# Tri à bulles

Considérons le tableau `$tab` suivant.

| 0 | 1 | 2 | 3 | 4 |
|:---:|:---:|:---:|:---:|:---:|
| 42 | 0 | 1024 | 28 | 32 |

Nous devons le trier à  l'aide d'un algorithme nommé tri à bulles. 

----------------------------------

## Principe théorique

Pour réaliser un tri à bulles, je dois, pour chaque entrée du tableau, la comparer avec la suivante, et inverser si besoin.

Plus d'infos et une animation sympa sur [Tri à bulles | Wikipédia](https://fr.wikipedia.org/wiki/Tri_%C3%A0_bulles).

----------------------------------

## Dans le code source.

La boucle `for ($i = 0; $i < count($tab); $i++)` va nous permettre de parcourir le tableau `$tab` en appellant les clés une à une avec `$tab[i]`.

Pour opérer une comparaison avec la clé suivante : 

| 0 | 1 | 2 | 3 | 4 |
|:---:|:---:|:---:|:---:|:---:|
| 42 | 0 | 1024 | 28 | 32 |
| `[ 42 ? 0 ]` | | | | |
| 0 | 42 | 1024 | 28 | 32 |       
| | `[ 42 ? 1024 ]`| | | |
| 0  | 42 | 1024 | 28 | 32 |         
| | | `[ 1024 ? 28 ]` | |         
| 0 | 42 | 28 | 1024 | 32 |      
| | | |  `[ 1024 ? 32 ]` |         

etc.

on otient la logique suivante :

```
    POUR ( entree = 0 ; entree < COMPTER(tableau) ; entree + 1 )
        
        suivante = entree + 1
        
        SI ( tableau[entree] > tableau[suivante] )
            
            transfert = tableau[entree]
            tableau[entree] = tableau[suivante]
            tableau[suivante] = transfert
```

----------------------------------

## Triage incomplet

Le problème, c'est qu'a la fin de la première boucle `for()` :
on va retrouver un tableau mal trié ! Et une boucle `for()` ne peut pas, soudainement, changer de sens ! 

> | 0 | `42` | `28` | 32 | 1024 | 

Du coup, vous aurez besoin d'une deuxième boucle, qui _"réitinitialise"_ notre `for()`.

Raison pour laquelle le tout sera encapsulé dans une boucle `do {} while()`.

On va privilégier une boucle `do {} while()` pour deux raisons : 

- Executant le code au moins une fois, on peut s'assurer si le tableau entrée est déjà trié.
- En ajoutant un booléen : un peu executer la boucle autant de fois que nécéssaire. 

```
    FAIRE 

        changement = faux

        POUR ( entree = 0 ; entree < COMPTER(tableau) ; entree + 1 )
            
            suivante = entree + 1
            
            SI ( tableau[entree] > tableau[suivante] )
                
                transfert = tableau[entree]
                tableau[entree] = tableau[suivante]
                tableau[suivante] = transfert
                changement = vrai

    TANT QUE ( changement === vrai )
```

----------------------------------

## Exemple

En PHP celà nous donne :

```php 
/**
 * Cette fonction est un tri a bulles. 
 * 
 * @param array $tab : tableau à trier.
 * @return array $tab : le tableau trié.
 */
function triabulles(array $tab): array
{
    /**
     * do { ... } while ( cond );
     * FAIRE { code } TANT QUE ( condition == vraie );
     */
    do {
        // boolen changement
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
    // retourner le tableau trié.
    return $tab;
}
```




```

partitionner(tableau T, entier premier, entier dernier, entier pivot)
    échanger T[pivot] et T[dernier]  // échange le pivot avec le dernier du tableau , le pivot devient le dernier du tableau
    j := premier
    pour i de premier à dernier - 1 // la boucle se termine quand i = (dernier-1).
        si T[i] <= T[dernier] alors
            échanger T[i] et T[j]
            j := j + 1
    échanger T[dernier] et T[j]
    renvoyer j

tri_rapide(tableau T, entier premier, entier dernier)
    si premier < dernier alors
        pivot := choix_pivot(T, premier, dernier)
        pivot := partitionner(T, premier, dernier, pivot)
        tri_rapide(T, premier, pivot-1)
        tri_rapide(T, pivot+1, dernier)
```