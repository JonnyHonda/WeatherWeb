$(document).ready(function () {
    $.getJSON('tasks/data/combined-soiltemps.json', function (json) {
        chart = new Highcharts.StockChart({
            chart: {
                renderTo: 'garden-temperatures-multi-line-graph',
                type: 'spline',
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
                valueSuffix: '°C'
            },
            rangeSelector: {
                buttons: [{
                        type: 'hour',
                        count: 1,
                        text: '1h'
                    }, {
                        type: 'day',
                        count: 1,
                        text: '1D'
                    }, {
                        type: 'day',
                        count: 7,
                        text: '7d'
                    }, {
                        type: 'month',
                        count: 1,
                        text: '1m'
                    }, {
                        type: 'month',
                        count: 3,
                        text: '3m'
                    }, {
                        type: 'month',
                        count: 6,
                        text: '6m'
                    }, {
                        type: 'ytd',
                        text: 'YTD'
                    }, {
                        type: 'year',
                        count: 1,
                        text: '1y'
                    }, {
                        type: 'all',
                        count: 1,
                        text: 'All'
                    }],
                selected: 2,
                inputEnabled: true
            },
            dateFormat: {
            },
            xAxis: {
                type: 'datetime',
                labels: {
                    rotation: -45
                }
            },
            yAxis: {
                title: {
                    text: "Temp in °C"
                },
                plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
            },
            legend: {
                //enabled: true,
                itemDistance: 50
            },
            series: [{
//                    name: 'Local Grass Temp',
//                    data: json.local.grass_temp
//                },
                    //             {
                    //                 name: 'Remote Grass Temp',
                    //                 data: json.remote.grass_temp
                    //             },
//                {
                    name: 'Local Air Temp',
                    data: json.local.air_temp
                },
                {
                    name: 'Remote Air Temp',
                    data: json.remote.temp_out
                }, {
                    name: 'Local 10cm Soil Temp',
                    data: json.local.soil_temp_10
                },
                {
                    name: 'Remote 10cm Soil Temp',
                    data: json.remote.soil_temp_10
                },
                {
                    name: 'Local 30cm Soil Temp',
                    data: json.local.soil_temp_30
                },
                {
                    name: 'Remote 30cm Soil Temp',
                    data: json.remote.soil_temp_30
                },
                {
                    name: 'Local 100cm Soil Temp',
                    data: json.local.soil_temp_100
                },
                {
                    name: 'Remote 100cm Soil Temp',
                    data: json.remote.soil_temp_100
                }
            ]
        });

        for (x = 0; x < chart.series.length; x++) {
            chart.series[x].hide();
        }
    });
    $("#air_temp").change(function () {
        if (this.checked) {
            chart.series[0].show();
            chart.series[1].show();
        } else {
            chart.series[0].hide();
            chart.series[1].hide();
        }
    });

    $("#soil_temp_10").change(function () {
        if (this.checked) {
            chart.series[2].show();
            chart.series[3].show();
        } else {
            chart.series[2].hide();
            chart.series[3].hide();
        }
    });

    $("#soil_temp_30").change(function () {
        if (this.checked) {
            chart.series[4].show();
            chart.series[5].show();
        } else {
            chart.series[4].hide();
            chart.series[5].hide();
        }
    });

    $("#soil_temp_100").change(function () {
        if (this.checked) {
            chart.series[6].show();
            chart.series[7].show();
        } else {
            chart.series[6].hide();
            chart.series[7].hide();
        }
    });

    $('#air_temp').attr('checked', true);
});

