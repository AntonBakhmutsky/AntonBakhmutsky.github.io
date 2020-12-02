window.addEventListener('load', () => {
  // tabs
  const tabs = document.querySelectorAll('.tab__btn')
  const tabsContainer = document.querySelector('.tab__container')
  const activeClass = (document.querySelector('.tab__btn').classList.contains('tab__btn_gradientTheme')) ? 'tab__btn_active_gradientTheme' : 'tab__btn_active'
  let winWidth
  let left
  
  const getRounding = (num) => Math.ceil(num)

  function shiftAnimation(direction, x) {
    let draw = setInterval(() => {
      if (direction === 'right') {
        tabsContainer.scrollLeft += 10

        if (tabsContainer.scrollLeft >= x) {
          clearInterval(draw)
        }
      } else if (direction === 'left') {
        tabsContainer.scrollLeft -= 10

        if (tabsContainer.scrollLeft <= x) {
          clearInterval(draw)
        }
      }

    }, 10)
  }
  
  function chooseTab(event) {
    const tab = event.currentTarget
    left = tabsContainer.scrollLeft

    if (tab.classList.contains(activeClass)) {
      return false
    }

    tabs.forEach(el => el.classList.remove(activeClass))
    tab.classList.add(activeClass)    
    
    setTimeout(() => {
        const rect = tab.getBoundingClientRect()
        winWidth = window.innerWidth
      
        const leftX = getRounding(rect.x) 
        const width = getRounding(rect.width)
        const rightX = leftX + width
        alert(navigator.userAgent)
      
        if (rightX > winWidth) {
          shift = left + rightX - winWidth + 10
          if (winWidth > 1024) {
            tabsContainer.scrollLeft = shift
          } else {
            shiftAnimation('right', shift)
          }
        } else if (leftX < 0) {
          shift = left + leftX - 10
          if (winWidth > 1024) {
            tabsContainer.scrollLeft = shift
          } else {
            shiftAnimation('left', shift)
          }
        }    
      }, 300)
  }

  tabs.forEach(el => el.addEventListener('click', chooseTab))
});