import numsAnimation from '@/scripts/plugins/numbers-animation';

window.addEventListener('load', () => {

  if (!document.querySelector('.semitrailer')) {
    return false;
  } else {
    // nums animation
    const nums = document.querySelectorAll('.semitrailer__length span');
    numsAnimation(nums);
  }
});
