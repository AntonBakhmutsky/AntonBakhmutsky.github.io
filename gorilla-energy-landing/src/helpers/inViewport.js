export default function (element, callback, position = 'top') {
  if (!element) {
    return
  }

  const listener = () => {
    const { top, bottom } = element.getBoundingClientRect()

    let inViewport = null

    switch (position) {
      case 'top':
        inViewport = top <= window.innerHeight
        break
      case 'bottom':
        inViewport = bottom <= window.innerHeight
        break
      case 'half':
        inViewport = (top + bottom) / 2 <= window.innerHeight
        break
      case 'offset':
        inViewport = top <= window.innerHeight * 1.5
        break
    }

    if (!inViewport) {
      return
    }

    callback()
    document.removeEventListener('scroll', listener)
  }

  document.addEventListener('scroll', listener)
  listener()
}
