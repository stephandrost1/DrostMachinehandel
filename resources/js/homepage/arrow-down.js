const arrowDown = document.getElementById("homepage-arrow-down");

if (arrowDown) {
    arrowDown.addEventListener("click", function (event) {
        var element = document.getElementById("check-our-vehicles");

        element.scrollIntoView({ behavior: "smooth" });
    });
}