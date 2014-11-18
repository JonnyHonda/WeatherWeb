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
                enabled: true,
                itemDistance: 50
            },
            series: [{
                    name: 'Local Airl Temp',
                    data: json.local.air_temp
                },
                {
                    name: 'Remote Air Temp',
                    data: json.remote.temp_out
                },{
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
    });
});

