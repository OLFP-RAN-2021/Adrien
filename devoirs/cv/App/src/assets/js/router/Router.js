/**
 * 
 * Javascript router
 * 
 * @see https://developer.mozilla.org/en-US/docs/Web/API/History
 * 
 */
export class Router {

    constructor () {

        this.start = '/';

        let sitename = document.location.hostname;
        for (const link of document.getElementsByTagName('js-history')) {

            if (link.href.match("/"+sitename+"/"))
            link.addEventListener('click', (e)=>{
                e.preventDefault();
                fetch(link.href)
                .then(()=>{
                    
                })
                .then(()=>{

                })
            });          
        }
    }

    loader() {

    }

    forward() {

    }

    back () {
        
    }

    /**
     * 
     */
    pushHistory(thing, title, url)
    {
        history.pushState(thing, title, url);        
    }


}