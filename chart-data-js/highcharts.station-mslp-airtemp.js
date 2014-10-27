
//var chart;
$(document).ready(function () {
    $.getJSON('tasks/data/cache-station-mslp-airtemp.json', function (json) {
        chart = new Highcharts.StockChart({
            chart: {
                renderTo: 'station-mslp-airtemp',
                type: 'column',
                marginRight: 130,
                marginBottom: 80,
                zoomType: 'x'
            },
            title: {
                //    text: 'Garden Temperatures',
                //    x: -20 //center  
            },
            subtitle: {
                //    text: 'Various temperatures recorded in the garden.',
                //    x: -20
            },
            tooltip: {
                backgroundColor: {
                    linearGradient: {
                        x1: 0,
                        y1: 0,
                        x2: 0,
                        y2: 1
                    },
                    stops: [
                        [0, 'white'],
                        [1, '#EEE']
                    ]
                },
                borderColor: 'gray',
                borderWidth: 1,
            },
            rangeSelector: {
                selected: 0
            },
            dateFormat: {
            },
            xAxis: {
                type: 'datetime',
                labels: {
                    rotation: -45
                }
            },
            yAxis: [{
                    title: {
                        text: "MSLP"
                    },
                opposite: false
                }, {
                    title: {
                        text: "Air Temp"
                    }
                }],
            legend: {
                enabled: true,
                itemDistance: 50
            },
            series: [{
                    name: 'Air Temp',
                    data: json.air_temp,
                    yAxis: 1,
                    type: 'spline',
                    tooltip: {
                        valueSuffix: ' °C'
                    }
                },
                {
                    name: 'MSLP',
                    data: json.mslp,
                    type: 'spline',
                    tooltip: {
                        valueSuffix: ' mb'
                    }
                }]
        });
    });
});

