            function Meteogram(json, container) {
                // Parallel arrays for the chart data, these are populated as the json/JSON file
                // is loaded
                this.symbols = [];
                this.symbolNames = [];
                this.precipitations = [];
                this.windDirections = [];
                this.windDirectionNames = [];
                this.windSpeeds = [];
                this.windSpeedNames = [];
                this.temperatures = [];
                this.pressures = [];

                // Initialize
                this.json = json;
                this.container = container;

                // Run
                this.parseYrData();
            }

            /**
             * Function to smooth the temperature line. The original data provides only whole degrees,
             * which makes the line graph look jagged. So we apply a running mean on it, but preserve
             * the unaltered value in the tooltip.
             */
            Meteogram.prototype.smoothLine = function (data) {
                var i = data.length,
                        sum,
                        value;

                while (i--) {
                    data[i].value = value = data[i].y; // preserve value for tooltip

                    // Set the smoothed value to the average of the closest points, but don't allow
                    // it to differ more than 0.5 degrees from the given value
                    sum = (data[i - 1] || data[i]).y + value + (data[i + 1] || data[i]).y;
                    data[i].y = Math.max(value - 0.5, Math.min(sum / 3, value + 0.5));
                }
            };

            /**
             * Callback function that is called from Highcharts on hovering each point and returns
             * HTML for the tooltip.
             */
            Meteogram.prototype.tooltipFormatter = function (tooltip) {

                // Create the header with reference to the time interval
                var index = tooltip.points[0].point.index,
                        ret = '<small>' + Highcharts.dateFormat('%A, %b %e, %H:%M', tooltip.x) + '-' +
                        Highcharts.dateFormat('%H:%M', tooltip.points[0].point.to) + '</small><br>';

                // Symbol text
                // ret += '<b>' + this.symbolNames[index] + '</b>';

                ret += '<table>';

                // Add all series
                Highcharts.each(tooltip.points, function (point) {
                    var series = point.series;
                    ret += '<tr><td><span style="color:' + series.color + '">\u25CF</span> ' + series.name +
                            ': </td><td style="white-space:nowrap">' + Highcharts.pick(point.point.value, point.y) +
                            series.options.tooltip.valueSuffix + '</td></tr>';
                });

                // Add wind
                ret += '<tr><td style="vertical-align: top">\u25CF Wind</td><td style="white-space:nowrap">' + this.windDirectionNames[index] +
                        '<br>' + this.windSpeedNames[index] + ' (' +
                        Highcharts.numberFormat(this.windSpeeds[index], 1) + ' m/s)</td></tr>';

                // Close
                ret += '</table>';


                return ret;
            };

            /**
             * Create wind speed symbols for the Beaufort wind scale. The symbols are rotated
             * around the zero centerpoint.
             */
            Meteogram.prototype.windArrow = function (name) {
                var level,
                        path;

                // The stem and the arrow head
                path = [
                    'M', 0, 7, // base of arrow
                    'L', -1.5, 7,
                    0, 10,
                    1.5, 7,
                    0, 7,
                    0, -10 // top
                ];

                level = $.inArray(name, ['Calm', 'Light air', 'Light breeze', 'Gentle breeze', 'Moderate breeze',
                    'Fresh breeze', 'Strong breeze', 'Near gale', 'Gale', 'Strong gale', 'Storm',
                    'Violent storm', 'Hurricane']);

                if (level === 0) {
                    path = [];
                }

                if (level === 2) {
                    path.push('M', 0, -8, 'L', 4, -8); // short line
                } else if (level >= 3) {
                    path.push(0, -10, 7, -10); // long line
                }

                if (level === 4) {
                    path.push('M', 0, -7, 'L', 4, -7);
                } else if (level >= 5) {
                    path.push('M', 0, -7, 'L', 7, -7);
                }

                if (level === 5) {
                    path.push('M', 0, -4, 'L', 4, -4);
                } else if (level >= 6) {
                    path.push('M', 0, -4, 'L', 7, -4);
                }

                if (level === 7) {
                    path.push('M', 0, -1, 'L', 4, -1);
                } else if (level >= 8) {
                    path.push('M', 0, -1, 'L', 7, -1);
                }

                return path;
            };

            /**
             * Draw the wind arrows. Each arrow path is generated by the windArrow function above.
             */
            Meteogram.prototype.drawWindArrows = function (chart) {
                var meteogram = this;

                $.each(chart.series[0].data, function (i, point) {
                    var sprite, arrow, x, y;

                    if (meteogram.resolution > 36e5 || i % 2 === 0) {

                        // Draw the wind arrows
                        x = point.plotX + chart.plotLeft + 7;
                        y = 255;
                        if (meteogram.windSpeedNames[i] === 'Calm') {
                            arrow = chart.renderer.circle(x, y, 10).attr({
                                fill: 'none'
                            });
                        } else {
                            arrow = chart.renderer.path(
                                    meteogram.windArrow(meteogram.windSpeedNames[i])
                                    ).attr({
                                rotation: parseInt(meteogram.windDirections[i], 10),
                                translateX: x, // rotation center
                                translateY: y // rotation center
                            });
                        }
                        arrow.attr({
                            stroke: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                            'stroke-width': 1.5,
                            zIndex: 5
                        })
                                .add();

                    }
                });
            };

            /**
             * Draw blocks around wind arrows, below the plot area
             */
            Meteogram.prototype.drawBlocksForWindArrows = function (chart) {
                var xAxis = chart.xAxis[0],
                        x,
                        pos,
                        max,
                        isLong,
                        isLast,
                        i;

                for (pos = xAxis.min, max = xAxis.max, i = 0; pos <= max + 36e5; pos += 36e5, i += 1) {

                    // Get the X position
                    isLast = pos === max + 36e5;
                    x = Math.round(xAxis.toPixels(pos)) + (isLast ? 0.5 : -0.5);

                    // Draw the vertical dividers and ticks
                    if (this.resolution > 36e5) {
                        isLong = pos % this.resolution === 0;
                    } else {
                        isLong = i % 2 === 0;
                    }
                    chart.renderer.path(['M', x, chart.plotTop + chart.plotHeight + (isLong ? 0 : 28),
                        'L', x, chart.plotTop + chart.plotHeight + 32, 'Z'])
                            .attr({
                                'stroke': chart.options.chart.plotBorderColor,
                                'stroke-width': 1
                            })
                            .add();
                }
            };

            /**
             * Build and return the Highcharts options structure
             */
            Meteogram.prototype.getChartOptions = function () {
                var meteogram = this;
                return {
                    chart: {
                        renderTo: this.container,
                        marginBottom: 80,
                        marginRight: 64,
                        marginTop: 50,
                        plotBorderWidth: 1,
                        width: 1000,
                        height: 320,
                        alignTicks: false,
                    },
                    title: {
                        text: '',
                        align: 'left'
                    },
                    credits: {
                        text: 'Updated: ' + this.json.meta.datemark,
                        position: {
                            align: 'left',
                            y: -5,
                            x: 5
                        },
                        style: {
                            fontSize: '8pt'
                        }
                    },
                    tooltip: {
                        shared: true,
                        useHTML: true,
                        formatter: function () {
                            return meteogram.tooltipFormatter(this);
                        }
                    },
                    xAxis: [{// Bottom X axis
                        type: 'datetime',
                        tickInterval: 2 * 36e5, // two hours
                        minorTickInterval: 36e5, // one hour
                        tickLength: 10,
                        gridLineWidth: 1,
                        gridLineColor: (Highcharts.theme && Highcharts.theme.background2) || '#F0F0F0',
                        startOnTick: false,
                        endOnTick: false,
                        minPadding: 0,
                        maxPadding: 0,
                        offset: 30,
                        showLastLabel: true,
                        labels: {
                            format: '{value:%H}'
                        }
                    }, {// Top X axis
                        linkedTo: 0,
                        type: 'datetime',
                        tickInterval: 24 * 3600 * 1000,
                        labels: {
                            format: '{value:<span style="font-size: 12px; font-weight: bold">%a</span> %b %e}',
                            align: 'left',
                            x: 3,
                            y: -5
                        },
                        opposite: true,
                        tickLength: 20,
                        gridLineWidth: 1
                    }],
                    yAxis: [{// temperature axis
                        title: {
                            text: "Temperature °C"
                        },
                        labels: {
                            style: {
                                color: '#00A3CC',
                            },
                        },
                        plotLines: [{// zero plane
                            value: 0,
                            color: '#BBBBBB',
                            width: 1,
                            zIndex: 2
                        }],
                        // Custom positioner to provide even temperature ticks from top down
                        tickPositioner: function () {
                            var max = Math.ceil(this.max) + 1,
                                    pos = max - 12, // start
                                    ret;
                            if (pos < this.min) {
                                ret = [];
                                while (pos <= max) {
                                    ret.push(pos += 1);
                                }
                            } // else return undefined and go auto
                            return ret;
                        },
                        maxPadding: 0.3,
                        tickInterval: 1,
                        gridLineColor: (Highcharts.theme && Highcharts.theme.background2) || '#F0F0F0'
                    }, {// precipitation axis
                        title: {
                            text: null
                        },
                        labels: {
                            enabled: false
                        },
                        gridLineWidth: 0,
                        tickLength: 0
                    }, {// Air pressure
                        allowDecimals: false,
                        title: {
                            text: "Pressure mb"
                        },
                        labels: {
                            style: {
                                color: '#398E56',
                            },
                            y: 2,
                            x: 3
                        },
                        gridLineWidth: 0,
                        opposite: true,
                    }],
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            pointPlacement: 'between'
                        }
                    },
                    series: [{
                        name: 'Temperature',
                        data: this.temperatures,
                        type: 'spline',
                        marker: {
                            enabled: false,
                            states: {
                                hover: {
                                    enabled: true
                                }
                            }
                        },
                        tooltip: {
                            valueSuffix: '°C'
                        },
                        zIndex: 1,
                        color: '#00A3CC',
                        //negativeColor: '#48AFE8'
                    }, {
                        name: 'Precipitation',
                        data: this.precipitations,
                        type: 'column',
                        color: '#68CFE8',
                        yAxis: 1,
                        groupPadding: 0,
                        pointPadding: 0,
                        borderWidth: 0,
                        shadow: false,
                        dataLabels: {
                            enabled: true,
                            formatter: function () {
                                if (this.y > 0) {
                                    return this.y;
                                }
                            },
                            style: {
                                fontSize: '8px'
                            }
                        },
                        tooltip: {
                            valueSuffix: 'mm'
                        }
                    }, {
                        name: 'Air pressure',
                        data: this.pressures,
                        color: '#398E56',
                        marker: {
                            enabled: false
                        },
                        shadow: false,
                        tooltip: {
                            valueSuffix: ' mb'
                        },
                        dashStyle: 'shortdot',
                        yAxis: 2
                    }]
                }
            };

            /**
             * Post-process the chart from the callback function, the second argument to Highcharts.Chart.
             */
            Meteogram.prototype.onChartLoad = function (chart) {
                this.drawWindArrows(chart);
                this.drawBlocksForWindArrows(chart);
            };

            /**
             * Create the chart. This function is called async when the data file is loaded and parsed.
             */
            Meteogram.prototype.createChart = function () {
                var meteogram = this;
                this.chart = new Highcharts.Chart(this.getChartOptions(), function (chart) {
                    meteogram.onChartLoad(chart);
                });
            };

            /**
             * Handle the data. This part of the code is not Highcharts specific, but deals with yr.no's
             * specific data format
             */
            Meteogram.prototype.parseYrData = function () {

                var meteogram = this,
                        json = this.json,
                        pointStart;

                if (!json || !json.forecast) {
                    $('#loading').html('<i class="fa fa-frown-o"></i> Failed loading data, please try again later');
                    return;
                }

                // The returned json variable is a JavaScript representation of the provided json,
                // generated on the server by running PHP simple_load_json and converting it to
                // JavaScript by json_encode.
                $.each(json.forecast.tabular.time, function (i, time) {
                    // Get the times - only Safari can't parse ISO8601 so we need to do some replacements
                    var from = time['@attributes'].from + ' UTC',
                            to = time['@attributes'].to + ' UTC';

                    from = from.replace(/-/g, '/').replace('T', ' ');
                    from = Date.parse(from);
                    to = to.replace(/-/g, '/').replace('T', ' ');
                    to = Date.parse(to);

                    if (to > pointStart + 4 * 24 * 36e5) {
                        return;
                    }

                    // If it is more than an hour between points, show all symbols
                    if (i === 0) {
                        meteogram.resolution = to - from;
                    }

                    meteogram.temperatures.push({
                        x: from,
                        y: parseFloat(time.temperature['@attributes'].value),
                        // custom options used in the tooltip formatter
                        to: to,
                        index: i
                    });

                    meteogram.precipitations.push({
                        x: from,
                        y: parseFloat(time.precipitation['@attributes'].value)
                    });
                    meteogram.windDirections.push(parseFloat(time.windDirection['@attributes'].deg));
                    meteogram.windDirectionNames.push(time.windDirection['@attributes'].name);
                    meteogram.windSpeeds.push(parseFloat(time.windSpeed['@attributes'].mps));
                    meteogram.windSpeedNames.push(time.windSpeed['@attributes'].name);
                    meteogram.pressures.push({
                        x: from,
                        y: parseFloat(time.pressure['@attributes'].value)
                    });

                    if (i == 0) {
                        pointStart = (from + to) / 2;
                    }
                });

                // Smooth the line
                this.smoothLine(this.temperatures);
                // Create the chart when the data is loaded
                this.createChart();
            };
            // End of the Meteogram protype



            $(function () { // On DOM ready...

                $.getJSON(
                        'tasks/data/cache-meteogram.json',
                        function (json) {
                            var meteogram = new Meteogram(json, 'meteograph');
                        }
                );

            });
