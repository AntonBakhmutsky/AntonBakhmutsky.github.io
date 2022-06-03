window.addEventListener('load', () => {
  if (!document.querySelector('.pa__menu')) {
    return false
  }

  const tabsContainer = document.querySelector('.pa__menu')

  if (tabsContainer && tabsContainer.scrollWidth > tabsContainer.offsetWidth) {
    const tabs = tabsContainer.querySelectorAll('a')
    const currentTab = [...tabs].find(el => el.classList.contains('active'))
    const rect = currentTab.getBoundingClientRect()
    let winWidth = window.innerWidth

    tabsContainer.scrollLeft = rect.x - winWidth / 2 + rect.width / 2
  }
})

