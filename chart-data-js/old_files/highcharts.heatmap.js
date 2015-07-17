$(document).ready(function () {
    $.getJSON('tasks/data/jb-heatmap.json', function (json) {
        chart = new Highcharts.Chart({
            chart: {
                type: 'heatmap',
                renderTo: 'heatmap',
            },
            title: {
                text: null
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.yAxis.categories[this.point.y] + ' </b> had a value of <br><b>' + this.point.value + '</b> on <b>' + this.series.xAxis.categories[this.point.x] + '</b>';
                },
                //backgroundColor: null,
                borderWidth: 1,
                borderColor: '#000000',
                distance: 10,
                shadow: false,
                useHTML: true,
                style: {
                    padding: 0,
                    color: 'black'
                }
            },
            xAxis: {
                //   categories: ['2013-04-01', '2013-04-02', '2013-04-03'],
                labels: {
                    rotation: 90
                }
            },
            yAxis: {
                title: {
                    text: null
                },
                labels: {
                    enabled: false
                },
                categories: ['Midnight', '1 am', '2 am', '3 am', '4 am', '5 am', '6 am', '7 am', '8 am', '9 am', '10 am', '11 am', 'Noon', '1 pm', '2 pm', '3 pm', '4 pm', '5 pm', '6 pm', '7 pm', '8 pm', '9 pm', '10 pm', '11 pm'],
                min: 0,
                max: 23,
                reversed: true
            },
            colorAxis: {
                stops: [
                    [0, '#3060cf'],
                [0.5, '#fffbbc'],
                [0.9, '#c4463a'],
                [1, '#c4463a']
                ],
                min: -10,
                max: 30,
                //minColor: '#FF0000',
                //maxColor: '#008000',
                startOnTick: false,
                endOnTick: false
            },
            series: [{
                    borderWidth: 0,
                    nullColor: '#EFEFEF',
                    data: json
                }]

        });
    });
    console.log("Got here");
});