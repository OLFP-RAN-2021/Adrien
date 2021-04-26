<?php

/**
 *  Une interface ouvre un méta-langage :
 *  Permet de pré-définir le comportement attendu :.
 *
 *  Tout objet implémentant ecrire devra avoir une fonction ecrire().
 *  Cepandant, vous êtes libre d'écrire le corps de la fonction comme vous voulez.
 *
 *  @see https://www.php.net/manual/fr/language.oop5.interfaces.php
 */
interface Ecrire
{
    public function ecrire(string $mssg): void;
}
