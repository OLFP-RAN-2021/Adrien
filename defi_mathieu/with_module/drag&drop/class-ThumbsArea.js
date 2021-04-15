
export class ThumbsArea extends HTMLElement {
    constructor(opts = { "id": 'thumbsArea', "class": 'thumbsArea' }) {

        // define element
        customElements.define('thumbs-area', ThumbsArea);

        // construire le parent (HTMLElement)
        super();

        // assigner ID et class
        this.id = opts.id;
        this.classList.add(opts.class);
    }
}

