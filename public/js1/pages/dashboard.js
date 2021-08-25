document.addEventListener("DOMContentLoaded", function () {
    // Bar chart
    new Chart(document.getElementById("chartjs-dashboard-bar"), {
        type: "bar",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Last year",
                backgroundColor: window.theme.primary,
                borderColor: window.theme.primary,
                hoverBackgroundColor: window.theme.primary,
                hoverBorderColor: window.theme.primary,
                data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                barPercentage: .325,
                categoryPercentage: .5
            }, {
                label: "This year",
                backgroundColor: window.theme["primary-light"],
                borderColor: window.theme["primary-light"],
                hoverBackgroundColor: window.theme["primary-light"],
                hoverBorderColor: window.theme["primary-light"],
                data: [69, 66, 24, 48, 52, 51, 44, 53, 62, 79, 51, 68],
                barPercentage: .325,
                categoryPercentage: .5
            }]
        },
        options: {
            maintainAspectRatio: false,
            cornerRadius: 15,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false
                    },
                    stacked: false,
                    ticks: {
                        stepSize: 20
                    },
                    stacked: true,
                }],
                xAxes: [{
                    stacked: false,
                    gridLines: {
                        color: "transparent"
                    },
                    stacked: true,
                }]
            }
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    $("#datetimepicker-dashboard").datetimepicker({
        inline: true,
        sideBySide: false,
        format: "L"
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Pie chart
    new Chart(document.getElementById("chartjs-dashboard-pie"), {
        type: "pie",
        data: {
            labels: ["Direct", "Affiliate", "E-mail", "Other"],
            datasets: [{
                data: [2602, 1253, 541, 1465],
                backgroundColor: [
                    window.theme.primary,
                    window.theme.warning,
                    window.theme.danger,
                    "#E8EAED"
                ],
                borderWidth: 5,
                borderColor: window.theme.white
            }]
        },
        options: {
            responsive: !window.MSInputMethodContext,
            maintainAspectRatio: false,
            cutoutPercentage: 70,
            legend: {
                display: false
            }
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    $("#datatables-dashboard-projects").DataTable({
        pageLength: 6,
        lengthChange: false,
        bFilter: false,
        autoWidth: false
    });
});