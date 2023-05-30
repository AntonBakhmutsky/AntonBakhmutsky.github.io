window.addEventListener('load', () => {
  if (!document.querySelector('.one-report')) {
    return null
  } else {

    const btnToggleFilter = document.getElementById('btnToggleFilter')
    const pointsFilter = document.querySelector('.one-report-filter-points')
    const btnsFilter = document.querySelector('.one-report-filter-btns')

    btnToggleFilter.addEventListener('click', function (event) {
      event.preventDefault();
      pointsFilter.classList.toggle('grid')
      btnsFilter.classList.toggle('flex')
      btnToggleFilter.classList.toggle('one-report-filter-head__toggle-open')
    })





    const elementsA = document.querySelectorAll(".one-report-list-item");

// Для каждого элемента А добавляем обработчик события
    elementsA.forEach(function(elementA) {
      const toggleButtonA = elementA.querySelector(".one-report-list-item-title-logist__btn");
      const elementBs = elementA.querySelectorAll(".one-report-list-item-subtitle");

      toggleButtonA.addEventListener("click", function() {
        elementBs.forEach(function(elementB) {
          const toggleButtonB = elementB.querySelector(".one-report-list-item-subtitle-car__btn");
          const elementCs = elementB.querySelectorAll(".one-report-list-item-subtitle-info");

          toggleButtonB.addEventListener("click", function(event) {
            console.log('it works')
            elementCs.forEach(function(elementC) {
              elementC.classList.toggle("flex");
              console.log('it works2')
            });

            toggleButtonB.classList.toggle("active");
          });

          elementB.classList.toggle("flex");
        });

        toggleButtonA.classList.toggle("active");
      });
    });



  }
});
