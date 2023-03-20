window.addEventListener('load', () => {
  // header menu
  const menu = document.querySelector('.menu')
  const menuBtn = document.querySelector('.header__burger')
  const menuItems = document.querySelectorAll('.header__menu-item')

  const toggleMenu = (e) => {
    if (window.innerWidth < 1281) {
      e.currentTarget.classList.toggle('active')
      menu.classList.toggle('active')
      document.body.classList.toggle('body_fix')
    }
  }

  menuBtn.addEventListener('click', toggleMenu)
  menuItems.forEach(el => el.addEventListener('click', toggleMenu))
});
