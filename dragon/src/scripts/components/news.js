window.addEventListener('load', () => {
  if (!document.querySelector('.news')) {
    return null
  } else {
    // news switcher

    const switcherBtns = document.querySelectorAll('.news__switcher-btn')
    const newsContent = document.querySelectorAll('.news__content-item')

    const toggleContent = (e) => {
      const id = e.currentTarget.dataset.id
      switcherBtns.forEach(el => el.classList.remove('active'))
      e.currentTarget.classList.add('active')

      newsContent.forEach(el => {
        if (el.dataset.id === id) {
          el.classList.add('active')
        } else {
          el.classList.remove('active')
        }
      })
    }

    switcherBtns.forEach(el => el.addEventListener('click', toggleContent))
  }
});
