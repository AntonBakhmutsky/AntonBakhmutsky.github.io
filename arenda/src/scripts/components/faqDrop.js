window.addEventListener('load', () => {
  const dropsTop = document.querySelectorAll('.drop__top')
  const dropsContainers = document.querySelectorAll('.drop')
  if (dropsTop) {
    dropsTop.forEach((el) => {
      el.addEventListener('click', clickEventHandler)
    })
    resizeDropContainers()
    window.addEventListener('resize', resizeDropContainers)

  }
  function clickEventHandler(event) {
    let element = event.target.closest('.drop__top')
    element.classList.toggle('active')
    let height = element.nextSibling.scrollHeight + element.offsetHeight
    if(element.scrollHeight === element.parentNode.offsetHeight)
      element.parentNode.style.height = `${height}px`
    else{
      element.parentNode.style.height = `${element.scrollHeight }px`
    }
  }
  function resizeDropContainers() {
    dropsContainers.forEach((el) => {
      let dropContainerTop = el.firstChild
      let dropContainerHeight = dropContainerTop.offsetHeight
      el.style.height = `${dropContainerHeight}px`
    })
  }
})
