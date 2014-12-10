$(function () {

    // Parse the data from an inline table using the Highcharts Data plugin
    $('#container').highcharts( {
        data: {
            table: 'freq',
            startRow: 1,
            endRow: 17,
            endColumn: 7
        },

        chart: {
            polar: true,
            type: 'column'
        },

        title: {
            text: ''
        },

        subtitle: {
            text: ''
        },

        pane: {
            size: '85%'
        },

        legend: {
            align: 'right',
            verticalAlign: 'top',
            y: 100,
            layout: 'vertical'
        },

        xAxis: {
            tickmarkPlacement: 'on'
        },

        yAxis: {
            min: 0,
            endOnTick: false,
            showLastLabel: true,
            title: {
                text: ''
            },
            labels: {
                formatter: function () {
                    return this.value + '';
                }
            },
            reversedStacks: false
        },

        tooltip: {
            valueSuffix: '%'
        },

        plotOptions: {
            series: {
                stacking: 'normal',
                shadow: false,
                groupPadding: 0,
                pointPlacement: 'on'
            }
        }
    });
});