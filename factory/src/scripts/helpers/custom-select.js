export default function initCustomSelects(arr) {
  function toggleSelect(e) {

    this.classList.toggle('open')
    const input = this.querySelector('input[type="hidden"]')
    const valueContainer = this.querySelector('.form__select-value-txt')
    let value

    if (e.target.closest('.form__select-options-item')) {
      const item = e.target.closest('.form__select-options-item')
      e.target.closest('.form__select-options').querySelectorAll('.form__select-options-item').forEach(el => el.classList.remove('active'))
      value = item.textContent
      input.value = value

      valueContainer.textContent = value
      valueContainer.classList.remove('default')
    }
  }

  arr.forEach(el => el.addEventListener('click', toggleSelect))

  window.addEventListener('click', (e) => {
    if (!e.target.closest('.form__select')) {
      document.querySelectorAll('.form__select').forEach(el => el.classList.remove('open'))
    }
  })
}
