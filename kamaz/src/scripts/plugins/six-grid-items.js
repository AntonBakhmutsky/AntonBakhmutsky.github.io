import inViewport from "@/scripts/plugins/inViewport";
import anime from "animejs";

export default function (items) {

  items.forEach((el, i )=> {
    inViewport(el, () => {
      if (window.innerWidth > 1024) {
        if (i < 3) {
          anime({
            targets: el,
            opacity: [.6, 1],
            translateY: [150, 0],
            duration: 1000,
            delay: i * 150,
            easing: 'easeOutQuart'
          })
        } else {
          anime({
            targets: el,
            opacity: [.6, 1],
            translateY: [150, 0],
            duration: 1000,
            delay: (i - 3) * 150,
            easing: 'easeOutQuart'
          })
        }
      } else {
        anime({
          targets: el,
          opacity: [0, 1],
          translateY: [150, 0],
          duration: 1000,
          easing: 'easeOutQuart'
        })
      }
    });
  });

}
