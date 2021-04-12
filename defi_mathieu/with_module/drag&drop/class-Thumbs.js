export class Thumbs extends HTMLCanvasElement
{
    constructor(opts = { "id": null, "class": 'thumbnail' }) {
        
        customElements.define('thumbs', DropArea);
        super();

        this.id = opts.id;
        this.classList.add(opts.class);
        this.style.display = 'inline-block';
    }

    import( file )
    {
        createImageBitmap(file)
        .then((image)=>{
           let ctx = canvas.getContext('2d');
            

            
        });
    }


}