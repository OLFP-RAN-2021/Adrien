
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
    bind(callback) {
        /**
         * Stop default browser 
         */
        this.addEventListener('ondragover', (e) => {
            e.preventDefault();
            this.style.cursor = 'grab';
        });

        /**
         * Move default action to 
         */
        this.addEventListener('ondrop', (e) => {
            e.preventDefault();

            if (e.dataTransfer.items)
                for (const item of e.dataTransfer.items) {

                    // récupère chaque objet comme un fichier
                    let file = item.getAsFile();

                    createImageBitmap(file)
                    .then((image) => {
                        // console.log(image);
                        callback(file, image);

                    });
                }
        });
    }
}

