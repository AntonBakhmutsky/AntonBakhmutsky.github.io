window.addEventListener('load', () => {
  if (document.querySelector('.header')) {
    // скрытое меню десктоп
    const bottomMenuLinks = document.querySelectorAll('.header__bottom-menu a')
    const hiddenMenu = document.querySelector('.header__hidden')
    const hiddenMenuItems = [...hiddenMenu.children]

    const clearLinks = () => bottomMenuLinks.forEach(el => el.classList.remove('active'))

    function toggleHiddenMenu() {
      if (!this.classList.contains('active')) {
        clearLinks()
        this.classList.add('active')
        hiddenMenu.classList.add('active')
      } else {
        closeHiddenMenu()
      }
    }

    function closeHiddenMenu() {
      clearLinks()
    }

    function toggleMenuLinks() {

    }

    bottomMenuLinks.forEach(el => el.addEventListener('click', toggleHiddenMenu))
  }
})
