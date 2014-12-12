<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Home Weather Station - <?php include('version.txt'); ?></title>
        <!-- jQuery Version 1.11.0 -->
        <script src="js/jquery-1.11.0.js"></script>        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>



        <!-- Highcharts Javascripts -->
        <script src="highcharts/js/highstock.js"></script>
        <script src="highcharts/js/highcharts-more.js"></script>
        <script src="highcharts/js/modules/data.js"></script>
        <script src="highcharts/js/modules/exporting.js"></script>

        <!-- Chart Data scripts -->
        <script src="chart-data-js/highcharts.daily-average-temeratures-for-week.js"></script>
        <script src="chart-data-js/highcharts.multi-line-graph.js"></script>
        <script src="chart-data-js/highcharts.station-mslp-airtemp.js"></script>
        <script src="chart-data-js/highcharts.windrosedata.js"></script>
    </head>

    <body>
        <div class="row">


            <div class="col-md-3">
                <?php include("tasks/data/cache-table-data.inc.html"); ?>
            </div>

            <div class="col-md-7">
                <h3>Daily average temperatures for the week</h3> 
                <div id="morris-bar-chart"></div>
            </div>


        </div>

        <div class="row">
            <div class="col-md-2">
                <?php include("tasks/data/cache-zambretti-prediction.inc.html"); ?>
            </div>
            <div class="col-lg-4">            
                <h3>Wind Speed Frequencies</h3>
                <div id="container"></div>
            </div>             

        </div>

        <div class="panel-heading">
            <h3>Air and soil temperatures</h3>
            <div class="" id="garden-temperatures-multi-line-graph"></div>
        </div>

        <div class="panel-heading">
            <h3>Mean Sea Level Pressure vs Station Air Temperature</h3>
            <div class="" id="station-mslp-airtemp"></div>
        </div>
    </body>

</html>