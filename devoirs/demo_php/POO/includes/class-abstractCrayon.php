<?php

/**
 *  Une class abstraite sert à représenter un comportement constant et générique.
 *  Une class abstraite ne PEUT PAS être instancier ! Donc pas objet !
 *
 * @see https://www.php.net/manual/fr/language.oop5.abstract.php
 */
abstract class abstractCrayon
{
    /**
     * Dessiner est une méthode abstraite dont on définira le code plus tard.
     * 
     * @param string $string;
     * @return void (void = néant, rien, null)
     */
    abstract public function dessiner(string $param): void;

    /**
     * Ecrire est une méthode concrète déjà définie.
     * 
     * @param string $mssg Chaîne à écrire.
     * @return void (void = néant, rien, null)
     */
    public function ecrire(string $mssg): void
    {
        echo $mssg;
    }
}
