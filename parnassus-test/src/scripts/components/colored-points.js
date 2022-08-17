window.addEventListener('load', () => {
  const coloredPoints = document.querySelectorAll('.colored-point')

  if (coloredPoints.length) {
    coloredPoints.forEach(el => {
      el.addEventListener('click', () => {
        coloredPoints.forEach(el => el.classList.remove('active'))
        el.classList.add('active')
      })
    })
  }
})
