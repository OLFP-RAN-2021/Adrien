
let form = document.getElementById('form-fetch');

form.addEventListener('submit', (e)=>{
    e.preventDefault();
    
    fetch(form.action)
    .then((response) => {
        if (response.ok)
        return response;
        else {
            console.log('Error code '+response.status)
            console.log('Error content : '+response.statusText)
        }
    })
    .then((data)=>{
        data = data.json();
        
    });


});