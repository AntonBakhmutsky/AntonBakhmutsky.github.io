window.addEventListener('load', () => {
  if (!document.querySelector('.switcher')) {
    return null
  } else {
    // news switcher

    const switcherBtns = document.querySelectorAll('.switcher__btn')
    const newsContent = document.querySelectorAll('.switch-content')

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
