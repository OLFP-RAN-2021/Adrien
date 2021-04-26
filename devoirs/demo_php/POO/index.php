<?php

// une classe abstraite
include_once 'includes/class-abstractCrayon.php';

// une interface 
include_once 'includes/interface-ecrire.php';

// un trait
include_once 'includes/trait-trouer.php';

// class crayon
include_once 'includes/class-crayon.php';

// class stylo
include_once 'includes/class-stylo.php';

// class anonyme
include_once 'includes/class-anonyme.php';


// Je créer mon stylo
$stylo = new stylo(new $CartoucheEncre('blue'));

// voir classe : stylo 
// $stylo = stylo::getSingleton(new $CartoucheEncre('green'));
// var_dump(stylo::getSingleton());

// le stylo hérite de la méthode de crayon
// $mon_stylo_bleu->dessiner();

// affiche :
// object(stylo)#2 (2) { ["encre":"stylo":private]=> object(class@anonymous)#3 (2) { ["quantite":"class@anonymous":private]=> int(100) ["color":"class@anonymous":private]=> string(4) "blue" } ["color":"crayon":private]=> uninitialized(string) ["trous":"crayon":private]=> int(0) } 
// var_dump($stylo);
// echo '<br>';

$stylo
    ->rediger('Voici un message !')
    ->rediger('Voici le deuxième message !');

// affiche : int(2)
// var_dump(crayon::$nbrDeCrayon); echo '<br>';

// affiche :
// object(stylo)#2 (2) { ["encre":"stylo":private]=> object(class@anonymous)#3 (2) { ["quantite":"class@anonymous":private]=> int(54) ["color":"class@anonymous":private]=> string(4) "blue" } ["color":"crayon":private]=> uninitialized(string) ["trous":"crayon":private]=> int(0) }
// var_dump($stylo);
// echo '<br>';
