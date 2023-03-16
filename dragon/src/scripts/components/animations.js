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
        translateX: [-150, 0],
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
        translateY: [150, 0],
        duration: 1000,
        easing: 'easeOutQuart'
      })
    })
  })

  // slide to down
  const slideToDownElements = document.querySelectorAll('.slide-down')

  slideToDownElements.forEach(el => {
    inViewport(el, () => {
      anime({
        targets: el,
        opacity: [0, 1],
        translateY: [-150, 0],
        duration: 1000,
        easing: 'easeOutQuart'
      })
    })
  })

  // slide to left
  const slideLeft = document.querySelectorAll('.slide-left')

  slideLeft.forEach(el => {
    inViewport(el, () => {
      anime({
        targets: el,
        opacity: [0, 1],
        translateX: [150, 0],
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
      inViewport(num, () => {
        anime({
          targets: num,
          innerHTML: [0, num.textContent],
          easing: 'linear',
          round: 1
        })
      })
    })
  }
})
