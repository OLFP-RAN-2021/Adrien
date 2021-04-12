## La fonction `factory`

Les classes et fonctions qui servent à instancier des objets sont généralement appelées des `factories` ('usines', en anglais).

J'ai décris la fonction dans le fichier [factory.js](factory.js).

```html
<!-- Importer la constion -->
<script src="factory.js"></script>
<script>

    
    // List d'objet events { event:'JsEvent', callable:function(){} }
    let eventsList = [
        {
            event: "click",
            callable: (event) => {
                console.log(event);
                console.log(MyCustomELement);
            },
        },

    ];

    // créer un Element
    let MyCustomELement = factory("my-custom", eventsList);

    // Ajoute un contenu
    MyCustomELement.innerHTML = "Contenu de ma custom";

    // Ajoute un style
    MyCustomELement.style.display = "block";

    // Ajoute une class
    MyCustomELement.classList.add("MyCustomClass");

    // Prendre le parent qui va recevoir notre objet.
    let target = document.getElementById("parentMyCustom");

    // Injecter dans le parent.
    target.appendChild(MyCustomELement);
</script>
```