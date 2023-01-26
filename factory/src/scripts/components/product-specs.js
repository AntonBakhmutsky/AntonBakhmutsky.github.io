window.addEventListener('load', () => {
  if (!document.querySelector('.product-specs') && !document.querySelector('.product-specs__more')) {
    return false
  } else {
    const specsList = document.querySelector('.product-specs__list')
    const specs = document.querySelectorAll('.product-specs__list li')
    const specsButton = document.querySelector('.product-specs__more')

    const toggleSpecs = () => {
      if (specsList.hasAttribute('style')) {
        specsList.removeAttribute('style')
        specsList.classList.add('hidden')
        specsButton.textContent = 'Развернуть характеристики'
      } else {
        specsList.style.maxHeight = `${specsList.scrollHeight}px`
        specsList.classList.remove('hidden')
        specsButton.textContent = 'Свернуть характеристики'
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
