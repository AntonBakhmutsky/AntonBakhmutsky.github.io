window.addEventListener('load', () => {
  if (document.querySelector('.product-specs')) {
    const specsList = document.querySelector('.product-specs__list')
    const specs = document.querySelectorAll('.product-specs__list li')
    const specsButton = document.querySelector('.product-specs__more')
    function toggleSpecs() {
      if (specsList.hasAttribute('style')) {
        specsList.removeAttribute('style')
        specsList.classList.add('hidden')
        specsButton.querySelector('span').textContent = 'Показать еще'
        specsButton.classList.remove('active')
      } else {
        specsList.style.maxHeight = `${specsList.scrollHeight}px`
        specsList.classList.remove('hidden')
        specsButton.querySelector('span').textContent = 'Свернуть'
        specsButton.classList.add('active')
      }
    }

    if (specs.length > 8) {
      specsList.classList.add('hidden')
      specsButton.addEventListener('click', toggleSpecs)
    } else {
      specsButton.classList.add('disable')
    }
  }
})
