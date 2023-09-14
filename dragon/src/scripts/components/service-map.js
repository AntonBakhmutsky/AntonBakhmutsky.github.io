import maps from '../helpers/map';

window.addEventListener('load', () => {
  if (!document.querySelector('#serviceMap')) {
    return null
  } else {
    main();

    async function main() {
      await ymaps3.ready
      const {
        YMap,
        YMapDefaultSchemeLayer,
        YMapMarker,
        YMapControls,
        YMapDefaultFeaturesLayer,
        YMapFeatureDataSource,
        YMapLayer
      } = ymaps3

      const {YMapZoomControl, YMapGeolocationControl} = await ymaps3.import('@yandex/ymaps3-controls@0.0.1');
      const {YMapOpenMapsButton} = await ymaps3.import('@yandex/ymaps3-controls-extra')

      const serviceMap = new YMap(document.getElementById('serviceMap'), {
        location: {
          center: [70.51859654992892, 59.617033407411874],
          zoom: 4,
        },
        mode: 'vector'
      })

      serviceMap.addChild(new YMapControls({position: 'right'}).addChild(new YMapZoomControl({})))
      serviceMap.addChild(new YMapControls({position: 'left'}).addChild(new YMapGeolocationControl({})))
      serviceMap.addChild(new YMapControls({position: 'top left'}).addChild(new YMapOpenMapsButton({})))

      serviceMap.addChild(new YMapDefaultFeaturesLayer({}))
      serviceMap.addChild(new YMapDefaultSchemeLayer({}))

      serviceMap.addChild(new YMapFeatureDataSource({id: 'popups'}))
      serviceMap.addChild(new YMapLayer({source: 'popups'}))

      for (const map of maps) {
        const markerContent = document.createElement('div');
        markerContent.classList.add(`map__marker`)
        markerContent.classList.add(`map__marker_${map.modifier}`)
        markerContent.innerHTML = `
            <div class="popup">
                <div class="popup__body">
                    <div class="popup__close"></div>
                    <div class="popup__type popup__type_${map.modifier}">${map.modifier === 'shop' ? 'магазин запчастей' : 'сервисный центр'}</div>
                    <div class="popup__name">${map.name}</div>
                    <p class="popup__txt">
                        <span>Адрес:</span>
                        <span>${map.address}</span>
                    </p>
                    <p class="popup__txt">
                        <span>Режим работы:</span>
                        <span>${map.time}</span>
                    </p>
                    <a class="popup__tel" href="tel:+${map.tel.match(/\d/g).join('')}">${map.tel}</a>
                    <a class="popup__mail" href="mailto:${map.mail}">${map.mail}</a>
                </div>
            </div>
        `

        function togglePopup(e) {
          e.stopPropagation()
          if (!e.target.closest('.popup__close') && !this.classList.contains('active')) {
            this.classList.add('active')
            document.querySelectorAll('.map__marker:not(.active)').forEach(el => el.classList.add('disabled'))

          } else if (e.target.closest('.popup__close')){
            this.classList.remove('active')
            document.querySelectorAll('.map__marker:not(.active)').forEach(el => el.classList.remove('disabled'))
          }
        }

        markerContent.addEventListener('click', togglePopup)

        const marker = new YMapMarker({
          coordinates: map.coordinates,
          popup: {
            content: '<div class="div"></div>',
            position: window.innerWidth
          }
        }, markerContent)
        serviceMap.addChild(marker)
      }
    }
  }
});
