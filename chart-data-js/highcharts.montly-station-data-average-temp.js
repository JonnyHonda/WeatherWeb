$(document).ready(function () {
    $.getJSON('tasks/data/cache-monthly-station-data-average-temp.json', function (json) {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'monthly-averages',
                type: 'spline',
                marginRight: 130,
                marginBottom: 80,
                zoomType: 'x'
            },
            title: {
                text: json.title + ' Temperatures'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: null
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true,
                valueSuffix: '°C'
            },
            rangeSelector: {
                buttons: [ {
                        type: 'day',
                        count: 7,
                        text: '7d'
                    },  {
                        type: 'all',
                        count: 1,
                        text: 'All'
                    }],
                selected: 3,
                inputEnabled: true
            },
            legend: {
            },
            credits:
                    {
                        text: 'Last update: ' + json.updated,
                        position: {
                            align: 'left',
                            y: -5,
                            x: 5
                        },
                        style: {
                            fontSize: '8pt'
                        }
                    },
            series: [{
                    name: 'Temperature',
                    data: json.averages,
                    zIndex: 1,
                    marker: {
                        fillColor: 'white',
                        lineWidth: 2,
                        lineColor: Highcharts.getOptions().colors[0]
                    }
                }, {
                    name: 'Range',
                    data: json.ranges,
                    type: 'arearange',
                    lineWidth: 0,
                    linkedTo: ':previous',
                    color: Highcharts.getOptions().colors[0],
                    fillOpacity: 0.3,
                    zIndex: 0
                }]
        });

    });
});

