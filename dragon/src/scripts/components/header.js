window.addEventListener('load', () => {
  // header menu
  const menu = document.querySelector('.menu')
  const menuBtn = document.querySelector('.header__burger')
  const menuItems = document.querySelectorAll('.header__menu-item')

  const toggleMenu = (e) => {
    if (window.innerWidth < 1281) {
      e.currentTarget.classList.toggle('active')
      menu.classList.toggle('active')
      document.body.classList.toggle('body_fix')
    }
  }

  menuBtn.addEventListener('click', toggleMenu)
  menuItems.forEach(el => el.addEventListener('click', toggleMenu))

  // sticky header
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
        header.classList.remove('up')
      } else {
        header.classList.add('up')
      }
    }
  })

  // header search
  const search = document.querySelector('.header__search-field')
  const searchBtn = document.querySelector('.header__search-btn')

  const toggleSearch = (e) => {
    if (!search.classList.contains('active')) {
      search.classList.add('active')
      searchBtn.classList.add('disabled')
    } else {
      search.classList.remove('active')
      searchBtn.classList.remove('disabled')
      search.closest('form').reset()
    }
  }
  searchBtn.addEventListener('click', toggleSearch)
});
