import anime from 'animejs'
import inViewport from '../helpers/inViewport'

// list left animation
function leftListAnimation(selector, delay = 150, arr = null) {
  if (selector) {
    if (!document.querySelector(selector)) {
      return false
    } else {
      const items = document.querySelectorAll(selector)

      items.forEach((el, i) => {
        inViewport(el, () => {
          anime({
            targets: el,
            opacity: [0, 1],
            translateX: [130, 0],
            duration: 1000,
            delay: i * delay,
            easing: 'easeOutQuart'
          })
        })
      })
    }
  } else {
    arr.forEach((el, i) => {
      inViewport(el, () => {
        anime({
          targets: el,
          opacity: [0, 1],
          translateX: [130, 0],
          duration: 1000,
          delay: i * delay,
          easing: 'easeOutQuart'
        })
      })
    })
  }
}

// top list animation
function topListAnimation(selector) {
  if (!document.querySelector(selector)) {
    return false
  } else {
    const items = document.querySelectorAll(selector)

    items.forEach((el, i) => {
      inViewport(el, () => {
        anime({
          targets: el,
          opacity: [0, 1],
          translateY: [150, 0],
          duration: 1000,
          delay: i * 150,
          easing: 'easeOutQuart'
        })
      })
    })
  }
}

export {leftListAnimation, topListAnimation}

// // why list
// topListAnimation('.why__list li', 50)
