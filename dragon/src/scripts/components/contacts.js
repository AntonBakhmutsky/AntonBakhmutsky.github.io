window.addEventListener('load', () => {
  if (!document.querySelector('.contacts')) {
    return null
  } else {
    ymaps.ready(function () {
      // desktop maps
      const map = new ymaps.Map('map', {
        center: [59.66768456450318, 30.651756999999925],
        zoom: 13,
        controls: [],
      })

      const iconContentLayout = ymaps.templateLayoutFactory.createClass(
        '<div class="map__address">$[properties.iconContent]</div>'
      )

      const redForest = new ymaps.Placemark([59.66768456450318, 30.651756999999925], {
      }, {
        iconLayout: 'default#image',
        iconImageHref: require('@/assets/img/contacts/marker.svg'),
        iconImageSize: window.innerWidth > 1024 ? [43, 72] : [29, 48],
        iconImageOffset: window.innerWidth > 1024 ? [-30, -80] : [-10, -40],
      })

      map.geoObjects.add(redForest)
    });
  }
});
