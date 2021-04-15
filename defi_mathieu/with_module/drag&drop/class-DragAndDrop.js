import { DropArea } from "./class-DropArea.js";

export class DragAndDrop
{
    constructor(param)
    {
        this.dropArea = new DropArea( param.DropArea );
        this.dropArea.bind( (file) => { console.log(file) } );
        
        let dropmodule = document.getElementById(param.DropTagId);
        dropmodule.appendChild(this.dropArea);
 
    }

}