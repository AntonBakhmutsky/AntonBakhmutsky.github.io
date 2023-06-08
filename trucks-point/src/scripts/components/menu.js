window.addEventListener('load', () => {
  if (!document.querySelector('.menu')) {
    return null
  } else {
    const menuToggle = document.querySelector('#menu-toggle');
    const menu = document.querySelector('.menu');
    const menuContainer = document.querySelector('.menu-container');
    const menuNavName = document.querySelector('.list__text');
    const btnToggleImg = document.querySelector('.menu__toggle_img');
    const mainContent = document.querySelector("main");

    if (!document.querySelector('.one-application-info')) {
      menuToggle.addEventListener('click', function() {
        menu.classList.toggle('menu-max');
        menuNavName.classList.toggle('hide-list__text')
        menuContainer.classList.toggle('menu-container-max')
        mainContent.classList.toggle('content-open')
      });
    } else {
      const oneAppInfoPage = document.querySelector('.one-application-info')
      const oneAppIndicators = document.querySelector('.plan-indicators')

      menuToggle.addEventListener('click', function() {
        menu.classList.toggle('menu-max');
        menuNavName.classList.toggle('hide-list__text')
        menuContainer.classList.toggle('menu-container-max')
        mainContent.classList.toggle('content-open')
        oneAppInfoPage.classList.toggle('content-open')
        oneAppIndicators.classList.toggle('content-open')
      });
    }


    // function toggleMenu() {
    //   if (menu.classList.contains("menu-max")) {
    //     mainContent.classList.remove("content-open");
    //   } else {
    //     menu.classList.add("menu-open");
    //     mainContent.classList.add("menu-open");
    //   }
    // }

  }
});
