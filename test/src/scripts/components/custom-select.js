window.addEventListener('load', () => {
  if (!document.querySelector('.select')) {
    return false
  }

  const selects = document.querySelectorAll('.select')

  function initSelect (select) {
    const options = select.querySelectorAll('.select__item')
    const hiddenOptions = [...select.querySelectorAll('option')]
    const optionsBlock = select.querySelector('.select__options')
    const input = select.querySelector('.select__input')
    const arrow = select.querySelector('.select__arrow')
    let allValues = `<div class="select__item"><div class="select__text">Все статусы</div></div>`
    let someValues = `<div class="select__item"><div class="select__text">Не все статусы</div></div>`
    let flag

    input.insertAdjacentHTML('beforeend', allValues)

    const toggleOptions = () => {
      !optionsBlock.hasAttribute('style') ? optionsBlock.style.maxHeight = `${optionsBlock.scrollHeight + 40}px` : optionsBlock.removeAttribute('style')
      arrow.classList.toggle('select__arrow_active')
    }

    const selectOption = (el) => {
      const id = el.dataset.id
      const currentOption = hiddenOptions.find(el => el.dataset.id === id)
      if (currentOption.hasAttribute('selected')) {
        currentOption.removeAttribute('selected')
        el.classList.remove('select__item_active')
        input.innerHTML = ''
        input.insertAdjacentHTML('beforeend', someValues)
      } else {
        currentOption.setAttribute('selected', true)
        el.classList.add('select__item_active')
        options.forEach(el => {
          (el.classList.contains('select__item_active')) ? flag = true : flag = false
        })
        if (flag) {
          input.innerHTML = ''
          input.insertAdjacentHTML('beforeend', allValues)
        }
      }
    }

    const chooseValue = (event) => {
      const item = event.currentTarget
      selectOption(item)
      toggleOptions()
    }

    options.forEach(el => el.addEventListener('click', chooseValue))
    input.addEventListener('click', toggleOptions)
  }

  selects.forEach(el => initSelect(el))
})
