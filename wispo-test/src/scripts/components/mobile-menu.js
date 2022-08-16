window.addEventListener('load', () => {
  const menuBtn = document.querySelector('.header__mobile-btn');
  const menu = document.querySelector('.header__mobile-menu');
  const closeBtn = document.querySelector('.header__mobile-menu-close');

  const toggleMenu = () => {
    document.body.classList.toggle('body_fixed');
    menu.classList.toggle('header__mobile-menu_active');
  }

  menuBtn.addEventListener('click', toggleMenu);
  closeBtn.addEventListener('click', toggleMenu);
});
