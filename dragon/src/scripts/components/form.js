window.addEventListener('load', () => {
  if (!document.querySelector('.form')) {
    return null
  } else {
    // placeholder
    const inputs = document.querySelectorAll('.form__field-input')

    const risePlaceholder = (e) => {
      e.currentTarget.parentElement.classList.add('active')
      e.currentTarget.parentElement.classList.add('focus')
    }
    const lowerPlaceholder = (e) => {
      if (!e.currentTarget.value.trim()) {
        e.currentTarget.parentElement.classList.remove('active')
      }
      e.currentTarget.parentElement.classList.remove('focus')
    }

    inputs.forEach(el => el.addEventListener('focus', risePlaceholder))
    inputs.forEach(el => el.addEventListener('blur', lowerPlaceholder))
  }

  if (!document.querySelector('.form__select')) {
    return null
  } else {
    const selects = document.querySelectorAll('.form__select')

    function handleSelect(e) {
      this.classList.toggle('open')

      const visibleValue = this.querySelector('.form__select-visible-value')
      const hiddenValue = this.querySelector('input')

      if (e.target.closest('.form__select-options-item')) {
        const option = e.target.closest('.form__select-options-item')
        const value = option.textContent
        this.querySelectorAll('.form__select-options-item').forEach(el => {
          el !== option ? el.classList.remove('active'): el.classList.add('active')
        })
        visibleValue.textContent = value
        hiddenValue.value = value
        this.classList.add('selected')
      }
    }

    document.addEventListener('click', (e) => {
      if (!e.target.closest('.form__select')) {
        selects.forEach(el => el.classList.remove('open'))
      }
    })

    selects.forEach(el => el.addEventListener('click', handleSelect))
  }
});
