import axios from "axios";
import _ from "lodash";

function fetchVehicleViews() {
    axios.get("/dashboard/vehicleViews").then(function (response) {
        generateVehicleViewsChart(response.data.vehicles);
    })
        .catch(function (error) {
            console.log(error);
        })
}

function generateVehicleViewsChart(data) {
    const vehicleNames = _.map(data, (vehicle) => {
        return vehicle["vehicle_name"];
    })

    const vehicleViews = _.map(data, (vehicle) => {
        return vehicle["vehicle_views"];
    })

    new Chart(document.getElementById("vehicleViewsChart"), {
        "type": "bar",
        "data": {
            "labels": vehicleNames,
            "datasets": [{
                "label": "Aantal x bekeken",
                "data": vehicleViews,
                "borderColor": "rgb(255, 99, 132)",
                "backgroundColor": "rgba(255, 99, 132, 0.2)"
            }]
        },
        "options": {
            "scales": {
                "yAxes": [{
                    "ticks": {
                        "beginAtZero": true
                    }
                }]
            }
        }
    });
}


if (document.body.classList.contains("page-dashboard-analytics")) {
    fetchVehicleViews();
}