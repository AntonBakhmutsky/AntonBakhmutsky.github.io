document.addEventListener("DOMContentLoaded", function() {
  const toggleButton = document.querySelector(".symptoms_toggle-btn");
  const symptomsContainer = document.querySelector(".symptoms-container");

  toggleButton.addEventListener("click", function() {
    symptomsContainer.classList.toggle("expanded");
    toggleButton.textContent = symptomsContainer.classList.contains("expanded") ? "Свернуть" : "Показать ещё";
  });
});
