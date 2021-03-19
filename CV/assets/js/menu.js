let list = document.getElementsByClassName('menu-item');
let menu = document.getElementById('menu-area');
let menuElemnt = document.createElement('ul');

for (const elem of list) {
    if (elem !== undefined){
        
        let elemlist = document.createElement('li');
        
        let link = document.createElement('a');
        link.setAttribute('href', '#'+elem.id);
        link.innerHTML = elem.id;
        
        elemlist.appendChild(link);
        menuElemnt.appendChild(elemlist);
        // console.log(elemlist);

    }
}

menu.appendChild(menuElemnt);