const hamburger = document.querySelector(".hamburger-icon-wrapper");
const menuMobile = document.querySelector("#navbar-expanded-mobile");

if (hamburger && menuMobile) {
    hamburger.addEventListener("click", function () {
        if (menuMobile.classList.contains("open")) {
            menuMobile.classList.remove("open");
            hamburger.classList.remove("open");
            document.body.style.overflow = 'auto';
        } else {
            document.body.style.overflow = 'hidden';
            menuMobile.classList.add("open");
            hamburger.classList.add("open");
        }
    })
}