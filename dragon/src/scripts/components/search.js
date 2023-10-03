window.addEventListener('load', () => {
  if (document.querySelector('.main_search')) {
    const resultTxt = document.querySelector('.search-results-text')
    const items = document.querySelector('.search-results .container')
    if (!localStorage.getItem('mobileSearchEnter') && items.children.length - 1 <= 0) {
      localStorage.setItem('mobileSearchEnter', 'done')
      resultTxt.textContent = ''
    } else {
      resultTxt.textContent = `Найдено результатов: ${items.children.length - 1}`
    }
  }
  window.addEventListener('beforeunload', (e) => {
    if (document.querySelector('.main_search')) {
      localStorage.removeItem('mobileSearchEnter')
    }
  })
})
