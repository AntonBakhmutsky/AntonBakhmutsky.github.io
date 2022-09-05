import numsAnimation from '@/scripts/plugins/numbers-animation';

window.addEventListener('load', () => {

  if (!document.querySelector('.suspension')) {
    return false;
  } else {
    // nums animation
    const nums = document.querySelectorAll('.suspension__sub-title span');
    numsAnimation(nums);
  }
});
