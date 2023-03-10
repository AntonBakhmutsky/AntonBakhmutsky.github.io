window.addEventListener('load', () => {
  const servicesItems = document.querySelectorAll('.services__item')

  const showItemTxt = (e) => {
    const target = e.currentTarget
    const txt = target.querySelector('.services__item-txt')
    txt.style.maxHeight = `${txt.scrollHeight}px`
    target.classList.add('active')
  }

  const hideItemTxt = (e) => {
    const target = e.currentTarget
    const txt = target.querySelector('.services__item-txt')
    txt.removeAttribute('style')
    target.classList.remove('active')

  }

  servicesItems.forEach(el => el.addEventListener('mouseenter', showItemTxt))
  servicesItems.forEach(el => el.addEventListener('mouseleave', hideItemTxt))
});
