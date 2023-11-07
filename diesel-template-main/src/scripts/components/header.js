const header = document.querySelector('.header')
let scrollPosition = 0

if (window.scrollY !== 0) {
  header.classList.add('sticky')
}

window.addEventListener('scroll', () => {
  if (window.scrollY > scrollPosition && window.scrollY > 19) {
    scrollPosition = window.scrollY
    if (!header.classList.contains('sticky')) {
      header.classList.add('sticky')
    }
    if (header.classList.contains('up')) {
      header.classList.remove('up')
    }

  } else  {
    scrollPosition = window.scrollY;

    if (window.scrollY < 20) {
      header.classList.remove('sticky')
    }
  }
})

// menu
const headerMenu = document.querySelector('.header__menu')
const headerBurger = document.querySelector('.header__burger')
const headerMenuItems = document.querySelectorAll('.header__menu a')


function toggleMenu(e) {
  if (!headerMenu.classList.contains('active')) {
    headerMenu.classList.add('active')
    headerBurger.classList.add('active')
  } else {
    headerMenu.classList.remove('active')
    headerBurger.classList.remove('active')
  }
}

headerMenu.addEventListener('click', toggleMenu)
headerMenuItems.forEach(el => el.addEventListener('click', toggleMenu))
headerBurger.addEventListener('click', toggleMenu)

