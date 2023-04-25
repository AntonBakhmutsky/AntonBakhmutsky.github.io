const menuToggle = document.querySelector('#menu-toggle');
const menu = document.querySelector('.menu');
const menuNavName = document.querySelector('.list__text');

menuToggle.addEventListener('click', function() {
  menu.classList.toggle('menu-min');
  menuNavName.classList.toggle('hide-list__text')
});

