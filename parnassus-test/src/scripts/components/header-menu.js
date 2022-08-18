window.addEventListener('load', () => {
  const menu = document.querySelector('.menu')
  const menuBtn = document.querySelector('.header__burger')
  const closeBtn = document.querySelector('.menu__close')
  const menuOptions = document.querySelectorAll('.menu__item')
  const body = document.body

  const toggleMenu = (e) => {
    menu.classList.toggle('active')
    if (e.currentTarget.dataset.section) {
      body.classList = ''
      body.classList.add(e.currentTarget.dataset.section)
    }
  }

  menuBtn.addEventListener('click', toggleMenu)
  closeBtn.addEventListener('click', toggleMenu)
  menuOptions.forEach(el => el.addEventListener('click', toggleMenu))
})
