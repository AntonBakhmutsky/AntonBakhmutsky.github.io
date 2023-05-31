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

      toggleButtonA.addEventListener("click", function() {
        const elementBs = elementA.querySelectorAll(".one-report-list-item-subtitle");

        elementBs.forEach(function(elementB) {
          const toggleButtonB = elementB.querySelector(".one-report-list-item-subtitle-car__btn");
          const elementC = elementB.querySelectorAll(".one-report-list-item-subtitle-info");

          toggleButtonB.addEventListener("click", function(event) {
            elementC.forEach(function(elementC) {
              elementC.classList.toggle("block");
            });

            toggleButtonB.classList.toggle("active");
          });

          elementB.classList.toggle("block");
          elementC.forEach(function(elementC) {
            elementC.classList.remove("block");
          });

        });

        toggleButtonA.classList.toggle("active");
      });
    });



  }
});
