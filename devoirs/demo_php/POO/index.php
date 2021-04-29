<?php

// une classe abstraite
include_once 'includes/class-AbstractCrayon.php';

// une interface 
include_once 'includes/interface-Ecrire.php';

// un trait
include_once 'includes/trait-Trouer.php';

// une class crayon
include_once 'includes/class-Crayon.php';

// une class stylo
include_once 'includes/class-Stylo.php';

// une class anonyme
include_once 'includes/class-anonyme.php';


// Je créer mon stylo
$stylo = new stylo(new $CartoucheEncre('green'));


// voir classe : stylo 
// $stylo = stylo::getSingleton(new $CartoucheEncre('green'));
// var_dump(stylo::getSingleton());

// le stylo hérite de la méthode de crayon
// $mon_stylo_bleu->dessiner();

// affiche :
// object(stylo)#2 (2) { ["encre":"stylo":private]=> object(class@anonymous)#3 (2) { ["quantite":"class@anonymous":private]=> int(100) ["color":"class@anonymous":private]=> string(4) "blue" } ["color":"crayon":private]=> uninitialized(string) ["trous":"crayon":private]=> int(0) } 
// var_dump($stylo);
// echo '<br>';

$stylo->rediger('Voici un message !')
    ->rediger('Voici le deuxième message !');

// affiche : int(2)
// var_dump(crayon::$nbrDeCrayon); echo '<br>';

// affiche :
// object(stylo)#2 (2) { ["encre":"stylo":private]=> object(class@anonymous)#3 (2) { ["quantite":"class@anonymous":private]=> int(54) ["color":"class@anonymous":private]=> string(4) "blue" } ["color":"crayon":private]=> uninitialized(string) ["trous":"crayon":private]=> int(0) }
// var_dump($stylo);
// echo '<br>';
