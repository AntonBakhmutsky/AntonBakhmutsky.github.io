window.addEventListener('load', () => {
  if (document.querySelector('.header')) {
    // скрытое меню десктоп
    const bottomMenuLinks = document.querySelectorAll('.header__bottom-menu a')
    const hiddenMenu = document.querySelector('.header__hidden')
    const hiddenMenuItems = [...hiddenMenu.children]
    const hiddenMenuLinks = hiddenMenu.querySelectorAll('.header__hidden-links-item')
    const hiddenMenuButtons = hiddenMenu.querySelectorAll('.header__hidden-btn')
    const overlay = document.querySelector('.overlay')

    const clearItems = (items) => items.forEach(el => el.classList.remove('active'))

    function toggleHiddenMenu() {
      if (!this.classList.contains('active')) {
        clearItems(bottomMenuLinks)
        this.classList.add('active')
        hiddenMenu.classList.add('active')
        hiddenMenuItems.forEach(el => el.classList.remove('active'))
        const menuItem = hiddenMenuItems.find(el => el.dataset.id === this.dataset.id)
        menuItem.classList.add('active')
        menuItem.querySelector('.header__hidden-links-item').classList.add('active')
        overlay.classList.add('active')
      } else {
        closeHiddenMenu()
      }
    }

    function closeHiddenMenu() {
      clearItems(bottomMenuLinks)
      clearItems(hiddenMenuItems)
      clearItems(hiddenMenuLinks)
      hiddenMenu.classList.remove('active')
      overlay.classList.remove('active')
    }

    function toggleMenuButtons() {
      const links = [...this.parentElement.nextElementSibling.children]
      links.forEach(el => el.classList.remove('active'))
      links[+this.dataset.id].classList.add('active')
    }

    bottomMenuLinks.forEach(el => el.addEventListener('click', toggleHiddenMenu))
    hiddenMenuButtons.forEach(el => el.addEventListener('mouseover', toggleMenuButtons))
    overlay.addEventListener('click', closeHiddenMenu)
  }
})
