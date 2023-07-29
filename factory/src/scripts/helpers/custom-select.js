export default function initCustomSelects(arr) {
  function toggleSelect(e) {
    if (this.classList.contains('disabled')) {
      return false
    }

    this.classList.toggle('open')
    const input = this.querySelector('input[type="hidden"]')
    let value, id, workModes, address

    if (e.target.closest('.custom-select__options-item')) {
      const item = e.target.closest('.custom-select__options-item')
      e.target.closest('.custom-select__options').querySelectorAll('.custom-select__options-item').forEach(el => el.classList.remove('active'))
      item.classList.add('active')
      id = item.dataset.id || null
      address = item.dataset.address || null
      value = item.querySelector('span').textContent
      input.value = value

      if (item.querySelector('.custom-select__options-item-time')) {
        workModes = [...item.querySelector('.custom-select__options-item-time').children]
      }

      if (id) {
        input.dataset.id = id
      }

      if (address) {
        input.dataset.address = address
      }

      if (this.classList.contains('custom-select_warehouses')) {
        const warehouseAddress = this.parentElement.nextElementSibling
        const timeContainer = warehouseAddress.querySelector('.ordering__delivery-address-time')
        warehouseAddress.querySelector('span').textContent = address
        warehouseAddress.nextElementSibling.removeAttribute('disabled')

        if (workModes.length) {
          timeContainer.innerHTML = ''
          workModes.forEach(el => {
            timeContainer.insertAdjacentElement('beforeend', el)
          })
        }

        this.parentElement.querySelector('.ordering__delivery-prompt').classList.remove('active')
        warehouseAddress.classList.add('active')
      }

      this.querySelector('.custom-select__value-txt').textContent = value
      this.querySelector('.custom-select__value-txt').classList.remove('default')
    }
  }

  arr.forEach(el => el.addEventListener('click', toggleSelect))

  window.addEventListener('click', (e) => {
    if (!e.target.closest('.custom-select')) {
      document.querySelectorAll('.custom-select').forEach(el => el.classList.remove('open'))
    }
  })
}
