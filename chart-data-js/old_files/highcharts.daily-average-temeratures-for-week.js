$(document).ready(function () {
    $.getJSON('tasks/data/cache-daily-average-temeratures-for-week-as-Json.json', function (json) {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'morris-bar-chart',
                type: 'column'
            },
            title: {
                text: '',
                //    x: -20 //center  
            },
            subtitle: {
                //    text: 'Various temperatures recorded in the garden.',
                //    x: -20
            },
            xAxis: {
                categories: [
                    'Monday',
                    'Tueday',
                    'Wednesday',
                    'Thusday',
                    'Friday',
                    'Saturday',
                    'Sunday'
                ]
            },
            yAxis: {
                title: {
                    text: "Temp in °C"
                }
            },
            plotOptions: {
                column: {
                    //   stacking: 'normal',
                    dataLabels: {
                        //  enabled: true,
                        //  color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            //      textShadow: '0 0 3px black, 0 0 3px black'
                        }
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true,
                valueSuffix: '°C'
            },
            series: [{
                    name: 'This Week',
                    data: json.this_week.average,
                    stack: 'this_week',
                    type: 'column'
                }, {
                    name: 'Last Week',
                    data: json.last_week.average,
                    stack: 'last_week',
                    type: 'column'
                }, {
                    name: 'Min Temp This Week',
                    data: json.this_week.min_temp,
                    type: 'spline'
                }, {
                    name: 'Min Temp Last Week',
                    data: json.last_week.min_temp,
                    type: 'spline'
                }, {
                    name: 'Max Temp This Week',
                    data: json.this_week.max_temp,
                    type: 'spline'
                }, {
                    name: 'Max Temp Last Week',
                    data: json.last_week.max_temp,
                    type: 'spline'
                }],
        });
    });
});
