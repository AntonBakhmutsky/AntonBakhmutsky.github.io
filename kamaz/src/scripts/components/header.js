window.addEventListener('load', () => {

  // search
  const searchBtn = document.querySelector('.header__search-btn');
  const searchPanel = document.querySelector('.header__search');
  const kamazLogo = document.querySelector('.header__logo_kamaz');

  const toggleSearch = () => {
    const panelList = searchPanel.classList;
    const kamazList = kamazLogo.classList

    !panelList.contains('active') ? panelList.add('active') : panelList.remove('active');
    !kamazList.toggle('active');

    // !searchPanel.hasAttribute('style') ? searchPanel.style.maxHeight = `${searchPanel.scrollHeight + 9}px` : searchPanel.removeAttribute('style')
  }

  searchBtn.addEventListener('click', toggleSearch)

});
