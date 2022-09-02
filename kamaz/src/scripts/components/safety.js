import sixGridItems from '@/scripts/plugins/six-grid-items';

window.addEventListener('load', () => {

  if (!document.querySelector('.safety')) {
    return false;
  } else {

    // items animation
    const safetyItems = document.querySelectorAll('.safety__item');
    sixGridItems(safetyItems);

  }
});
