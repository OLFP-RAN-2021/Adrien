
<?php
ini_set("display_errors", '1');



/**
 *  Une class abstraite sert à représenter un comportement constant et générique.
 *  Une class abstraite ne PEUT PAS être instancier ! Donc pas objet !
 * 
 * @see https://www.php.net/manual/fr/language.oop5.abstract.php
 */
abstract class abstractCrayon
{
    public function dessiner($param) {
        // ... 
    }
    abstract public function ecrire(string $mssg): void;
}

/**
 *  Une interface ouvre un méta-langage :
 *  Permet de pré-définir le comportement attendu : 
 * 
 *  Tout objet implémentant ecrire devra avoir une fonction ecrire(). 
 *  Cepandant, vous êtes libre d'écrire le corps de la fonction comme vous voulez. 
 * 
 *  @see https://www.php.net/manual/fr/language.oop5.interfaces.php
 * 
 */
interface ecrire
{
    function ecrire(string $mssg): void;
} 

/** 
 * Le trait ajoute un comportement supplémentaire aux classes.
 * Chaque instance de la classe qui utilise ce trait peut faire des trous.
 * 
 * @see https://www.php.net/manual/fr/language.oop5.traits.php
 */
trait trouer
{
    // chaque instance peut faire des trous.
    private $trous = 0;

    // sert à trouer des feuilles
    function trouer()
    {
        $this->trous++;
    }
}

/**
 * La classe anonyme se déclare dans une variable.
 * Elle conserve les propriétés d'une class normale, 
 * à ceci près que la class n'est accessible que par
 * la variable dans laquelle on l'a déclaré. 
 * 
 * Elle s'instencie comme une fonction "closure". 
 * 
 * @see https://www.php.net/manual/fr/language.oop5.anonymous.php;
 */
 


$CartoucheEncre = new class
{
    // private : 
    private $quantite = 100;

    private $color;

    function __construct(string $color = 'red')
    {
        $this->color = $color;
    }

    function getColor()
    {
        return $this->color;
    }

    /**
     * Finale signifie que la méthod ne sera pas modifialble
     * par les enfants.
     */
    final function couler()
    {
        if ($this->quantite > 0) {
            $this->quantite--;
            return true;
        }
        return false;
    }
};
// Elle s'instencie comme une fonction "closure". 
$obj = new $CartoucheEncre( $params );



/**
 * crayon objet generique simple.
 * 
 */
class crayon extends abstractCrayon implements ecrire
{
    /**
     * @use Import le trait trouer{}.
     * Ce qui permet au crayon de trouer les feuilles... 
     */
    use trouer;

    /**
     * @var string contient la couleur du crayon
     */
    private $color;

    /**
     * @static Compter le nombre de crayon (tout genre confodus)
     * NB : la proprétié static appartient à la CLASS (pas des instances)
     */
    static $nbrDeCrayon = 0;


    /**
     * constructeur de crayon
     */
    function __construct(string $color = 'darkblue')
    {
        // je compte un crayon de plus
        self::$nbrDeCrayon++;
        $this->color = $color;
    }

    /**
     * function dessiner 
     * ecrase la fonction abstraite
     */
    public function dessiner($param)
    {
        // ...
    }

    /**
     * function ecrire
     */
    public function ecrire(string $mssg): void
    {
        echo '<span style="color:' . $this->color . ';">' . $mssg . '</span>';
    }
}


/**
 * Le stylo est une forme de crayon.
 * Il hérite donc de certaines propriétées et méthodes du crayon
 * 
 */
class stylo extends crayon
{
    /**
     * @var object cartouche d'encre
     */
    private $encre;

    /**
     * @static objet unique instencié depuis la classe courante et stocké par mla classe
     */
    private static $singleton = null;

    /**
     * Constructeur du stylo.
     * 
     * @param string color
     */
    function __construct(object $cartouche)
    {

        // j'initialise le parent
        // parent:: est un 'appel static'
        // Je change la couleur par dfault du crayon par celle du stylo
        parent::__construct($cartouche->getColor());

        $this->encre = $cartouche;
    }

    /**
     * Instancie l'objet de la class et le stock dans ma variable singleton
     * 
     * @param mixed : Paramètres du constructeur de classe.
     * @return \stylo : Retourne le singleton : un instance de style. 
     * 
     * C'est quoi ...$param ?
     * Pour des raisons pratique : j'utilise un spread operator !
     * Il sert à représenter un tableau de paramètres.
     * 
     * @see : https://www.php.net/manual/fr/migration56.new-features.php
     * 
     */
    static function getSingleton(...$params)
    {
        if (self::$singleton == null) {
            self::$singleton = new self(...$params);
        }
        return self::$singleton;
    }

    /**
     * Methode pour ecrire en parcourant les caractères.
     * Mon stylo perds 1 encre par charactère écris.
     * 
     * @param string $mssg : text to print
     * @return void
     * 
     */
    final function rediger(string $mssg)
    {
        $ecrire = '';

        //parcourir chaque caractères 
        foreach (str_split($mssg) as $caracter) {

            // si il me reste de l'encre
            if ($this->encre->couler()) {

                // ajouter à la chaine de
                $ecrire .= $caracter;
            }
        }

        // j'écris le message
        parent::ecrire($ecrire . '<br>');

        // pour ecrire plusieur fois avec le même stylo
        return $this;
    }
}

// Je créer mon stylo
$stylo = new stylo(new $CartoucheEncre('blue'));
// $mon_stylo_rouge = new stylo('red');

// $stylo = stylo::getSingleton('green');
// var_dump(stylo::getSingleton());

// le stylo hérite de la méthode de crayon
// $mon_stylo_bleu->dessiner();

// affiche : 
// object(stylo)#1 (3) { ["encre":"stylo":private]=> int(100) ["color":"crayon":private]=> string(4) "blue" ["trous":"crayon":private]=> NULL }
// var_dump($stylo); echo '<br>';

$stylo->rediger('Voici un message !');

$stylo->rediger('Voici le deuxième message !');

// affiche : int(2) 
// var_dump(crayon::$nbrDeCrayon); echo '<br>'; 

// affiche : 
// object(stylo)#1 (3) { ["encre":"stylo":private]=> int(54) ["color":"crayon":private]=> string(4) "blue" ["trous":"crayon":private]=> NULL } 
// var_dump($stylo); echo '<br>';
