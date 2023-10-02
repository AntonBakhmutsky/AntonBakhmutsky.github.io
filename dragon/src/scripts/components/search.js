window.addEventListener('load', () => {
  if (document.querySelector('.main_search')) {
    if (!sessionStorage.getItem('mobileSearchEnter')) {
      sessionStorage.setItem('mobileSearchEnter', 'done')
      document.querySelector('.search-results-text').remove()
    }
  }
  window.addEventListener('beforeunload', (e) => {
    if (document.querySelector('.main_search')) {
      sessionStorage.removeItem('mobileSearchEnter')
    }
  })
})
