import sixGridItems from '@/scripts/plugins/six-grid-items';

window.addEventListener('load', () => {

  if (!document.querySelector('.services')) {
    return false;
  } else {

    // items animation
    const servicesItems = document.querySelectorAll('.services__item');
    sixGridItems(servicesItems);

  }
});
