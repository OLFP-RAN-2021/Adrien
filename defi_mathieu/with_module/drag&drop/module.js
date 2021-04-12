/**
 * Import drop area class
 */
import { DropArea } from "./class-DropArea.js";
import { MyFile } from "./class-File.js";

var FILES = [];

let file = new MyFile();
file.load('drag&drop/class-File.js');

/**
 * 
 */
let myDrop = new DropArea( {"id":'dropArea', "class":'myClass'} );
myDrop.bind( (file, image) => { console.log(image) } );

console.log(myDrop);
