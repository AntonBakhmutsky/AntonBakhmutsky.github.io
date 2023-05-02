import L from 'leaflet';


window.addEventListener('load', () => {
  if (!document.querySelector('.map')) {
    return null
  } else {
    let map = L.map('map').setView([51.505, -0.09], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
    }).addTo(map);

  }

});
