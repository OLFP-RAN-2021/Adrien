function popup(id)
{
    let popup = document.createElement('div');
    popup.classList.add('popup-background');

    let popupContent = document.createElement('div');
    popupContent.classList.add('popup-content');

    let elem = document.getElementById(id);
    if (elem !== null){
        elem = elem.cloneNode(true);
        elem.classList.remove('hidden');
        popupContent.appendChild(elem);
    }

    window.addEventListener('keydown', (e)=>{
        if (e.key == 'Escape')
        document.getElementById('body').removeChild(popup);
    });

    let closeButton = document.createElement('button');
    closeButton.addEventListener('click', ()=>{
        document.getElementById('body').removeChild(popup);
    });
    closeButton.innerHTML = 'Close windows'

    let hr = document.createElement('hr'); 
    popupContent.appendChild(hr);
    popupContent.appendChild(closeButton);
    popup.appendChild(popupContent);
    document.getElementById('body').appendChild(popup);
}