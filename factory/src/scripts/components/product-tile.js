import {topListAnimation} from '../helpers/animations'

window.addEventListener('load', () => {
  if (!document.querySelector('.product-tile')) {
    return false
  } else {
    topListAnimation('.product-tile__item')

    const switcherBtns = document.querySelectorAll('.product-tile__switcher-btn')
    const grid = document.querySelector('.product-tile__grid')

    const changeDirection = (e) => {
      if (e.currentTarget.dataset.direction === 'vertical') {
        grid.classList.remove('product-tile__grid_horizontal')
        grid.classList.add('product-tile__grid_vertical')
      } else {
        grid.classList.remove('product-tile__grid_vertical')
        grid.classList.add('product-tile__grid_horizontal')
      }
      switcherBtns.forEach(el => el.classList.remove('active'))
      e.currentTarget.classList.add('active')
    }

    switcherBtns.forEach(el => el.addEventListener('click', changeDirection))
  }
})
