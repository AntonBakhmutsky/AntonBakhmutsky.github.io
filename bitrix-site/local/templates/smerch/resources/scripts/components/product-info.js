window.addEventListener('load', () => {
  if (!document.querySelector('.info')) {
    return false
  }

  const infoItems = document.querySelectorAll('.info__item')

  const toggleItem = (event) => {
    const hidden = event.currentTarget.querySelector('.info__item-hidden')
    const btn = event.currentTarget.querySelector('.info__item-arrow')

    event.currentTarget.classList.toggle('active')
    hidden.classList.toggle('active')
    hidden.hasAttribute('style') ? hidden.removeAttribute('style') : hidden.style.maxHeight = `${hidden.scrollHeight}px`
    btn.classList.toggle('active')
  }

  infoItems.forEach(el => el.addEventListener('click', toggleItem))
})
