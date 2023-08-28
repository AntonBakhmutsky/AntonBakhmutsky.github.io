window.addEventListener('load', () => {
  if (document.querySelector('.switcher')) {
    function initSwitcher(switcher) {
      const switcherButtons = switcher.querySelectorAll('.switcher__btns-item')

      function switchContent() {
        const contentItems = [...this.closest('.switcher').querySelector('.switcher__content').children]
        switcherButtons.forEach(el => el.classList.remove('active'))
        contentItems.forEach(el => el.classList.remove('active'))
        this.classList.add('active')
        contentItems[+this.dataset.id].classList.add('active')
      }

      switcherButtons.forEach(el => el.addEventListener('click', switchContent))
    }

    document.querySelectorAll('.switcher').forEach(el => initSwitcher(el))
  }
})

