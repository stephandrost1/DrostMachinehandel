if (document.querySelector(".page-verhuurDetail")) {
    const rent = document.querySelector(".reserve-button");

    rent.addEventListener("click", () => {
        document.querySelector("#reservation-popup-rent-detail").classList.remove("hidden");
    })
}