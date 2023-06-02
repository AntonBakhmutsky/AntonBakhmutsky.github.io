window.addEventListener('load', () => {
  if (!document.querySelector('.menu')) {
    return null
  } else {
    const menuToggle = document.querySelector('#menu-toggle');
    const menu = document.querySelector('.menu');
    const menuContainer = document.querySelector('.menu-container');
    const menuNavName = document.querySelector('.list__text');
    const btnToggleImg = document.querySelector('.menu__toggle_img');

    menuToggle.addEventListener('click', function() {
      menu.classList.toggle('menu-max');
      menuNavName.classList.toggle('hide-list__text')
      menuContainer.classList.toggle('menu-container-max')
    });

  }
});
