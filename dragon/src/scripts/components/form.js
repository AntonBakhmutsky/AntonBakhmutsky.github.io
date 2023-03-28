window.addEventListener('load', () => {
  if (!document.querySelector('.form')) {
    return null
  } else {
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
});
