

/**
 * list of windows
 */
export const windowList = {
    list = [],
    push(elem){
        list[elem.id] = elem;
    },
    pull(name){
        for (const key in object) {
            if (key.match("/"+name+"/")){
                return object;
            }
        }
    }
};

/**
 * 
 */
export class handler {
    constructor()
    {
        
    }    
}

/**
 * 
 */
export class window 
{
    constructor (title, content)
    {
        this.handler = new handler();
        this.win = document.createElement('div');
        this.win.classList.add('window-popup');

        this.title = title;
        this.content = content;

        this.pos = new moverWindow();
        this.id = Math.random()+'#'+title;
        windowList.push(this);
    }

    push()
    {
        this.handler.appendChild();
    }
}

/**
 * 
 */
 class moverWindow 
 {
    constructor(window)
    {
        this.window = window;
    }



 }
 