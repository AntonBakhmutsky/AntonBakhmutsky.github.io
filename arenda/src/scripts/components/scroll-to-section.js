window.addEventListener('load', () => {
  const buttons = document.querySelectorAll('[data-scroll]')

  function scrollToSection() {
    const section = document.querySelector(`#${this.dataset.scroll}`) || null
    if (section) {
      const y = section.getBoundingClientRect().top
      window.scrollBy({
        top: y - document.querySelector('.header').offsetHeight
      })
    }
  }

  buttons.forEach(el => el.addEventListener('click', scrollToSection))
})
