window.addEventListener('load', () => {
  if (document.querySelector('.symptoms')) {

    const toggleButton = document.querySelector(".symptoms_toggle-btn");
    const hiddenLinks = document.querySelectorAll(".symptoms-link.hidden");

    toggleButton.addEventListener("click", function() {
      hiddenLinks.forEach(link => {
        link.style.display = link.style.display === "none" ? "inline" : "none";
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
          link.classList.remove('hidden');
        }
      });
    }

    // Вызываем функцию при загрузке страницы и изменении размера окна
    updateSymptomsVisibility();
    window.addEventListener('resize', updateSymptomsVisibility);

  }
})

