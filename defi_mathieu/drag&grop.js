
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
            
            let canvas = document.createElement('canvas');
            let ctx = canvas.getContext('2d');


            let resizer = document.getElementById('resize');
            let tw = parseInt(resizer.value) ?? 200;

            // Hauteur en conservant le ratio
            let th = Math.floor(tw * (image.height/image.width));

            console.log('tw = '+tw+'px; th = '+th+'px;')
            // console.log((image.height/image.width))
            // console.log((th/tw))

            canvas.width = tw;
            canvas.height = th;

            let turn = parseInt(document.getElementById('rotation').value);
            switch (turn) 
            {
                case 90:
                    canvas.width = th;
                    canvas.height = tw;

                    ctx.rotate((90 * Math.PI / 180));
                    ctx.translate(0, (th*-1));
                break;

                case 180:
                    ctx.rotate((180 * Math.PI / 180));
                    ctx.translate((tw*-1), (th*-1));
                break;

                case 230:
                    console.log('rotate 230')
                    canvas.width = th;
                    canvas.height = tw;

                    ctx.rotate((-90 * Math.PI / 180));
                    ctx.translate((tw*-1), 0);
                break;

                default:
                break;
            }

            /**
             * @param img
             * @param int algin in x in source img
             * @param int algin in y in source img
             * @param int get x px in lenght of source img
             * @param int get y px in height of source img
             * @param int algin in x in canvas
             * @param int algin in y in canvas
             * @param int canvas x px width in piXels
             * @param int canvas Y px height in piXels
             */
            ctx.drawImage(image, 0, 0, image.width, image.height, 0, 0, tw, th);
            // ctx.rotate((90 * Math.PI / 180));

            // console.log(ctx);
            let target = document.getElementById('printResult');
            target.appendChild(canvas);

        });
 
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
  

  function clean()
  {
      document.getElementById('printResult').innerHTML = '';
  }