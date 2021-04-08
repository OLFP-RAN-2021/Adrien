
function dropHandler(event) 
{
    event.preventDefault();

    if (event.dataTransfer.items)
    for(const item of event.dataTransfer.items) {
        

        console.log(item);
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
  