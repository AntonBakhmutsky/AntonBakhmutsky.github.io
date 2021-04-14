import inViewport from '../helpers/inViewport'

window.addEventListener('load', () => {
  const lazyload = document.querySelectorAll('.lazyload')

  lazyload.forEach((element) => {
    inViewport(element, () => {
      const src = element.dataset.src
      const backImg = element.dataset.back

      if (src) {
        element.setAttribute('src', src)
        element.removeAttribute('data-src')
      } else if (backImg) {
        element.style.backgroundImage = `url(${backImg})`
        element.removeAttribute('data-back')
      }

      element.classList.add('lazyloaded')
      element.classList.remove('lazyload')
    }, 'offset')
  })
})
