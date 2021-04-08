# Opérateur this en JS

## contexte globale

Dans le contexte global, `this` représente l'objet window.

```js
this === window;
// affiche true dans la console
```

## **this** dans les fonctions.

Idem pour les fonctions en générale : this === window.

```js
function test() {
  console.log(this);
}
test(); // return window
```

Dans le cas d'un eventListener : this représente l'objet sur lequel est assigné le listener :

```js
let body = document.getElementsByTagName("body")[0];
body.addEventListener("click", function (event) {
  console.log(this == event.currentTarget);
});
```

Une fonction flechée n'ayant **PAS** de contexte propre : l'objet this sera par défault **window**.

```js
let f = () => {
  console.log(this);
};
f(); // return window
```

## **This** dans des fonctions parcourant des objets.

Dans le cas particulier de javascript : il est possible d'appeler this dans une fonction qui elle même appelle un objet. Alors `this` devient `l'objet` appelé par la fonction. Pour celà, ont utilise `.call()` ou `.apply()`.

```js
const foo = { truc: "mon_truc" };

let truc = "Global";

function getTruc(arg) {
  console.log(this.truc);
}

getTruc();          // return globale
getTruc.call(foo);  // return "mon_truc"
getTruc.apply(foo); // idem
```

La méthode de fonction `.bind()` permet d'associer une valeur à la fonction :

```js
function test() {
    console.log(this.a);
}

let obj = test.bind({ "a": 2 });
obj();

let obj2 = obj.bind({ "a": 4 });
obj2();
```


> **Avis personnel** : à mélanger la programmation objet et la programmation fonctionnelle : les devs JS ont surtout semé un foutoir monstrueux !

## **This** dans les méthodes des objets.

Dans la méthode d'un objet, `this` représente l'objet lui même.
Valable aussi dans les `class` ES6 ( _EcmaScript 2015_ ).

```js
const obj = {
  prop: 0,

  set(num) {
    this.prop = num;
  },

  print() {
    console.log(this.prop);
  },
};

obj.set(42);
obj.print(); // affiche 42 dans la console
```

Il est possible de `return` l'objet lui même par sa popre méthode. Ce qui permet un _design pattern_ appelé `fluents`.

```js
const obj2 = {
  print(num) {
    console.log("fluent " + num);
    return this;
  },
};

obj2.print(1).print(2).print(3);

// affiche  fluent 1
// affiche  fluent 2
// affiche  fluent 3
```

## Ressources

* [L'opérateur this | MDN](https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Operators/this)