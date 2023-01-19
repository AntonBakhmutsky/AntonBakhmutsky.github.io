window.addEventListener('load', () => {
  // desktop search
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

  //mobile search
  const searchMobile = document.querySelector('.header__mobile-search')
  const searchMobileBtn = document.querySelector('.header__mobile-search-btn')
  const searchMobileClose = document.querySelector('.header__mobile-search-close')
  const searchMobileInput = searchMobile.querySelector('input')

  const toggleSearchMobile = () => {
    searchMobile.classList.toggle('active')
    searchMobileInput.value = ''
  }

  searchMobileBtn.addEventListener('click', toggleSearchMobile)
  searchMobileClose.addEventListener('click', toggleSearchMobile)
})
