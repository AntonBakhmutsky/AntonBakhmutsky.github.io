window.addEventListener('load', () => {
  if (document.querySelector('.form__check')) {
    const elements = document.querySelectorAll('.form__check')

    function toggleCheck() {
      const input = this.querySelector('input')
      input.checked = !input.checked
    }

    elements.forEach(el => el.addEventListener('click', toggleCheck))
  }
})
