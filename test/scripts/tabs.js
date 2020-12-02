window.addEventListener('load', () => {
  // tabs
  const tabs = document.querySelectorAll('.tab__btn')
  const tabsContainer = document.querySelector('.tab__container')
  const activeClass = (document.querySelector('.tab__btn').classList.contains('tab__btn_gradientTheme')) ? 'tab__btn_active_gradientTheme' : 'tab__btn_active'
  let winWidth
  let left
  
  const getRounding = (num) => Math.ceil(num)
  
  function chooseTab(event) {
    const tab = event.currentTarget

    if (tab.classList.contains(activeClass)) {
      return false
    }

    tabs.forEach(el => el.classList.remove(activeClass))
    tab.classList.add(activeClass)    
    
    setTimeout(() => {
        const rect = tab.getBoundingClientRect()
        console.log(rect)
        winWidth = window.innerWidth
        left = tabsContainer.scrollLeft
      
        const leftX = getRounding(rect.x) 
        const width = getRounding(rect.width)
        const rightX = leftX + width
      
        if (rightX > winWidth) {
          tabsContainer.scrollLeft = left + rightX - winWidth + 10
        } else if (leftX < 0) {
          tabsContainer.scrollLeft = left + leftX - 10
        }    
      }, 300)
  }

  tabs.forEach(el => el.addEventListener('click', chooseTab))
});