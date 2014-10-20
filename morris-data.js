$(function () {

/*
    $.getJSON("cache-line-graph.json", function (jsonData) {
        Morris.Area({
            element: 'morris-area-chart',
            data: jsonData,
            xkey: 'date',
            ykeys: ['soil_temp_10','soil_temp_30','soil_temp_100'],
            labels: ['10cm', '30cm','1m'],
            pointSize: 2,
            hideHover: 'always',
            behaveLikeLine: 'true',
 //           fillOpacity: 0.3,
            resize: true
        });
    });
*/
/*
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
                label: "Download Sales",
                value: 12
            }, {
                label: "In-Store Sales",
                value: 30
            }, {
                label: "Mail-Order Sales",
                value: 20
            }],
        resize: true
    });
*/
    $.getJSON("barGraphData.json", function (jsonData) {
        Morris.Bar({
            element: 'morris-bar-chart',
            data: jsonData,
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['This Week', 'Last Week'],
            hideHover: 'auto',
            resize: true
        });
    });
});
