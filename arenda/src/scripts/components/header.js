window.addEventListener('load', () => {
  const mobileHeader = document.querySelector('.header_mobile')
  const headerNavMobile = document.querySelector('.header__nav_mobile')
  const burgerButton = document.getElementById('burger')
  const header = document.querySelector('.header')
  const mobileLinks = document.querySelectorAll('.header__link_mobile')

  burgerButton.addEventListener('click', headerNavMobileToggle)
  mobileLinks.forEach(el => el.addEventListener('click', headerNavMobileToggle))

  function headerNavMobileToggle (){
    headerNavMobile.classList.toggle('_hidden')
    burgerButton.classList.toggle('active')
  }

  window.addEventListener('scroll', windowScrollHeader)


  function windowScrollHeader(){
    let top = window.pageYOffset

    let currentScrollPos = window.pageYOffset
    if (currentScrollPos > 1) {
      mobileHeader.classList.add('faded')
      header.classList.add('faded')
    }
    else{
      header.classList.remove('faded')
      mobileHeader.classList.remove('faded')
    }
    top = currentScrollPos
  }
})
