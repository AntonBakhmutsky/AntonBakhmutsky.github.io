window.addEventListener('load', () => {
  if (document.querySelector('.product-tabs')) {
    const tabButtons = document.querySelectorAll('.product-tabs__switcher button')
    const tabs = [...document.querySelectorAll('.product-tabs__block')]

    const switchTab = (e) => {
      const currentTab = tabs.find(el => el.dataset.id === e.currentTarget.dataset.id)

      tabButtons.forEach(el => el.classList.remove('active'))
      e.currentTarget.classList.add('active')
      e.currentTarget.scrollIntoView({
        behavior: 'smooth',
        inline: 'center',
        block: 'nearest'
      })
      tabs.forEach(el => el.classList.remove('active'))
      currentTab.classList.add('active')
    }

    tabButtons.forEach(el => el.addEventListener('click', switchTab))
  }
})
