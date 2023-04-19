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
        YMapDefaultFeaturesLayer
      } = ymaps3

      const {YMapZoomControl, YMapGeolocationControl} = await ymaps3.import('@yandex/ymaps3-controls@0.0.1');
      const {YMapOpenMapsButton} = await ymaps3.import('@yandex/ymaps3-controls-extra')

      const serviceMap = new YMap(document.getElementById('serviceMap'), {
        location: {
          center: [30.27519509621456, 59.86463810516632],
          zoom: 10,
        },
        mode: 'vector'
      })

      serviceMap.addChild(new YMapControls({position: 'right'}).addChild(new YMapZoomControl({})))
      serviceMap.addChild(new YMapDefaultFeaturesLayer({id: 'features'}))
      serviceMap.addChild(new YMapControls({position: 'left'}).addChild(new YMapGeolocationControl({})))
      serviceMap.addChild(new YMapControls({position: 'top left'}).addChild(new YMapOpenMapsButton({})))

      const layer = new YMapDefaultSchemeLayer({
                      customization: [
                        {
                          tags: {
                            all: ['water', 'road', 'landscape'],
                          },
                          elements: 'geometry',
                          stylers: [
                            {
                              opacity: 0
                            }
                          ]
                        }
                      ]
                    })

      serviceMap.addChild(layer)

      const serviceContent = document.createElement('div')
      const shopContent = document.createElement('div')
      serviceContent.innerHTML = `<div class="map__marker map__marker_service"></div>`
      shopContent.innerHTML = `<div class="map__marker map__marker_shop"></div>`

      serviceMap.addChild(new YMapMarker({
        coordinates: [30.651756999999925, 59.66768456450318],
      }, serviceContent))

      serviceMap.addChild(new YMapMarker({
        coordinates: [30.651756999999925, 59.66768456450318],
      }, serviceContent))
    }
  }
});
