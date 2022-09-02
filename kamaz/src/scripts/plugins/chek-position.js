export default function (target) {

  const targetPosition = {
      top: window.scrollY + target.getBoundingClientRect().top,
      left: window.scrollX + target.getBoundingClientRect().left,
      right: window.scrollX + target.getBoundingClientRect().right,
      bottom: window.scrollY + target.getBoundingClientRect().bottom
    },

    windowPosition = {
      top: window.scrollY,
      left: window.scrollX,
      right: window.scrollX + document.documentElement.clientWidth,
      bottom: window.scrollY + document.documentElement.clientHeight
    };

  return targetPosition.bottom > windowPosition.top && targetPosition.top < windowPosition.bottom && targetPosition.right > windowPosition.left && targetPosition.left < windowPosition.right;
};
