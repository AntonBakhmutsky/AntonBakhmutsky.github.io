window.addEventListener('load', () => {
  // sticky header
  const header = document.querySelector('.header')
  let scrollPosition = 0

  if (window.scrollY !== 0) {
    header.classList.add('sticky')
    header.style.transform = 'translateY(-80px)'
  }

  window.addEventListener('scroll', () => {
    if (window.scrollY > scrollPosition) {
      scrollPosition = window.scrollY
      if (!header.hasAttribute('style')) {
        header.style.transform = 'translateY(-80px)';
      }
    } else  {
      scrollPosition = window.scrollY;

      if (header.hasAttribute('style')) {
        header.removeAttribute('style');
        header.classList.add('sticky')
      } else if (scrollPosition === 0) {
        header.classList.remove('sticky')
      }
    }
  })

  // header menu
  const menu = document.querySelector('.header__menu')
  const menuBtn = document.querySelector('.header__burger')
  const menuClose = document.querySelector('.header__menu-close')
  const menuItems = document.querySelectorAll('.header__menu-item')

  const toggleMenu = () => {
    if (window.innerWidth < 1025) {
      menu.classList.toggle('active')
      document.body.classList.toggle('body_fix')
    }
  }

  menuBtn.addEventListener('click', toggleMenu)
  menuClose.addEventListener('click', toggleMenu)
  menuItems.forEach(el => el.addEventListener('click', toggleMenu))
});
