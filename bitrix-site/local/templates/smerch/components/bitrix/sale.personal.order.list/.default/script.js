window.addEventListener('load', () => {
  if (!document.querySelector('.order-card')) {
    return false
  }

  const popups = document.querySelectorAll('.order-card__status-popup')

  const togglePopup = (event) => {
    event.stopPropagation()
    if (window.innerWidth <= 1024) {
      event.currentTarget.classList.toggle('active')
    }
  }

  popups.forEach(el => el.addEventListener('click', togglePopup))

  window.addEventListener('click', (event) => {
    if (!event.target.classList.contains('order-card__status-popup')) {
      popups.forEach(el => el.classList.remove('active'))
    }
  })
})
