function draw(obj) {
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    let arr = [];
    arr.push(['Task', 'Number of votes']);
    for (const key in obj) {
        arr.push([key, obj[key]]);
    }

    function drawChart() {
        var data = google.visualization.arrayToDataTable(arr);

        var options = {
            title: 'Results of voting',
            is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
}
