document.addEventListener("DOMContentLoaded", function() {
  const toggleButton = document.querySelector(".symptoms_toggle-btn");
  const hiddenLinks = document.querySelectorAll(".symptoms-link.hidden");

  toggleButton.addEventListener("click", function() {
    hiddenLinks.forEach(link => {
      link.style.display = link.style.display === "none" ? "inline" : "none";
    });

    toggleButton.textContent = hiddenLinks[0].style.display === "none" ? "Показать ещё" : "Свернуть";
  });
});

