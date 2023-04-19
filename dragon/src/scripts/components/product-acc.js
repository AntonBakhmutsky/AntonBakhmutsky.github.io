window.addEventListener('load', () => {
  if (!document.querySelector('.product-options__container')) {
    return false
  } else {
    const container = document.querySelector('.product-options__container')
    const moreBtn = document.querySelector('.product-options__more')
    const items = [...container.children]

    container.children[0].classList.add('open')
    container.children[0].querySelector('.product-options__acc-hidden').style.maxHeight = `${container.children[0].querySelector('.product-options__acc-hidden').scrollHeight}px`

    function toggleItem(e) {
      if (e.target.closest('.product-options__acc-visible')) {
        const item = e.target.closest('.product-options__acc')
        const itemHidden = item.querySelector('.product-options__acc-hidden')

        item.classList.toggle('open')
        itemHidden.hasAttribute('style') ? itemHidden.removeAttribute('style') : itemHidden.style.maxHeight = `${itemHidden.scrollHeight}px`
      }
    }

    function toggleAll() {
      if (this.textContent === 'Развернуть все') {
        this.textContent = 'Свернуть все'
        items.forEach(el => {
          el.classList.add('open')
          el.querySelector('.product-options__acc-hidden').style.maxHeight = `${el.querySelector('.product-options__acc-hidden').scrollHeight}px`
        })
      } else {
        this.textContent = 'Развернуть все'
        items.forEach(el => {
          el.classList.remove('open')
          el.querySelector('.product-options__acc-hidden').removeAttribute('style')
        })
      }
    }

    moreBtn.addEventListener('click', toggleAll)
    container.addEventListener('click', toggleItem)

    // order form anchor
    document.querySelector('.product-top__links .btn').addEventListener('click', () => {
      const y = document.querySelector('#orderForm').getBoundingClientRect().y
      if (window.innerWidth > 1280) {
        window.scrollTo(0, y - 90)
      } else {
        window.scrollTo(0, y - 71)
      }
    })
  }
})
