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

    // мобильное меню
    const mobileMenu = document.querySelector('.mobile-menu')
    const mobileMenuContainer = document.querySelector('.mobile-menu__hidden')
    const mobileMenuContainerLinks = document.querySelector('.mobile-menu__hidden-links')
    const mobileMenuContainerTitle = document.querySelector('.mobile-menu__hidden-title')
    const burger = document.querySelector('.header__burger')

    function toggleMenu(e) {
      if (e.currentTarget.classList.contains('active')) {
        closeMobileMenu()
      } else {
        document.body.classList.add('body_fix')
        mobileMenu.classList.add('active')
        overlay.classList.add('active')
        burger.classList.add('active')
      }
    }

    function closeMobileMenu() {
      mobileMenu.classList.remove('active')
      mobileMenuContainer.classList.remove('active')
      document.body.classList.remove('body_fix')
      overlay.classList.remove('active')
      burger.classList.remove('active')
    }

    function toggleMenuContent(e) {
      let button = null, links

      if (e.target.closest('.mobile-menu__btn')) {
        button = e.target.closest('.mobile-menu__btn')
      }

      if (button) {
        mobileMenuContainerTitle.querySelector('span').textContent = button.querySelector('span').textContent
        if (button.querySelector('.mobile-menu__btn-hidden').children.length > 1) {
          links = [...button.querySelector('.mobile-menu__btn-hidden').children]
        } else {
          links = [...button.querySelector('.mobile-menu__btn-hidden').children[0].children]
        }
        mobileMenuContainerLinks.innerHTML = ''
        links.forEach(el => mobileMenuContainerLinks.insertAdjacentElement('beforeend', el.cloneNode(true)))
        mobileMenuContainer.classList.add('active')
      }
    }

    mobileMenuContainerTitle.addEventListener('click', function() {
      this.parentElement.classList.remove('active')
    })

    burger.addEventListener('click', toggleMenu)
    overlay.addEventListener('click', closeMobileMenu)
    mobileMenu.addEventListener('click', toggleMenuContent)
    mobileMenuContainer.addEventListener('click', toggleMenuContent)
  }
})
