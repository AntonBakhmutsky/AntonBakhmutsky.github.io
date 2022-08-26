window.addEventListener('load', () => {

  // search
  const mobileMenu = document.querySelector('.mobile-menu');
  const mobileMenuBtn = document.querySelector('.header__mobile-btn');
  const mobileMenuClose = document.querySelector('.mobile-menu__close');

  const toggleMenu = () =>  mobileMenu.classList.toggle('active');

  mobileMenuBtn.addEventListener('click', toggleMenu);
  mobileMenuClose.addEventListener('click', toggleMenu);

});
