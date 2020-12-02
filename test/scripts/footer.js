window.addEventListener('load', () => {
  // toggle footer overlay
  const footer = document.querySelector('.main__footer')
  const overlay = footer.querySelector('.main__footer-overlay')
  let winWidth = window.innerWidth
  let scrollWidth
  let maxLeft

  setOverlay()

  function toggleModifier(modifier, operation) {
    if (operation === 'remove') {
      overlay.classList.remove(`main__footer-overlay_${modifier}`)
    } else if (operation === 'add') {
      overlay.classList.add(`main__footer-overlay_${modifier}`)
    }
  }

  function setOverlay () {
    scrollWidth = footer.scrollWidth
    if (scrollWidth === winWidth) {
      toggleModifier('right', 'remove')
      toggleModifier('left', 'remove')
    } else {
      maxLeft = scrollWidth - winWidth
      toggleModifier('right', 'add')
    }
  }
  
  function toggleOverlay () {
    const left = footer.scrollLeft
    if (left > 0 && left <= maxLeft - 5) {
      toggleModifier('left', 'add')
      toggleModifier('right', 'add')
    } else if (left > maxLeft - 5) {
      toggleModifier('right', 'remove')
    }  else if (left === 0) {
      toggleModifier('left', 'remove')
    }
  }

  footer.addEventListener('scroll', toggleOverlay)
  window.addEventListener('resize', () => {
    if (winWidth !== window.innerWidth) {
      winWidth = window.innerWidth
      setOverlay()
    }
  })
});