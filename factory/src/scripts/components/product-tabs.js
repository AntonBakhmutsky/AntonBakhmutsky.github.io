window.addEventListener('load', () => {
  if (!document.querySelector('.product-tabs')) {
    return false
  } else {
    const tabButtons = document.querySelectorAll('.product-tabs__switcher button')
    const tabs = [...document.querySelectorAll('.product-tabs__block')]

    const switchTab = (e) => {
      const currentTab = tabs.find(el => el.dataset.id === e.currentTarget.dataset.id)

      tabButtons.forEach(el => el.classList.remove('active'))
      e.currentTarget.classList.add('active')
      tabs.forEach(el => el.classList.remove('active'))
      currentTab.classList.add('active')
    }

    tabButtons.forEach(el => el.addEventListener('click', switchTab))
  }
})
