var $ = require("jquery");

$(document).ready(function() {
    getStats();
});

// la funzione fa una chiamata ajax all'url /getStats. manda come dato l'id dell'appartamento in questione. il controller ApiController risponderà con un json con due array con le visite e i messaggi divisi per mese di quell'appartamento.
function getStats() {
    var apartmentId = $("#stats").data("apartment-id"); // l'id lo prendo da data-id="" del id="stats" dove ho stampato l'id dell'appartamento senza mostrarlo all'utente che non gli interessa
    console.log(apartmentId);
    $.ajax({
        url: "../../api/statistiche",
        method: "GET",
        data: {
            apartmentId: apartmentId
        },
        success: function(data) {
            var numVisite = data["visite"];
            var numMessaggi = data["messaggi"];
            console.log(numVisite, numMessaggi);
            // le due funzioni stamperanno i grafici
            addVisitsChart(numVisite);
            addMessagesChart(numMessaggi);
        },
        error: function(err) {
            console.log(err);
        }
    });
}

function addVisitsChart(data) {
    // [12, 19, 3, 5, 2, 3, 7, 15, 23, 39, 2]

    // si utilizza la libreria charts per stampare il grafico. in questo caso è un grafico a colonne è possibile specificare delle opzioni tipo colore colonne, quante colonne, le label ecc
    var Chart = require("chart.js");
    var ctx = $("#myVisitChart");
    var myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ],
            datasets: [
                {
                    label: "# of Visits",
                    data: data,
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(255, 206, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(255, 159, 64, 0.2)",
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(255, 206, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(255, 159, 64, 0.2)"
                    ],
                    borderColor: [
                        "rgba(255, 99, 132, 1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(153, 102, 255, 1)",
                        "rgba(255, 159, 64, 1)",
                        "rgba(255, 99, 132, 1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(153, 102, 255, 1)",
                        "rgba(255, 159, 64, 1)"
                    ],
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                yAxes: [
                    {
                        ticks: {
                            beginAtZero: true
                        }
                    }
                ]
            }
        }
    });
}
function addMessagesChart(data) {
    // [12, 19, 3, 5, 2, 3, 7, 15, 23, 39, 2]

    // si utilizza la libreria charts per stampare il grafico. in questo caso è un grafico a colonne è possibile specificare delle opzioni tipo colore colonne, quante colonne, le label ecc
    var Chart = require("chart.js");
    var ctx = $("#myMessagesChart");
    var myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ],
            datasets: [
                {
                    label: "# of Visits",
                    data: data,
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(255, 206, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(255, 159, 64, 0.2)",
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(255, 206, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(255, 159, 64, 0.2)"
                    ],
                    borderColor: [
                        "rgba(255, 99, 132, 1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(153, 102, 255, 1)",
                        "rgba(255, 159, 64, 1)",
                        "rgba(255, 99, 132, 1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(153, 102, 255, 1)",
                        "rgba(255, 159, 64, 1)"
                    ],
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                yAxes: [
                    {
                        ticks: {
                            beginAtZero: true
                        }
                    }
                ]
            }
        }
    });
}
