window.addEventListener('load', () => {
  const mobileMenu = document.querySelector('.header__menu');
  const burgerBtn = document.querySelector('.header__mobile-btn');
  const closeMenu = document.querySelector('.header__menu-close');
  const menuAnchors = document.querySelectorAll('.header__menu a');

  const toggleMenu = () => mobileMenu.classList.toggle('header__menu_active');

  burgerBtn.addEventListener('click', toggleMenu);
  closeMenu.addEventListener('click', toggleMenu);
  menuAnchors.forEach(el => el.addEventListener('click', toggleMenu));
})
