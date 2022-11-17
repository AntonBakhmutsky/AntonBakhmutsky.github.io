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

  // slide left
  const slideLeft = document.querySelectorAll('.slide-left')

  slideLeft.forEach(el => {
    inViewport(el, () => {
      anime({
        targets: el,
        opacity: [0, 1],
        translateX: [130, 0],
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
            translateY: [130, 0],
            duration: 1000,
            delay: i * 150,
            easing: 'easeOutQuart'
          })
        })
      })
    }
  }

  // header menu
  const headerMenuItems = document.querySelector('.header__menu-list').children

  leftListAnimation(null, 100, [...headerMenuItems])

  // partners list
  leftListAnimation('.partners__list li')

  // product list
  topListAnimation('.products-slider .swiper-slide')

  // news list
  leftListAnimation('.index-news__item')

  // why list
  topListAnimation('.why__list li', 50)

})
