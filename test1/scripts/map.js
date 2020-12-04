window.addEventListener('load', () => {
  const plus = document.querySelector('.event-map__plus')
  const minus = document.querySelector('.event-map__minus')
  const map = document.querySelector('.event-map')
  const mapContainer = document.querySelector('.event-map__container')
  const mapImg = mapContainer.querySelector('img')
  let scrollWidth
  let winWidth

  const getWidth = () => {
    scrollWidth = mapContainer.scrollWidth
    winWidth = window.innerWidth
  }

  const setPosition = () => {
    if (map.offsetHeight > mapImg.offsetHeight) {
      mapImg.style.top = `${(map.offsetHeight - mapImg.offsetHeight) / 2}px`
    } else {
      mapImg.style.top = '0'
    }
    mapImg.style.opacity = '1'
  }

  const setWidth = (width) => mapContainer.style.minWidth = `${width}px`
  
  getWidth()
  setWidth(winWidth)
  setPosition()

  const mapIncrease = () => {
    getWidth()

    if (scrollWidth * 1.5 < 1024) {
      setWidth(scrollWidth * 1.5)
    } else {
      setWidth(1024)
    }
  }

  const mapDecrease = () => {
    getWidth()

    if (scrollWidth / 1.5 > winWidth) {
      setWidth(scrollWidth / 1.5)
    } else {
      setWidth(winWidth)
    }
  }

  plus.addEventListener('click', mapIncrease)
  minus.addEventListener('click', mapDecrease)  

  window.addEventListener('resize', () => {
      getWidth()
      setWidth(winWidth)
      setPosition()
  })
})