window.addEventListener('load', () => {
  // tabs
  const result = new UAParser().getResult()

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

    }, 20)
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
      
        if (rightX > winWidth) {
          shift = left + rightX - winWidth + winWidth / 2 - width / 2

          if (['mobile', 'tablet'].includes(result.device.type) && result.os.name === 'iOS') {
            alert('true')
            shiftAnimation('right', shift)
          } else {
            tabsContainer.scrollLeft = shift
          }

        } else if (leftX < 0) {
          shift = left + leftX - winWidth / 2 + width / 2

          if (['mobile', 'tablet'].includes(result.device.type) && result.os.name === 'iOS') {
            alert('true')
            shiftAnimation('left', shift)
          } else {
            tabsContainer.scrollLeft = shift
          }
        }    
      }, 300)
  }

  tabs.forEach(el => el.addEventListener('click', chooseTab))
});