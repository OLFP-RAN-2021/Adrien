
export function formHandler()
{

    let collection = document.getElementsByClassName('form-fetch');
    
    for (const form of collection) {
        
        console.log(form);
        
        form.addEventListener('submit', function (event) {
            //  suspend le comportement par default
            event.preventDefault();
            
            // console.log(e.currentTarget);
            console.log('test');
            
        })


            
            // let email = document.getElementById('userEmail');
            // if (!email.value.match(/[\w.-]*@[\w.-]*\.[\w.]{2,}/i)) {
            //     document.getElementById('email-mssg').innerHTML = 'Error';
            //     alert('Email non valide\nFormat attendu : roberd.bidochon@service.com.');    
            // }
        
        
            // fetch(form.action)
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
                
            //     for (const obj of object) {
            //         document.getElementById('mssg-'+obj.name).innerHTML = obj.content;  
            //     }
                
            // });
        
        
    }
}
