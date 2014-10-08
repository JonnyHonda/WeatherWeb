$(function () {


    $.getJSON("lineGraphData.json", function (jsonData) {
        Morris.Area({
            element: 'morris-area-chart',
            data: jsonData,
            xkey: 'period',
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['iPhone', 'iPad', 'iPod Touch'],
            pointSize: 2,
            hideHover: 'auto',
            resize: true
        });
    });


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
