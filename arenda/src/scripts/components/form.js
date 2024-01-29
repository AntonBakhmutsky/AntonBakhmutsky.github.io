window.addEventListener('load', () => {
  if (document.querySelector('.form__field')) {
    // form inputs
    const inputs = document.querySelectorAll('.form__field input')

    function toggleInput(e) {
      const field = this.parentElement
      const label = this.nextElementSibling

      if (e.type === 'focus') {
        label.classList.add('active')
        field.classList.add('active')
      } else {
        if (!this.value.trim()) {
          label.classList.remove('active')
        }
        field.classList.remove('active')
      }
    }

    inputs.forEach(el => el.addEventListener('focus', toggleInput))
    inputs.forEach(el => el.addEventListener('blur', toggleInput))
  }
})
