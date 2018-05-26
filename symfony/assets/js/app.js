// loads the jquery package from node_modules
var $ = require('jquery');

// import the function from greet.js (the .js extension is optional)
// ./ (or ../) means to look for a local file
//var greet = require('./greet');

var filters = require('./filters');


$(document).ready(function() {
    //$('body').prepend('<h1>'+greet('john')+'</h1>');
    filters();
});