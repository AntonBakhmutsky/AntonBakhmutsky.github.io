window.addEventListener('load', () => {
  if (document.querySelector('.symptoms')) {

    const toggleButton = document.querySelector(".symptoms_toggle-btn");
    const hiddenLinks = document.querySelectorAll(".symptoms-link.hidden");

    toggleButton.addEventListener("click", function() {
      hiddenLinks.forEach(link => {
        const computedStyle = window.getComputedStyle(link);
        const currentDisplay = computedStyle.getPropertyValue('display');
        link.style.display = currentDisplay === "none" ? "inline" : "none";
      });

      toggleButton.textContent = hiddenLinks[0].style.display === "none" ? "Показать ещё" : "Свернуть";
    });

    function updateSymptomsVisibility() {
      const screenWidth = window.innerWidth;
      const symptomsLinks = document.querySelectorAll('.symptoms-link');

      symptomsLinks.forEach(function(link, index) {
        if (screenWidth < 576) {
          link.classList.toggle('hidden', index > 5);
        } else {
          return null
        }
      });
    }

    // Вызываем функцию при загрузке страницы и изменении размера окна
    updateSymptomsVisibility();
    window.addEventListener('resize', updateSymptomsVisibility);

  }
})

