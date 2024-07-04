import ViewportDimensions from './viewport.js';


var screenWidth = window.innerWidth;
var screenHeight = window.innerHeight;


ViewportDimensions.listenWindowResize(() => {
    screenWidth = width;
    screenHeight = height;
})

console.log(screenWidth);
console.log(screenHeight);