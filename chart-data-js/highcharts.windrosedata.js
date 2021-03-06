$(document).ready(function () {
    $.getJSON('tasks/data/cache-freq-windrose-data.json', function (json) {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'station-windrose-frequency',
                polar: true,
                type: 'column'
            },
            title: {
                text: 'Wind Speed'
            },
            pane: {
                startAngle: 0,
                endAngle: 360,
                size: '85%'
            },
            legend: {
                align: 'right',
                verticalAlign: 'top',
                y: 100,
                layout: 'vertical',
                title: {
                    text: 'Wind speed m/s'
                }
            },
            credits:
                {
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
            tooltip: {
                valueSuffix: '%'
    
            },
            xAxis: {
                type: "",
                categories:['N', 'NNE', 'NE', 'ENE', 'E', 'ESE', 'SE', 'SSE', 'S', 'SSW','SW', 'WSW', 'W', 'WNW', 'NW', 'NNW'],
                labels: {
                    formatter: function () {
                        return this.value + '';
                    }
                },
                tickmarkPlacement: 'on'
            },
            yAxis: {
                min: 0,
                endOnTick: false,
                showLastLabel: true,
                title: {
                    text: 'Average (m/s)'
                },
                labels: {
                    formatter: function () {
                        return this.value + '%';
                    }
                },
                reversedStacks: false
            },
            plotOptions: {
                series: {
                    stacking: 'normal',
                    shadow: false,
                    groupPadding: 0,
                    pointPlacement: 'on'
                }
            },
            series: json.frequency
        });
    });
});