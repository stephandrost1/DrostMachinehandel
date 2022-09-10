const arrowDown = document.getElementById("homepage-arrow-down");

if (arrowDown) {
    arrowDown.addEventListener("click", function (event) {

        window.scrollTo({
            top: parseInt(window.innerHeight) - 50,
            behavior: "smooth"
        })
    });
}