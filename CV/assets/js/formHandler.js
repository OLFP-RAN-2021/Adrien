
export function formHandler()
{

    let collection = document.getElementsByClassName('form-fetch');
    
    for (const form of collection) {
        
        form.addEventListener('submit', function (event) {
            //  suspend le comportement par default
            event.preventDefault();
            
            let email = document.getElementById('email');
            if (!email.value.match(/^[\w.-]*@[\w.-]*\.[\w.]{2,}$/i)) {
                document.getElementById('email-mssg').innerHTML = 'Email non valide.\nFormat attendu : roberd.bidochon@service.com.';
            } 
            else {
                document.getElementById('email-mssg').innerHTML = '';
            }
            
            let subject = document.getElementById('subject');
            if (!subject.value.match(/[\w .-]{5,}/i)) {
                document.getElementById('subject-mssg').innerHTML = 'Sujet invalide : au moins 5 caractères alpha-numériques attendus.';
            } else {
                document.getElementById('subject-mssg').innerHTML = '';
            }
        })

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
        
        
    }
}
