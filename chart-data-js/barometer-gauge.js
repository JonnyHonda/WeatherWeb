$(document).ready(function () {
    $.getJSON('tasks/data/cache-live-readings.json', function (json) {
            var yAxisCategories = ['N', 'NNE', 'NE', 'ENE', 'E', 'ESE', 'SE', 'SSE', 'S', 'SSW','SW', 'WSW', 'W', 'WNW', 'NW', 'NNW']
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'barometer-gauge',
                type: 'gauge',
                plotBackgroundColor: null,
                plotBackgroundImage: null,
                plotBorderWidth: 0,
                plotShadow: false,
                thousandsSep: ''
            },
            title: {
                text: 'Barometer'
            },
            pane: {
                startAngle: -150,
                endAngle: 150,
                background: [{
                        backgroundColor: {
                            linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                            stops: [
                                [0, '#FFF'],
                                [1, '#333']
                            ]
                        },
                        borderWidth: 0,
                        outerRadius: '109%'
                    }, {
                        backgroundColor: {
                            linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                            stops: [
                                [0, '#333'],
                                [1, '#FFF']
                            ]
                        },
                        borderWidth: 1,
                        outerRadius: '107%'
                    }, {
                        // default background
                    }, {
                        backgroundColor: '#DDD',
                        borderWidth: 0,
                        outerRadius: '105%',
                        innerRadius: '103%'
                    }]
            },
            // the value axis
            yAxis: {
                min: 940,
                max: 1060,
                minorTickInterval: 'auto',
                minorTickWidth: 1,
                minorTickLength: 10,
                minorTickPosition: 'inside',
                minorTickColor: '#666',
                tickPixelInterval: 30,
                tickWidth: 2,
                tickPosition: 'inside',
                tickLength: 10,
                tickColor: '#666',
                labels: {
                    step: 2,
                    rotation: 'auto'
                },
                title: {
                    text: 'mb'
                }
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
                    name: 'Current',
                    // data: json.barom[0],
                      data: json.barom.current,
                //    dataLabels: false,

                    tooltip: {
                        valueSuffix: ' mb'
                    }
                }, {
                    name: 'Min',
                    data: json.barom.min,
                    dataLabels: false,
                    tooltip: {
                        valueSuffix: ' mb'
                    },
                    dial: {
                        backgroundColor: 'blue'
                    }
                }, {
                    name: 'Max',
                    data: json.barom.max,
                    dataLabels: false,
                    tooltip: {
                        valueSuffix: ' mb'
                    },
                    dial: {
                        backgroundColor: 'red'
                    }
                }

            ]
        });


        chart2 = new Highcharts.Chart({
            chart: {
                renderTo: 'air-temp-gauge',
                type: 'gauge',
                plotBackgroundColor: null,
                plotBackgroundImage: null,
                plotBorderWidth: 0,
                plotShadow: false
            },
            title: {
                text: 'Thermometer'
            },
            pane: {
                startAngle: -150,
                endAngle: 150,
                background: [{
                        backgroundColor: {
                            linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                            stops: [
                                [0, '#FFF'],
                                [1, '#333']
                            ]
                        },
                        borderWidth: 0,
                        outerRadius: '109%'
                    }, {
                        backgroundColor: {
                            linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                            stops: [
                                [0, '#333'],
                                [1, '#FFF']
                            ]
                        },
                        borderWidth: 1,
                        outerRadius: '107%'
                    }, {
                        // default background
                    }, {
                        backgroundColor: '#DDD',
                        borderWidth: 0,
                        outerRadius: '105%',
                        innerRadius: '103%'
                    }]
            },
            // the value axis
            yAxis: {
                min: -20,
                max: 30,
                minorTickInterval: 'auto',
                minorTickWidth: 1,
                minorTickLength: 10,
                minorTickPosition: 'inside',
                minorTickColor: '#666',
                tickPixelInterval: 30,
                tickWidth: 2,
                tickPosition: 'inside',
                tickLength: 10,
                tickColor: '#666',
                labels: {
                    step: 2,
                    rotation: 'auto'
                },
                title: {
                    text: '°C'
                }
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
                    name: 'Current',
                    // data: json.barom[0],
                    data: json.air_temp.current,
                    //     dataLabels: false,
                    tooltip: {
                        valueSuffix: '°C'
                    }
                }, {
                    name: 'Min',
                    data: json.air_temp.min,
                    dataLabels: false,
                    tooltip: {
                        valueSuffix: '°C'
                    },
                    dial: {
                        backgroundColor: 'blue'
                    }
                }, {
                    name: 'Max',
                    data: json.air_temp.max,
                    dataLabels: false,
                    tooltip: {
                        valueSuffix: '°C'
                    },
                    dial: {
                        backgroundColor: 'red'
                    }
                }

            ]
        });
        chart3 = new Highcharts.Chart({
            chart: {
                renderTo: 'wind-gauge',
                type: 'gauge',
                plotBackgroundColor: null,
                plotBackgroundImage: null,
                plotBorderWidth: 0,
                plotShadow: false
            },
            title: {
                text: 'Wind Speed'
            },
            pane: {
                startAngle: -150,
                endAngle: 150,
                background: [{
                        backgroundColor: {
                            linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                            stops: [
                                [0, '#FFF'],
                                [1, '#333']
                            ]
                        },
                        borderWidth: 0,
                        outerRadius: '109%'
                    }, {
                        backgroundColor: {
                            linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                            stops: [
                                [0, '#333'],
                                [1, '#FFF']
                            ]
                        },
                        borderWidth: 1,
                        outerRadius: '107%'
                    }, {
                        // default background
                    }, {
                        backgroundColor: '#DDD',
                        borderWidth: 0,
                        outerRadius: '105%',
                        innerRadius: '103%'
                    }]
            },
            // the value axis
            yAxis: {
                min: 0,
                max: 15,
                minorTickInterval: 'auto',
                minorTickWidth: 1,
                minorTickLength: 10,
                minorTickPosition: 'inside',
                minorTickColor: '#666',
                tickPixelInterval: 30,
                tickWidth: 2,
                tickPosition: 'inside',
                tickLength: 10,
                tickColor: '#666',
                labels: {
                    step: 2,
                    rotation: 'auto'
                },
                
                title: {
                    text: 'm/s'
                }
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
                    name: 'Current',
                    // data: json.barom[0],
                    data: json.wind.current,
                    //      dataLabels: false,
                    tooltip: {
                        valueSuffix: 'm/s'
                    }
                }, {
                    name: 'Max Speed',
                    data: json.wind.speed_max,
                    dataLabels: false,
                    tooltip: {
                        valueSuffix: 'm/s'
                    },
                    dial: {
                        backgroundColor: 'blue'
                    }
                }, {
                    name: 'Max Gust',
                    data: json.wind.gust_max,
                    dataLabels: false,
                    tooltip: {
                        valueSuffix: 'm/s'
                    },
                    dial: {
                        backgroundColor: 'red'
                    }
                }

            ]
        });
 chart4 = new Highcharts.Chart({

        chart: {
            renderTo: 'wind-direction-gauge',
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        
        title: {
            text: 'Compass'
        },
        
        pane: {
            startAngle: 0,
            endAngle: 360,
            background: [{
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#FFF'],
                        [1, '#333']
                    ]
                },
                borderWidth: 0,
                outerRadius: '109%'
            }, {
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#333'],
                        [1, '#FFF']
                    ]
                },
                borderWidth: 1,
                outerRadius: '107%'
            }, {
                // default background
            }, {
                backgroundColor: '#DDD',
                borderWidth: 0,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },
           
        // the value axis
        yAxis: {
            min: 0,
            max: 360,
            
            
    
            tickPixelInterval: 25,
            tickWidth: 1,
            tickPosition: 'outside',
            tickLength: 20,
            tickColor: '#999',
            
            labels: {
                dataLabels: false,
                step: 3,
                rotation: 'auto',
                 formatter: function () {return ""},
            },
            title: {
                text: 'Wind direction'
            },
            plotBands: [{
                label: {
                    text: 'East',
                    x: 322,
                    y: 115
                },
                from: 0,
                to: 90,
                color: '#55BF3B' // green
            }, {
                label: {
                    text: 'South',
                    x: 180,
                    y: 215
                },
                from: 90,
                to: 180,
                color: '#DDDF0D' // yellow
            }, {
                label: {
                    text: 'West',
                    x: 50,
                    y: 32
                },
                from: 180,
                to: 270,
                color: '#DF5353' // red
            },
                       {
                label: {
                    text: 'North',
                    x: 185,
                    y: -40
                },
                from: 270,
                to: 360,
                color: '#000000' // black
            }]        
        },
    
        series: [{
            name: 'Compass',
            data: json.wind.direction,
            tooltip: {
                valueSuffix: ' direction'
            }
        }]
    
    }
  );
    });
});
