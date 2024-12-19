'use strict';



// element toggle function
const elementToggleFunc = function (elem) { elem.classList.toggle("active"); }



// sidebar variables
const sidebar = document.querySelector("[data-sidebar]");
const sidebarBtn = document.querySelector("[data-sidebar-btn]");

// sidebar toggle functionality for mobile
sidebarBtn.addEventListener("click", function () { elementToggleFunc(sidebar); });

const spans = document.querySelectorAll('h2')
spans.forEach(span => span.addEventListener('mouseover', function(e){
    span.classList.add('animated', 'rubberBand')
}))
spans.forEach(span => span.addEventListener('mouseout', function(e){
    span.classList.remove('animated', 'rubberBand')
}))
function bar(){
  const barLove = document.querySelector('.progress-love')
  const barWeb = document.querySelector('.progress-web')
  const barC = document.querySelector('.progress-c')
  const barNode = document.querySelector('.progress-node')
  const barPy = document.querySelector('.progress-py')
  const barDesign = document.querySelector('.progress-design')

  var t1 = new TimelineLite()

  t1.fromTo(barLove, .75, {width: `calc(0%)`}, {width: `calc(100%)`, ease: Power4.easeOut})
      .fromTo(barWeb, .75, {width: `calc(0%)`}, {width: `calc(30%)`, ease: Power4.easeOut})
      .fromTo(barC, .75, {width: `calc(0%)`}, {width: `calc(35%)`, ease: Power4.easeOut})
      .fromTo(barNode, .75, {width: `calc(0%)`}, {width: `calc(37%)`, ease: Power4.easeOut})
      .fromTo(barPy, .75, {width: `calc(0%)`}, {width: `calc(10%)`, ease: Power4.easeOut})
      .fromTo(barDesign, .75, {width: `calc(0%)`}, {width: `calc(40%)`, ease: Power4.easeOut})
}
setTimeout(bar, 500);