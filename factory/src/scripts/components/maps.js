import anime from 'animejs'
import {leftListAnimation} from '@/scripts/helpers/animations'

window.addEventListener('load', () => {
  if (!document.querySelector('.map-mob')) {
    return false
  } else {
    const maps = document.querySelectorAll('.map-mob__item')
    const switchButtons = document.querySelectorAll('.map-mob__btn button')
    console.log(maps)

    const switchMap = (e) => {
      const index = e.currentTarget.dataset.index
      const nextMap = maps[index]

      if (!nextMap.classList.contains('active')) {
        maps.forEach(el => el.classList.remove('active'))
        nextMap.classList.add('active')
        anime({
          targets: nextMap,
          opacity: [0, 1],
          translateX: [-300, 0],
          duration: 800,
          easing: 'easeOutQuart'
        })
      }
    }

    switchButtons.forEach(el => el.addEventListener('click', switchMap))
    leftListAnimation('.map-mob__btn')
  }
})
