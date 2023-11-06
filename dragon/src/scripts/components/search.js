window.addEventListener('load', () => {
  if (document.querySelector('.main_search')) {
    if (window.innerWidth < 1024) {
      const resultTxt = document.querySelector('.search-results-text')
      const items = document.querySelector('.search-results .container')
      if (localStorage.getItem('mobileSearchEnter') !== 'done') {
        localStorage.setItem('mobileSearchEnter', 'done')
        resultTxt.textContent = ''
      } else {
        if (items.children.length - 1 > 0) {
          resultTxt.textContent = `Найдено результатов: ${items.children.length - 1}`
        } else {
          resultTxt.textContent = `К сожалению, на ваш поисковый запрос ничего не найдено.`
        }
      }
    }
  }
})
