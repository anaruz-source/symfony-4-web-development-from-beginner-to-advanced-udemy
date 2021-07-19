import $ from 'jquery'


// global.$ = global.jQuery = $; // use this only of you link your other src contain other jquery code in another file, other use, just include your code here
console.log($);

// js/app.js
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// any CSS you import will output into a single css file (app.css in this case)


// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';



console.log('executing',window.$);
  $(function(){

    console.log('Ready');
  })

console.log('Hello Webpack Encore! Edit me in assets/app.js');

