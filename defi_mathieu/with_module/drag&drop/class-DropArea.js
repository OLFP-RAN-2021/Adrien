import { FileHandler } from "./class-FileHandler.js";

export class DropArea extends HTMLElement {
    constructor(opts = { "id": 'dropArea', "class": 'dropArea' }) {

        // define element
        customElements.define('drop-area', DropArea);

        // construire le parent (HTMLElement)
        super();

        // assigner ID et class
        this.id = opts.id;
        this.classList.add(opts.class);
    }

    /**
     * 
     */
    bind() {
        // debugger

        /**
         * Stop default browser 
         */
        this.addEventListener('dragover', (e) => {
            e.preventDefault();
            this.style.cursor = 'grab';
        });

        /**
         * Move default action to 
         */
        this.addEventListener('drop', (e) => {
            e.preventDefault();

            if (e.dataTransfer.items)
                for (const item of e.dataTransfer.items) {

                    // console.log(item.getAsFile())

                    // récupère chaque objet comme un fichier
                    new FileHandler(item.getAsFile());
                }
        });
    }
}

