
/**
 * 
 * @param {*} event 
 */
function dropHandler(event) 
{
    event.preventDefault();

    if (event.dataTransfer.items)
    for(const item of event.dataTransfer.items) {
        
        // récupère chaque objet comme un fichier
        let file = item.getAsFile();
        // console.log(file.stream());

        createImageBitmap(file)
        .then((image)=>{
            console.log(image);
            
            let imgurl = URL.createObjectURL(image);
            // console.log(imgurl);    
        
            // Afficher le résultat
            let target = document.getElementById('printResult');
            let img = document.createElement('img');
            
        
            img.setAttribute('src', imgurl);
            target.appendChild(img);

        });
        // console.log(htmlImageElement);

        // Créer une url pour le fichier
        // let imgurl = URL.createObjectURL(file);
        // // console.log(imgurl);    
    
        // // Afficher le résultat
        // let target = document.getElementById('printResult');
        // let img = document.createElement('img');
        
        // img.setAttribute('width', '200');
        // img.setAttribute('height', '150');

        // img.setAttribute('src', imgurl);
        // target.appendChild(img);

    }
}





/**
 * Kill default action of browser
 * @param {*} ev 
 */
function dragOverHandler(ev) {  
    // Prevent default behavior (Prevent file from being opened)
    ev.preventDefault();
  }
  