window.addEventListener('load', () => {
  const search = document.querySelector('.header__search')
  const searchBtn = document.querySelector('.header__search-btn')
  const searchClose = document.querySelector('.header__search-close')
  const searchInput = search.querySelector('input')

  const toggleSearch = () => {
    search.classList.toggle('active')
    searchInput.value = ''
  }

  searchBtn.addEventListener('click', toggleSearch)
  searchClose.addEventListener('click', toggleSearch)
})
