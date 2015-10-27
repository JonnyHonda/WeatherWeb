$(document).ready(function () {
    $.getJSON('tasks/data/cache-wind-speed-data.json', function (json) {
        var yAxisCategories = ['N', 'NNE', 'NE', 'ENE', 'E', 'ESE', 'SE', 'SSE', 'S', 'SSW','SW', 'WSW', 'W', 'WNW', 'NW', 'NNW']
        chart = new Highcharts.StockChart({
            chart: {
                renderTo: 'station-wind-direction',
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
                formatter: function () {
                    /*
                    Overcomes a number of little problems with turning a number
                    into a direction. Rounds to nearest whole integer to
                    overcome graph zoom recalculations.
                    */
                    var xdate = new Date(this.x)
                    var options = {
                        weekday: 'long', year: 'numeric', month: 'short',
                        day: 'numeric', hour: 'numeric', minute: 'numeric'
                    };
                    var dateTimeFormat = new Intl.DateTimeFormat('en-GB', options).format(xdate);
                    var fixedpoint = this.y.toFixed(0);
                    return '<small>' + dateTimeFormat
                        + '</small><br/><span style="color:#F3C1FF">\u25CF</span>'
                        + ' Wind Direction: <b>' + yAxisCategories[fixedpoint]
                        + '</b><br/>';
                },
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
                selected: 1,
                inputEnabled: true
            },
            xAxis: {
                type: 'datetime',
                labels: {
                    rotation: -45
                }
            },
            yAxis: {
                title: {
                    text: "Bearing"
                },
                categories: yAxisCategories,
                min: 0,
                minorGridLineWidth: 0,
                gridLineWidth: 0,
                alternateGridColor: '#F3FBFF',
                minTickInterval: 1
            },
            legend: {
                enabled: true,
                itemDistance: 50
            },
            series: [
                {
                    name: 'Wind Direction',
                    data: json.idx,
                    color: '#F3C1FF',
                    step: true
                },
            ],
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
                }
        });
    });
});

