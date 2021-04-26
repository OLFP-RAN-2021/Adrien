<?php

/** 
 * Le trait ajoute un comportement supplémentaire aux classes.
 * Chaque instance de la classe qui utilise ce trait peut faire des trous.
 *
 * @see https://www.php.net/manual/fr/language.oop5.traits.php
 */
trait Trouer
{
    // chaque instance peut faire des trous.
    private int $trous = 0;

    // sert à trouer des feuilles
    public function trouer(): void
    {
        ++$this->trous;
    }
}
