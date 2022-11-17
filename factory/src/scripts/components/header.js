import {leftListAnimation} from '../helpers/animations'

window.addEventListener('load', () => {
  // header menu
  let headerMenuItems = document.querySelector('.header__menu-list').children

  leftListAnimation(null, 100, [...headerMenuItems])
})
