
//var chart;
$(document).ready(function () {
    $.getJSON('tasks/data/cache-multi-line-graph.json', function (json) {
        chart = new Highcharts.StockChart({
            chart: {
                renderTo: 'garden-temperatures-multi-line-graph',
                type: 'spline',
                marginRight: 130,
                marginBottom: 80,
                zoomType: 'x'
            },
            title: {
            //    text: 'Garden Temperatures',
            //    x: -20 //center  
            },
            subtitle: {
            //    text: 'Various temperatures recorded in the garden.',
            //    x: -20
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
                borderWidth: 1
            },
            rangeSelector: {
                selected: 0
            },
            dateFormat: {
            },
            xAxis: {
                type: 'datetime',
                labels: {
                    rotation: -45
                }
            },
            yAxis: {
                title: {
                    text: "Temp in °C"
                },
                plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
            },
            //     tooltip: {
            //	 formatter: function () {
            //	 return Highcharts.dateFormat(this.series.name + "<br>%d/%m/%Y %H:%M <br>" + this.y 
//+"°C", this.x) ;
            //	}  
            //  },  
            legend: {
                enabled: true,
                itemDistance: 50
            },
            series: [{
                    name: 'Air Temp',
                    data: json.air_temp
                },
                {
                    name: 'Grass Temp',
                    data: json.grass_temp
                },
                {
                    name: 'Soil Temp at 10cm',
                    data: json.soil_temp_10
                },
                {
                    name: 'Soil Temp at 30cm',
                    data: json.soil_temp_30
                },
                {
                    name: 'Soil Temp at 1m',
                    data: json.soil_temp_100
                }
            ]
        });
    });
});
