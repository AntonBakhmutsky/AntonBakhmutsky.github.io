export default function initInputs(inputs) {
  function focus() {
    this.parentElement.querySelector('label').classList.add('active')
  }

  function blur() {
    if (!this.value.trim()) {
      this.parentElement.querySelector('label').classList.remove('active')
    }
  }

  inputs.forEach(el => {
    const input = el.querySelector('input')

    input.addEventListener('focus', focus)
    input.addEventListener('blur', blur)
  })
}
