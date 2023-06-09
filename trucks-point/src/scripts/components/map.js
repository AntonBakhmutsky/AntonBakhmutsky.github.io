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



    const btnOpenMapFilterIndicators = document.getElementById('map-filter');
    const imgMapFilter = document.querySelector('.map-filter-img')
    const listMapFilter = document.querySelector('.map-filter-list')
    const filterPage = document.querySelector('.filter')
    const closeFilterPage = document.getElementById('btnCloseFilter')
    const btnOpenMapFilter = document.getElementById('btnFilterMini')

    btnOpenMapFilterIndicators.addEventListener('click', function (e) {
      e.stopPropagation()
      imgMapFilter.classList.add('none');
      listMapFilter.classList.add('block');
    })

    closeFilterPage.addEventListener('click', function (){
      filterPage.style.display = 'none';
    })

    btnOpenMapFilter.addEventListener('click', function (e) {
      e.stopPropagation()
      filterPage.style.display = 'block';
    })

    document.addEventListener("click", function(event) {
      const targetElement = event.target; // Получаем элемент, на который был совершен щелчок
      // Проверяем, является ли целью события элемент, который вы хотите закрыть
      const isClickInsideElement = listMapFilter.contains(targetElement);
      // Если целью события не является элемент, закрваем его
      if (!isClickInsideElement) {
        listMapFilter.classList.remove('block');
        imgMapFilter.classList.remove('none');
      }
    });


  }

});
