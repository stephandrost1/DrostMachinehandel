const hamburger = document.querySelector(".hamburger-icon-wrapper");
const menuMobile = document.querySelector("#navbar-expanded-mobile");

if (hamburger && menuMobile) {
    hamburger.addEventListener("click", function () {
        if (menuMobile.classList.contains("open")) {
            menuMobile.classList.remove("open");
        } else {
            menuMobile.classList.add("open");
        }
    })
}