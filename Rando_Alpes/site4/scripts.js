document.addEventListener('DOMContentLoaded', function () {
    // Temperature Chart
    const tempChartCtx = document.getElementById('temperature-chart').getContext('2d');
    new Chart(tempChartCtx, {
        type: 'line',
        data: {
            labels: ['2019', '2020', '2021', '2022'],
            datasets: [
                {
                    label: 'Temp Min',
                    data: [7.5, 8, 8.5, 9],
                    borderColor: 'blue',
                    fill: false
                },
                {
                    label: 'Temp Moyenne',
                    data: [10, 10.5, 11, 11.5],
                    borderColor: 'orange',
                    fill: false
                },
                {
                    label: 'Temp Max',
                    data: [12, 12.5, 13, 13.5],
                    borderColor: 'red',
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Températures'
            }
        }
    });

    // Precipitation Chart
    const precipChartCtx = document.getElementById('precipitation-chart').getContext('2d');
    new Chart(precipChartCtx, {
        type: 'pie',
        data: {
            labels: ['Pas de pluie', 'Pluie faible', 'Pluie modérée', 'Forte pluie'],
            datasets: [{
                data: [40, 30, 20, 10],
                backgroundColor: ['#2E8B57', '#66CDAA', '#FFD700', '#FF4500']
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Précipitations'
            }
        }
    });
});
