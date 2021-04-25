

/**
 * 
 * @param {*} nbr 
 * @returns {array} 
 */
function makeRandom(nbr = 20) {
    nbr = nbr < 100 ? nbr : 100;
    let tab = [];
    while (tab.length < nbr) {
        tab.push(Math.floor(Math.random() * 100));
    }
    return tab;
}

// function makeGraphique(tab){
//     let str = '<div>';
//     for (let i = 0; i<tab.length; i++){
        
//         str =+ '<div id="entry_'+i+'">'+i+'</div>';
//         str =+ '<div id="entry_'+i+'">'+i+'</div>';
//         // let str =+ ;
//     }
//     str =+ '</div>';
//     return str;
// }

/**
 * affiche un tableau
 * 
 * @param {*} tab 
 * @returns 
 */
function printtab(tab = [])
{
    let str = '[';
    let sum = 0;
    for (let i = 0; i<tab.length; i++){
        str = str + ' '+ tab[i] +' ';
        sum = sum + tab[i];
    }
    return str + '] (n = '+tab.length+' - Σ(n) = '+sum+' )';
}


/**
 * Triage à chariot.
 * Même principe que le tri à bulles.
 * Mais on autorise la bulle à "reculer". 
 *
 * @param {*} tab
 */
function triAChariot(tab = []) {
    // variable de transfert
    let t;

    // identifie la clé suivante (n = next)
    let n;

    // identifie la clé précédente (p = previous)
    let p;
    
    for (let i = 1; i < tab.length - 1; i++) {
        // inversion simple
        n = i + 1;
        if (tab[n] != null && tab[i] > tab[n]) {
            t = tab[i];
            tab[i] = tab[n];
            tab[n] = t;
        }

        // tester le précédant
        p = i - 1;

        if (tab[p] != null && tab[p] > tab[i]) {
            
            // faire reculer le chariot
            for (let c = i; c > 0; c--) {
                p = c - 1;
                if (tab[p] > tab[c]) {
                    // inversion simple
                    t = tab[c];
                    tab[c] = tab[p];
                    tab[p] = t;
                    continue;
                    // continuer la boucle
                } 
                // arreter le recul
                break;
            }
        }
    }
    return tab;
}
