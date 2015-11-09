$(document).ready(function() {
    $.getJSON('/tasks/data/cache-wind-speed-data.json', function(json) {
        var extremes = chart.yAxis[0].getExtremes();
        var maxY = extremes.max;
        var minY = extremes.min;
        chart = new Highcharts.StockChart({
            chart: {
                renderTo: 'station-wind-speed',
                type: 'spline',
                marginRight: 130,
                marginBottom: 80,
                zoomType: 'x'
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
                valueSuffix: ' m/s'
            },
            rangeSelector: {
                selected: 0,
                buttons: [{
                    type: 'day',
                    count: 1,
                    text: '1d'
                }, {
                    type: 'week',
                    count: 1,
                    text: '1w'
                }, {
                    type: 'month',
                    count: 1,
                    text: '1m'
                }, {
                    type: 'month',
                    count: 3,
                    text: '3m'
                }]
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
                plotBands: [{ // BFT 0 - Calm - 0 to 1
                    from: 0,
                    to: 1,
                    color: '#FFFFFF',
                    label: {
                        text: 'Calm (Bft 0)',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // BFT 1 - Light air - 1 to 3
                    from: 1,
                    to: 3,
                    color: '#F3FBFF',
                    label: {
                        text: 'Light air (Bft 1)',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // BFT 2 - Light breeze - 3 to 5
                    from: 3,
                    to: 5,
                    color: '#FFFFFF',
                    label: {
                        text: 'Light breeze (Bft 2)',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // BFT 3 - Gentle breeze - 5 to 7
                    from: 5,
                    to: 7,
                    color: '#F3FBFF',
                    label: {
                        text: 'Gentle breeze (Bft 3)',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // BFT 4 - Moderate breeze - 7 to 10
                    from: 7,
                    to: 10,
                    color: '#FFFFFF',
                    label: {
                        text: 'Moderate breeze (Bft 4)',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // BFT 5 - Fresh breeze - 10 to 12
                    from: 10,
                    to: 12,
                    color: '#F3FBFF',
                    label: {
                        text: 'Fresh breeze (Bft 5)',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // BFT 6 - Strong breeze - 12 to 15
                    from: 12,
                    to: 15,
                    color: '#FFFFFF',
                    label: {
                        text: 'Strong breeze (Bft 6)',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // BFT 7 - Near Gale - 15 to 19
                    from: 15,
                    to: 19,
                    color: '#F3FBFF',
                    label: {
                        text: 'Near gale (Bft 7)',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // BFT 8 - Gale - 19 to 23
                    from: 19,
                    to: 23,
                    color: '#FFFFFF',
                    label: {
                        text: 'Gale (Bft 8)',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // BFT 9 - Strong gale - 23 to 27
                    from: 23,
                    to: 27,
                    color: '#F3FBFF',
                    label: {
                        text: 'Strong gale (Bft 9)',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // BFT 10 - Storm - 27 to 31
                    from: 27,
                    to: 31,
                    color: '#FFFFFF',
                    label: {
                        text: 'Storm (Bft 10)',
                        style: {
                            color: '#606060'
                        }
                    }
                }, { // BFT 11 - Violent Storm - 31 +
                    from: 31,
                    to: maxY,
                    color: '#FFFFFF',
                    label: {
                        text: 'Violent Storm (Bft 11)',
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
            series: [{
                name: 'Gust Wind Speed',
                data: json.windgust_ms,
                color: '#33ADD6'
            }, {
                name: 'Average Wind Speed',
                data: json.windspeed_ms,
                color: '#4AB825',
            }],
            credits: {
                text: 'Updated: ' + json.updated,
                position: {
                    align: 'left',
                    y: -5,
                    x: 5
                },
                style: {
                    fontSize: '8pt'
                }
            },
        });
    });
});

