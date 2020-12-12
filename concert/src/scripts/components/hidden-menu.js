import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

window.addEventListener('load', () => {
  if (!document.querySelector('.hidden-menu')) {
    return false
  }

  const menu = document.querySelector('.hidden-menu')
  const menuBtn = document.querySelector('.header__menu-btn')

  const toggleMenu = () => {
    menuBtn.classList.toggle('header__menu-btn_active')
    menu.classList.toggle('hidden-menu_active')

    if (menu.classList.contains('hidden-menu_active')) {
      disableBodyScroll(menu)
    } else {
      enableBodyScroll(menu)
    }
  }

  menuBtn.addEventListener('click', toggleMenu)

})