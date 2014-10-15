//Flot Multiple Axes Line Chart
var oilprices;
$(function() {
    //var oilprices = $.getJSON("cache-line-graph.json"); 
    $.getJSON("cache-line-graph.json", function (jsonData) {
        temperatureData = jsonData;
        doPlot("right");
    });
    function euroFormatter(v, axis) {
        return v.toFixed(axis.tickDecimals) + "Deg C";
    }

    function doPlot(position) {
        $.plot($("#flot-line-chart-multi"), [{
            data: temperatureData[1],
            label: "Air Temperature"
        },{
            data: temperatureData[2],
            label: "Grass Temperature"
        },{
            data: temperatureData[3],
            label: "Grass Temperature at 10cm"
        },{
            data: temperatureData[4],
            label: "Soil Temperature at 30cm"
        },{
            data: temperatureData[5],
            label: "Soil Temperature at 1m"
        }], {
            xaxes: [{
                mode: 'time'
            }],
            yaxes: [{
                min: 0
            }, {
                // align if we are to the right
                alignTicksWithAxis: position == "right" ? 1 : null,
                position: position,
               // tickFormatter: euroFormatter
            }],
            legend: {
                position: 'sw'
            },
            grid: {
                hoverable: true //IMPORTANT! this is needed for tooltip to work
            },
            tooltip: true,
            tooltipOpts: {
                content: "%s for %x was %y",
                xDateFormat: "%0d-%0m-%y %0H:%0M",

                onHover: function(flotItem, $tooltipEl) {
                    // console.log(flotItem, $tooltipEl);
                }
            }

        });
    }

    //doPlot("right");

    $("button").click(function() {
        doPlot($(this).text());
    });
});
