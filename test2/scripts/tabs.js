window.addEventListener('load', () => {
  // tabs
  const result = new UAParser().getResult()

  const tabs = document.querySelectorAll('.tab__btn')
  const tabsContainer = document.querySelector('.tab__container')
  const activeClass = (document.querySelector('.tab__btn').classList.contains('tab__btn_gradientTheme')) ? 'tab__btn_active_gradientTheme' : 'tab__btn_active'
  let winWidth
  let left
  let shift
  
  function shiftAppleAnimation(direction, x) {
    let draw = setInterval(() => {
      if (direction === 'right') {
        tabsContainer.scrollLeft += 10

        if (tabsContainer.scrollLeft >= x || tabsContainer.scrollLeft === tabsContainer.scrollWidth) {
          clearInterval(draw)
        }

      } else if (direction === 'left') {
          tabsContainer.scrollLeft -= 10

        if (tabsContainer.scrollLeft <= x || tabsq.scrollLeft === 0) {
          clearInterval(draw)
        }
      }

    }, 20)
  }

  function setShift(direction, shift) {    
    if (['mobile', 'tablet'].includes(result.device.type) && result.os.name === 'iOS') {
      shiftAppleAnimation(direction, shift)
    } else {
      tabsContainer.scrollLeft = shift
    }
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

        const leftX = rect.x 
        const width = rect.width
        const rightX = leftX + width
      
        if (leftX + width / 2 < winWidth / 2) {
          shift = left + rightX - winWidth + winWidth / 2 - width / 2
          setShift('left', shift)
        } else {
          shift = left + leftX - winWidth / 2 + width / 2
          setShift('right', shift)  
        }    
      }, 300)
  }

  tabs.forEach(el => el.addEventListener('click', chooseTab))
});