
//var chart;
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


    $.getJSON('tasks/data/cache-multi-line-graph.json', function (json) {
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
                    name: 'Air Temp',
                    data: json.air_temp
                },
                {
                    name: 'Grass Temp',
                    data: json.grass_temp
                },
                {
                    name: 'Soil Temp at 10cm',
                    data: json.soil_temp_10
                },
                {
                    name: 'Soil Temp at 30cm',
                    data: json.soil_temp_30
                },
                {
                    name: 'Soil Temp at 1m',
                    data: json.soil_temp_100
                }
            ]
        });
    });

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
                    }
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
                    valueSuffix: '°C'
                },
                {
                    name: 'MSLP',
                    data: json.mslp,
                    type: 'spline',
                    valueSuffix: ' mb'
                }]
        });
    });
});

