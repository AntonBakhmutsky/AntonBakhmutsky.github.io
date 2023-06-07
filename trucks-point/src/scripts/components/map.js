import L from 'leaflet';

window.addEventListener('load', () => {
  if (!document.querySelector('.map')) {
    return null
  } else {
    let map = L.map('map').setView([60.055772, 30.375599], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 20,
      zoomControl: true,
      attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
    }).addTo(map);



    const btnOpenMapFilter = document.getElementById('map-filter');
    const imgMapFilter = document.querySelector('.map-filter-img')
    const listMapFilter = document.querySelector('.map-filter-list')
    const filterPage = document.querySelector('.filter')
    const closeFilterPage = document.getElementById('btnCloseFilter')

    btnOpenMapFilter.addEventListener('click', function (e) {
      e.stopPropagation()
      imgMapFilter.classList.add('none');
      listMapFilter.classList.add('block');
      filterPage.style.display = 'block';
    })

    closeFilterPage.addEventListener('click', function (){
      filterPage.style.display = 'none';
    })

  }

});
