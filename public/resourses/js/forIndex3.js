$(document).ready(async function () {
    let response = await fetch('/actions/get_user_analytics', {
        method: 'POST',
    });

    let result = await response.json();

    if (result?.data) {
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(function(){ drawColumnChart(result.data.ip_by_hour)});
        google.charts.setOnLoadCallback(function(){ drawPieChart(result.data.count_by_city)});
    }

    function drawPieChart(countByCity) {
        let dataToChart = [];
        countByCity.forEach(element => {
            dataToChart.push([element.city, element.count]);
        });
        var data = google.visualization.arrayToDataTable([
            ['City', 'Visit count'], ...dataToChart
        ]);
        var options = {
            title: 'Статистика посещений по городам'
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }

    function drawColumnChart(ipByHour) {
        let dataToChart = [];
        let countByHour = {};

        ipByHour.forEach(element => {
            countByHour[element.hour * 1] = element.count;
        });

        for ( let hour =0; hour<24; hour++){
            if (countByHour[hour] !== undefined) {
                dataToChart.push([hour, countByHour[hour], 'blue']);
            } else {
                dataToChart.push([hour, 0, 'blue']);
            }
        } 

        var data = google.visualization.arrayToDataTable([
            ["VisitCount", "Hour", { role: "style" }], ...dataToChart
        ]);

        var options = {
            title: "Посещаемость по часам",
            width: 800,
            height: 400,
            bar: { groupWidth: "95%" },
            legend: { position: "none" },

        };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart"));
        chart.draw(data, options);
    }
})