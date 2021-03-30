
/**
 * 
 * @param {*} id 
 */
export function popup(id)
{
    let popup = document.createElement('div');
    popup.classList.add('popup-background');

    let popupContent = document.createElement('div');
    popupContent.classList.add('popup-container');

    let elem = document.getElementById(id);
    if (elem !== null){
        
        /*
         *  La bonne idée, s'était de cloner le node. 
         *  Le hic : c'est que ça clone pas l'event du node ! 
         *  Donc je déplace juste l'élément, c'est plus simple
         */
        let origin = elem.parentElement;
        
        
        elem.classList.remove('hidden');
        popupContent.appendChild(elem);
        
        window.addEventListener('keydown', (e)=>{
            if (e.key == 'Escape') {
                document.getElementById('body').removeChild(popup);
                origin.appendChild(elem);
            }
        });
        
        let closeButton = document.createElement('button');
        closeButton.addEventListener('click', ()=>{
            document.getElementById('body').removeChild(popup);
            origin.appendChild(elem);
        });
        closeButton.innerHTML = 'Close windows'
        
        let hr = document.createElement('hr'); 
        popupContent.appendChild(hr);
        popupContent.appendChild(closeButton);
        popup.appendChild(popupContent);
        document.getElementById('body').appendChild(popup);
    }
}

