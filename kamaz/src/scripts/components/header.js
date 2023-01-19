window.addEventListener('load', () => {

  // search
  const searchBtn = document.querySelector('.header__search-btn');
  const searchPanel = document.querySelector('.header__search');
  const kamazLogo = document.querySelector('.header__logo_kamaz');
  const panelList = searchPanel.classList;
  const kamazList = kamazLogo.classList;
  const header = document.querySelector('.header');
  let scrollPosition = 0, winWidth = window.innerWidth;

  const toggleSearch = () => {
    !panelList.contains('active') ? panelList.add('active') : panelList.remove('active');

    if (scrollPosition === 0 && !kamazList.contains('active')) {
      kamazList.add('active');
    } else if (scrollPosition === 0 && kamazList.contains('active')) {
      kamazList.remove('active');
    }
  }

  searchBtn.addEventListener('click', toggleSearch)

  // sticky header
  window.addEventListener('scroll', () => {

    if (window.scrollY > scrollPosition && winWidth > 1024  ) {
      scrollPosition = window.scrollY;
      if (!header.hasAttribute('style')) {
        header.style.transform = 'translateY(-90px)';
        kamazList.add('active');
      }

      if (panelList.contains('active')) {
        panelList.remove('active');
      }

    } else {
      scrollPosition = window.scrollY;

      if (header.hasAttribute('style')) {
        header.removeAttribute('style');
      }
      if (scrollPosition === 0 && kamazList.contains('active') && !panelList.contains('active')) {
        kamazList.remove('active');
      }
    }

  });

  window.addEventListener('resize', () => {
    if (winWidth !== window.innerWidth) {
      winWidth = window.innerWidth;
      header.removeAttribute('style');
    }
  });
});
