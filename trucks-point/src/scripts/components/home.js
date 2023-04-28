
//PAGE HOME

window.addEventListener('load', () => {
  if (!document.querySelector('.home')) {
    return null
  } else {
    const organizationPage = document.getElementById("organization-page");
    const settingsPage = document.getElementById("settings-page");
    const organizationBtn = document.getElementById("organization-btn");
    const settingsBtn = document.getElementById("settings-btn");


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
  }

});


