
/**
 * Définir une classe qui représente l'objet que vous voulez créer. 
 * Étendez la avec l'interface HTMLElement.
 * Puis contruisez la comme un objet classique. 
 */

class MyCustomObject extends HTMLElement
{
    /**
     * 
     * @param {*} content 
     * @param {*} id 
     * @param {*} classes 
     */
    constructor(content = null, id = null, classes = null)
    {
        
        // Avant toutes choses !
        
        // Déclarer notre objet à JS
        customElements.define('my-custom-object', MyCustomObject);

        // Appeler le constructeur parent.
        super();
        
        // Attribuer ID et Classes.
        this.id = id ?? null;
        if (classes != null) this.classList.add(classes); 

        // Appliquez du style si besoin.
        this.style.display = 'block';

        // Définir le contenu.
        this.innerHTML = content;

    }

    /**
     * Methode pour associer un listener
     * 
     * @param {*} event     : event to listen
     * @param {*} callable  : callable
     * @param {*} pf (true) : faire sauter le comportement par défault de JS.
     */
    bindEvent(event, callable, pf = true)
    {
        this.addEventListener(event, (e)=>{
            if (pf) e.preventDefault();
            return callable(e);
        })
    }

    /**
     *  Si besoin : ajoutez des méthodes décrivant le comportement de votre objet. 
     */
}