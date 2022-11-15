import anime from 'animejs'
import inViewport from '../helpers/inViewport'

window.addEventListener('load', () => {
  // slide to right
  const slideToRightElements = document.querySelectorAll('.slide-right')

  slideToRightElements.forEach(el => {
    inViewport(el, () => {
      anime({
        targets: el,
        opacity: [0, 1],
        translateX: [-130, 0],
        duration: 1000,
        easing: 'easeOutQuart'
      })
    })
  })

  // slide to up
  const slideToUpElements = document.querySelectorAll('.slide-up')

  slideToUpElements.forEach(el => {
    inViewport(el, () => {
      anime({
        targets: el,
        opacity: [0, 1],
        translateY: [130, 0],
        duration: 1000,
        easing: 'easeOutQuart'
      })
    })
  })

  // nums animation
  if (!document.querySelector('.anim-num')) {
    return false
  } else {

    const nums = document.querySelectorAll('.anim-num')

    nums.forEach(num => {
      const numValue = Number(num.textContent.split(' ').join(''))

      inViewport(num, () => {
        anime({
          targets: num,
          innerHTML: [0, numValue],
          easing: 'linear',
          round: 1
        })
      })
    })
  }
})
