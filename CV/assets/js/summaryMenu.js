/**
 * Function to auto-generate a menu from a class
 * 
 * @param {string} menuId : tag id to fill with menu
 * @param {string} classToCatch : class to catch to build menu 
 */
export function summaryMenu(menuId = 'menu-area', classToCatch = 'menu-item')
{
    
    /**
     * get list of element with class menu-item
     */
    let list = document.getElementsByClassName(classToCatch);
    
    // create ul
    let menuElemnt = document.createElement('ul');
    
    /**
     * If list of collection 
     */
    if (list instanceof HTMLCollection && list.length > 0)
    for (const elem of list) {        
        let elemlist = document.createElement('li');
        elemlist.innerHTML = elem.id;
    
        let link = document.createElement('a');
        link.setAttribute('href', '#'+elem.id);
        link.appendChild(elemlist);
        menuElemnt.appendChild(link);
    }
    
    /**
     * push all in menu
     */
    document.getElementById(menuId).appendChild(menuElemnt);
}
