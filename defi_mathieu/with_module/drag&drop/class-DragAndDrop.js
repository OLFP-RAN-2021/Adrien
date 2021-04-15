import { DropArea } from "./class-DropArea.js";
import { ThumbsArea } from "./class-ThumbsArea.js";

export class DragAndDrop
{
    constructor(param)
    {
        this.dropArea = new DropArea( param.DropArea );
        this.ThumbsArea = new ThumbsArea( param.ThumbsArea );
        
        this.dropArea.bind();
        
        let dropmodule = document.getElementById(param.DropTagId);
        dropmodule.appendChild(this.dropArea);
        dropmodule.appendChild(this.ThumbsArea);
 
    }

}