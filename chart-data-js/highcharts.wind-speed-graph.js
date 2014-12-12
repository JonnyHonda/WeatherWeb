$(document).ready(function () {
    $.getJSON('tasks/data/cache-wind-speed-data.json', function (json) {
        chart = new Highcharts.StockChart({
            chart: {
                renderTo: 'station-windspeed',
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
                valueSuffix: 'm/s'
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
                    text: "Wind Speed m/s"
                },
                min: 0,
                minorGridLineWidth: 0,
                gridLineWidth: 0,
                alternateGridColor: null,
                plotBands: [{ // Light air
                    from: 1,
                    to: 2,
                    color: '#F3FBFF',
                    label: {
                        text: 'Light air',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // Light breeze
                    from: 2,
                    to: 4,
                    color: '#FFFFFF',
                    label: {
                        text: 'Light breeze',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // Gentle breeze
                    from: 4,
                    to: 6,
                    color: '#F3FBFF',
                    label: {
                        text: 'Gentle breeze',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // Moderate breeze
                    from: 6,
                    to: 9,
                    color: '#FFFFFF',
                    label: {
                        text: 'Moderate breeze',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // Fresh breeze
                    from: 9,
                    to: 11,
                    color: '#F3FBFF',
                    label: {
                        text: 'Fresh breeze',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // Strong breeze
                    from: 11,
                    to: 14,
                    color: '#FFFFFF',
                    label: {
                        text: 'Strong breeze',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // High wind
                    from: 14,
                    to: 17,
                    color: '#F3FBFF',
                    label: {
                        text: 'Near gale',
                        style: {
                            color: '#606060'
                        }
                    }
                }]

            },
            legend: {
                enabled: true,
                itemDistance: 50
            },
            credits:
                    {
                        text: 'Last update: ' + json.updated ,
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
                    name: 'Wind Speed',
                    data: json.windspeed_ms
                },
                {
                    name: 'Gust Speed',
                    data: json.windgust_ms
                }
            ]
        });
    });
});

