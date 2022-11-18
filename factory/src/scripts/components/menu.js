window.addEventListener('load', () => {
  // mobile menu
  const mobileMenu = document.querySelector('.header__menu')
  const mobileMenuBtn = document.querySelector('.header__btn')
  const menuBtn = document.querySelector('.header__menu-top button')
  const mobileMenuItems = document.querySelectorAll('.header__menu a')
  const headerMenuDrop = document.querySelector('.header__menu-drop')
  const headerMenuDropSub = document.querySelector('.header__menu-drop-sub')

  const toggleMenu = () => {
    mobileMenu.classList.toggle('active')
    document.body.classList.add('body_fix')
  }

  mobileMenuBtn.addEventListener('click', toggleMenu)
  menuBtn.addEventListener('click', toggleMenu)

  // swipe event
  document.addEventListener('touchstart', handleTouchStart, false)
  document.addEventListener('touchmove', handleTouchMove, false)

  let xDown = null
  let yDown = null

  function handleTouchStart(evt) {
    xDown = evt.touches[0].clientX
    yDown = evt.touches[0].clientY
  }

  function handleTouchMove(evt) {
    if (!xDown || !yDown) {
      return
    }

    let xUp = evt.touches[0].clientX
    let yUp = evt.touches[0].clientY

    let xDiff = xDown - xUp
    let yDiff = yDown - yUp
    if (Math.abs(xDiff) > Math.abs(yDiff)) {
      if (xDiff > 0) {
        // left swipe
      } else {
        if (mobileMenu.classList.contains('active')) {
          mobileMenu.classList.remove('active')
          document.body.classList.remove('body_fix')
        }
        // right swipe
      }
    }

    xDown = null
    yDown = null
  }

  mobileMenuItems.forEach(el => el.addEventListener('click', toggleMenu))

  headerMenuDrop.addEventListener('click', () => {
    location.href = 'catalog.html'
  })

  headerMenuDropSub.addEventListener('click', () => {
    location.href = 'spetstehnika.html'
  })
})
