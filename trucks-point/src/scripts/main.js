const organizationPage = document.getElementById("organization-page");
const settingsPage = document.getElementById("settings-page");
const organizationBtn = document.getElementById("organization-btn");
const settingsBtn = document.getElementById("settings-btn");

const menuToggle = document.querySelector('#menu-toggle');
const menu = document.querySelector('.menu');
const menuNavName = document.querySelector('.list__text');
const btnToggleImg = document.querySelector('.menu__toggle_img');

organizationBtn.addEventListener("click", () => {
  organizationPage.style.display = "flex";
  settingsPage.style.display = "none";
  organizationBtn.classList.add("active");
  settingsBtn.classList.remove("active");
});

settingsBtn.addEventListener("click", () => {
  settingsPage.style.display = "block";
  organizationPage.style.display = "none";
  settingsBtn.classList.add("active");
  organizationBtn.classList.remove("active");
});

organizationBtn.click();
organizationBtn.classList.add("active");

menuToggle.addEventListener('click', function() {
  menu.classList.toggle('menu-min');
  menuNavName.classList.toggle('hide-list__text')
});

organizationBtn.click();
