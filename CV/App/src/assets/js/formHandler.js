


export function formHandler()
{
    let collection = document.getElementsByClassName('form-fetch');
    for (const form of collection) {
        
        let fieldsets = form.getElementsByTagName('fieldset');
        for (const field of fieldsets) {
            
            field.addEventListener('keyup', function (event) {

                let regex = field.getElementsByClassName('regex')[0].innerHTML;
                let value = field.getElementsByClassName('input')[0].value;
                let mssg = field.getElementsByClassName('mssg')[0];
                
                /**
                 * Pour créer une regex depuis une chaine de caratère : 
                 * la chaine ne doit pas posséder de délimiteurs ni d'options g,i, etc... 
                 */
                regex = new RegExp(regex, 'i');
                // console.log(regex);

                if (!value.match(regex)) {
                    mssg.style.display = 'block';
                } 
                else {
                    mssg.style.display = 'none';
                }
            });
        }

        form.addEventListener('submit', function (event) {

            //  suspend le comportement par default
            event.preventDefault();

            let lists = document.getElementsByClassName('mssg-error');
            for (const elemError of lists){
                elemError.style.display = 'none';
            }

            /**
             *   
             */
            // let email = document.getElementById('email');
            // if (!email.value.match(/^[\w.-]*@[\w.-]*\.[\w.]{2,}$/i)) {
            //     // document.getElementById('email-mssg').style.display = 'block';
            // } 
            // else {
            //     let subject = document.getElementById('subject');
            //     if (!subject.value.match(/[\w .-]{5,}/i)) {
            //         // document.getElementById('subject-mssg').style.display = 'block';
            //     } 
            //     else {
            //         let content = document.getElementById('content');
            //         if (!content.value.match(4)) {
            //             // document.getElementById('content-mssg').style.display = 'block';
            //         } 
            //     }
            // }

            // fetch(form.action, {
            //     'method':'POST',
            //     'body': new FormData(form)
            // })
            // .then((response) => {
            //     if (response.ok)
            //     return response;
            //     else {
            //         console.log('Error code '+response.status)
            //         console.log('Error content : '+response.statusText)
            //     }
            // })
            // .then((data)=>{
            //     data = data.json();
                
            //     for (const obj of data) {
            //         document.getElementById('mssg-'+obj.name).innerHTML = obj.content;  
            //     }
                
            // });
            
        })

        
    }
}
