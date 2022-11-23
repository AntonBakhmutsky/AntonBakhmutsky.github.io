import ymaps from 'ymaps'

window.addEventListener('load', () => {
  if (!document.querySelector('#map')) {
    return false
  } else {
    ymaps
      .load('https://api-maps.yandex.ru/2.1/?apikey=56464b72-c230-4b3f-94d1-ec633e7f2937&lang=ru_RU')
      .then(maps => {
        const map = new maps.Map('map', {
          center: [55.55288905665512, 46.27657298046876],
          zoom: 5,
          controls: [],
          behaviors: ['drag'],
        })
        var myGeoObject = new ymaps.GeoObject({
          geometry: {
            type: "Point", // тип геометрии - точка
            coordinates: [55.8, 37.8] // координаты точки
          }
        });
        map.controls.add('zoomControl', {
          position: {
            top: 280,
            left: 'auto',
            right: 10,
            bottom: 'auto'
          },
          size: 'small'
        })
        map.controls.add('geolocationControl', {
          position: {
            top: 360,
            left: 'auto',
            right: 10,
            bottom: 'auto'
          }
        })
      })
      .catch(error => console.log('Failed to load Yandex Maps', error))
  }
})
