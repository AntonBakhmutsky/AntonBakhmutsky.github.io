window.addEventListener('load', () => {
  const menu = document.querySelector('.header__nav')
  const menuBtn = document.querySelector('.header__mobile-nav')
  const menuLinks = menu.querySelectorAll('.header__nav-container a')
  const menuClose = menu.querySelector('.header__nav-close')

  const showMenu = () => menu.classList.add('active')

  const closeMenu = () => menu.classList.remove('active')

  menuBtn.addEventListener('click', showMenu)
  menuClose.addEventListener('click', closeMenu)
  menuLinks.forEach(el => el.addEventListener('click', closeMenu))
})
