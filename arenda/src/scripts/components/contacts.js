window.addEventListener('load', () => {
  if (document.querySelector('#contactsMap')) {

    ymaps.ready(function () {
      const contactsMap = new ymaps.Map('contactsMap', {
        center: [59.66768456450318, 30.651756999999925],
        zoom: 12,
        controls: []
      }, {
        searchControlProvider: 'yandex#search'
      })


      function setGeoObjects(address, map) {
        const placemark = new ymaps.Placemark(address.coords, {
          hintContent: address.address,
        }, {
          iconLayout: 'default#image',
          iconImageHref: require('@/assets/img/contacts/map-marker.svg'),
          iconImageSize: [31, 52],
          iconContentOffset: [0, 0],
        })

        map.geoObjects.add(placemark)
      }

      setGeoObjects({coords: [59.66768456450318, 30.651756999999925], address: 'п. Красный Бор,  ул. Промышленная 3'}, contactsMap)
    })
  }
})
