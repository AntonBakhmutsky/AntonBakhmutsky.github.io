window.addEventListener('load', () => {

  function preloader() {
    document.querySelector('.preloader').classList.add('active')

    setTimeout(() => {
      document.querySelector('.preloader').classList.remove('active')
    }, 2000)
  }

  preloader()

  document.querySelectorAll('.menu__item').forEach(el => {
    el.addEventListener('click', preloader)
  })
})
