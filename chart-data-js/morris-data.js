$(function () {
    $.getJSON("tasks/data/barGraphData.json", function (jsonData) {
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
