
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
            rangeSelector : {
                buttons : [{
                    type : 'hour',
                    count : 1,
                    text : '1h'
                }, {
                    type : 'day',
                    count : 1,
                    text : '1D'
                },{
                    type : 'day',
                    count : 7,
                    text : '7d'
                },{
                    type : 'month',
                    count : 1,
                    text : '1m'
                },{
                    type : 'month',
                    count : 3,
                    text : '3m'
                },{
                    type : 'month',
                    count : 6,
                    text : '6m'
                },{
                    type : 'ytd',
                    text : 'YTD'
                },{
                    type : 'year',
                    count : 1,
                    text : '1y'
                },{
                    type : 'all',
                    count : 1,
                    text : 'All'
                }],
                selected : 2,
                inputEnabled : true
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

