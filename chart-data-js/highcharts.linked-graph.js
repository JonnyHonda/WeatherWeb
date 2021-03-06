


/**
 * Synchronize zooming through the setExtremes event handler.
 */
function syncExtremes(e) {
    var thisChart = this.chart;

    Highcharts.each(Highcharts.charts, function (chart) {
        if (chart !== thisChart) {
            if (chart.xAxis[0].setExtremes) { // It is null while updating
                chart.xAxis[0].setExtremes(e.min, e.max);
            }
        }
    });
}

$(document).ready(function () {
    /**
     * In order to synchronize tooltips and crosshairs, override the 
     * built-in events with handlers defined on the parent element.
     */
    $('#container').bind('mousemove touchmove', function (e) {
        var chart,
                point,
                i;

        for (i = 0; i < Highcharts.charts.length; i++) {
            chart = Highcharts.charts[i];
            e = chart.pointer.normalize(e); // Find coordinates within the chart
            point = chart.series[0].searchPoint(e, true); // Get the hovered point

            if (point) {
                point.onMouseOver(); // Show the hover marker
                chart.tooltip.refresh(point); // Show the tooltip
                chart.xAxis[0].drawCrosshair(e, point); // Show the crosshair
            }
        }
    });
    /**
     * Override the reset function, we don't need to hide the tooltips and crosshairs.
     */
    Highcharts.Pointer.prototype.reset = function () {
    };
    $.getJSON('tasks/data/cache-linked-graph-data.json', function (activity) {
        $.each(activity.datasets, function (i, dataset) {
            // Add X values
            dataset.data = Highcharts.map(dataset.data, function (val, i) {
                return [activity.xData[i], val];
            });
            $('<div class="chart">')
                    .appendTo('#container')
                    .highcharts({
                        chart: {
                            marginLeft: 40, // Keep all charts left aligned
                            spacingTop: 20,
                            spacingBottom: 20
                                    // zoomType: 'x',
                                    // pinchType: null // Disable zoom on touch devices
                        },
                        title: {
                            text: dataset.name,
                            align: 'left',
                            margin: 0,
                            x: 30
                        },
                        credits: {
                            enabled: false
                        },
                        legend: {
                            enabled: false
                        },
                        xAxis: {
                            crosshair: true,
                            events: {
                                setExtremes: syncExtremes
                            },
                            labels: {
                                formatter: function () {
                                    var months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
                                    var d = new Date(this.value);
                                    var mod = d.getDate() % 10;
                                    (mod === 1) ? ordinal = 'st' :
                                            (mod === 2) ? ordinal = 'nd' :
                                            (mod === 3) ? ordinal = 'rd' : ordinal = 'th';
                                    return d.getDate() + ordinal + " " + months[d.getMonth()] + '<br />' + d.getHours() + ":" + d.getMinutes();
                                }
                            }
                        },
                        yAxis: {
                            min: dataset.min,
                            max: dataset.max,
                            title: {
                                text: null
                            }
                        },
                        tooltip: {
                            positioner: function () {
                                return {
                                    x: this.chart.chartWidth - this.label.width, // right aligned
                                    y: -1 // align to title
                                };
                            },
                            borderWidth: 0,
                            backgroundColor: 'none',
                            pointFormat: '{point.y}',
                            headerFormat: '',
                            shadow: false,
                            style: {
                                fontSize: '18px'
                            },
                            valueDecimals: dataset.valueDecimals
                        },
                        series: [{
                                data: dataset.data,
                                name: dataset.name,
                                type: dataset.type,
                                color: Highcharts.getOptions().colors[i],
                                fillOpacity: 0.3,
                                tooltip: {
                                    valueSuffix: ' ' + dataset.unit
                                }
                            }]
                    });
        });
    });
});