
fetch('includes/API.php?page=truc.html')
.then((response)=>{
    if (response.ok) return response.json();
    else {
        console.log(response)
    }
})
.then((data)=>{
    if (data != null)
    console.log(data);
})