<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Home Weather Station</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="css/plugins/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="css/plugins/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!--script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script-->
      
        <!-- jQuery Version 1.11.0 -->
        <script src="js/jquery-1.11.0.js"></script>
        <script src="/highcharts/js/highstock.js"></script>
        <!--script src="http://code.highcharts.com/highcharts.js"></script-->
        <script src="http://code.highcharts.com/highcharts-more.js"></script>
        <script src="http://code.highcharts.com/modules/data.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
        <script src="highchartsdata.js"></script>
        <script src="windrosedata.js"></script>
    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Home Weather Station</a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <a href="#">
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>Read All Messages</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-messages -->
                    </li>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-tasks">
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 1</strong>
                                            <span class="pull-right text-muted">40% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                <span class="sr-only">40% Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 2</strong>
                                            <span class="pull-right text-muted">20% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 3</strong>
                                            <span class="pull-right text-muted">60% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                <span class="sr-only">60% Complete (warning)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 4</strong>
                                            <span class="pull-right text-muted">80% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                <span class="sr-only">80% Complete (danger)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>See All Tasks</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-tasks -->
                    </li>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-comment fa-fw"></i> New Comment
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> Message Sent
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-tasks fa-fw"></i> New Task
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-alerts -->
                    </li>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a class="active" href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">26</div>
                                        <div>New Comments!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">12</div>
                                        <div>New Tasks!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">124</div>
                                        <div>New Orders!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">13</div>
                                        <div>Support Tickets!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-8">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-bar-chart-o fa-fw"></i> Recent readings
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                            Actions
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li><a href="#">Action</a>
                                            </li>
                                            <li><a href="#">Another action</a>
                                            </li>
                                            <li><a href="#">Something else here</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th colspan="4">Today's Temperatures</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Grass</th>
                                                        <th>Air</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php include("tableData.inc.html"); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.col-lg-4 (nested) -->
                                    <div class="col-lg-8">Daily average temperatures for the week 
                                        <div id="morris-bar-chart"></div>
                                    </div>
                                    <!-- /.col-lg-8 (nested) -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-bar-chart-o fa-fw"></i> Air and soil temperatures
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                            Actions
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li><a href="#">Action</a>
                                            </li>
                                            <li><a href="#">Another action</a>
                                            </li>
                                            <li><a href="#">Something else here</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="garden-temperatures-multi-line-graph"></div>
                                </div>
                                <!-- div id="morris-area-chart"></div -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-8 -->
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <?php include("cache-zambretti-prediction.inc.html"); ?>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-bar-chart-o fa-fw"></i> Donut Chart Example
                            </div>
                            <div class="panel-body">
                                <div id="container"></div>
                                <a href="#" class="btn btn-default btn-block">View Details</a>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="table-responsive">
                                        <table id="freq" class="table table-bordered table-hover table-striped">

                                            <tr nowrap>
                                                <th colspan="9" class="hdr">Table of Frequencies (percent)</th>
                                            </tr>
                                            <tr nowrap>
                                                <th>Direction</th>
                                                <th>&lt; 0.5 m/s</th>
                                                <th>0.5-2 m/s</th>
                                                <th>2-4 m/s</th>
                                                <th>4-6 m/s</th>
                                                <th>6-8 m/s</th>
                                                <th>8-10 m/s</th>
                                                <th>&gt; 10 m/s</th>
                                                <th>Total</th>
                                            </tr>
                                            <tr nowrap>
                                                <td class="dir">N</td>
                                                <td class="data">1.81</td>
                                                <td class="data">1.78</td>
                                                <td class="data">0.16</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">3.75</td>
                                            </tr>		
                                            <tr nowrap>
                                                <td class="dir">NNE</td>
                                                <td class="data">0.62</td>
                                                <td class="data">1.09</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">1.71</td>
                                            </tr>
                                            <tr nowrap>
                                                <td class="dir">NE</td>
                                                <td class="data">0.82</td>
                                                <td class="data">0.82</td>
                                                <td class="data">0.07</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">1.71</td>
                                            </tr>
                                            <tr nowrap>
                                                <td class="dir">ENE</td>
                                                <td class="data">0.59</td>
                                                <td class="data">1.22</td>
                                                <td class="data">0.07</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">1.88</td>
                                            </tr>
                                            <tr nowrap>
                                                <td class="dir">E</td>
                                                <td class="data">0.62</td>
                                                <td class="data">2.20</td>
                                                <td class="data">0.49</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">3.32</td>
                                            </tr>
                                            <tr nowrap>
                                                <td class="dir">ESE</td>
                                                <td class="data">1.22</td>
                                                <td class="data">2.01</td>
                                                <td class="data">1.55</td>
                                                <td class="data">0.30</td>
                                                <td class="data">0.13</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">5.20</td>
                                            </tr>
                                            <tr nowrap>
                                                <td class="dir">SE</td>
                                                <td class="data">1.61</td>
                                                <td class="data">3.06</td>
                                                <td class="data">2.37</td>
                                                <td class="data">2.14</td>
                                                <td class="data">1.74</td>
                                                <td class="data">0.39</td>
                                                <td class="data">0.13</td>
                                                <td class="data">11.45</td>
                                            </tr>
                                            <tr nowrap>
                                                <td class="dir">SSE</td>
                                                <td class="data">2.04</td>
                                                <td class="data">3.42</td>
                                                <td class="data">1.97</td>
                                                <td class="data">0.86</td>
                                                <td class="data">0.53</td>
                                                <td class="data">0.49</td>
                                                <td class="data">0.00</td>
                                                <td class="data">9.31</td>
                                            </tr>
                                            <tr nowrap>
                                                <td class="dir">S</td>
                                                <td class="data">2.66</td>
                                                <td class="data">4.74</td>
                                                <td class="data">0.43</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">7.83</td>
                                            </tr>
                                            <tr nowrap >
                                                <td class="dir">SSW</td>
                                                <td class="data">2.96</td>
                                                <td class="data">4.14</td>
                                                <td class="data">0.26</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">7.37</td>
                                            </tr>
                                            <tr nowrap>
                                                <td class="dir">SW</td>
                                                <td class="data">2.53</td>
                                                <td class="data">4.01</td>
                                                <td class="data">1.22</td>
                                                <td class="data">0.49</td>
                                                <td class="data">0.13</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">8.39</td>
                                            </tr>
                                            <tr nowrap >
                                                <td class="dir">WSW</td>
                                                <td class="data">1.97</td>
                                                <td class="data">2.66</td>
                                                <td class="data">1.97</td>
                                                <td class="data">0.79</td>
                                                <td class="data">0.30</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">7.70</td>
                                            </tr>
                                            <tr nowrap>
                                                <td class="dir">W</td>
                                                <td class="data">1.64</td>
                                                <td class="data">1.71</td>
                                                <td class="data">0.92</td>
                                                <td class="data">1.45</td>
                                                <td class="data">0.26</td>
                                                <td class="data">0.10</td>
                                                <td class="data">0.00</td>
                                                <td class="data">6.09</td>
                                            </tr>
                                            <tr nowrap >
                                                <td class="dir">WNW</td>
                                                <td class="data">1.32</td>
                                                <td class="data">2.40</td>
                                                <td class="data">0.99</td>
                                                <td class="data">1.61</td>
                                                <td class="data">0.33</td>
                                                <td class="data">0.00</td>
                                                <td class="data">0.00</td>
                                                <td class="data">6.64</td>
                                            </tr>
                                            <tr nowrap>
                                                <td class="dir">NW</td>
                                                <td class="data">1.58</td>
                                                <td class="data">4.28</td>
                                                <td class="data">1.28</td>
                                                <td class="data">0.76</td>
                                                <td class="data">0.66</td>
                                                <td class="data">0.69</td>
                                                <td class="data">0.03</td>
                                                <td class="data">9.28</td>
                                            </tr>		
                                            <tr nowrap >
                                                <td class="dir">NNW</td>
                                                <td class="data">1.51</td>
                                                <td class="data">5.00</td>
                                                <td class="data">1.32</td>
                                                <td class="data">0.13</td>
                                                <td class="data">0.23</td>
                                                <td class="data">0.13</td>
                                                <td class="data">0.07</td>
                                                <td class="data">8.39</td>
                                            </tr>
                                            <tr nowrap>
                                                <td class="totals">Total</td>
                                                <td class="totals">25.53</td>
                                                <td class="totals">44.54</td>
                                                <td class="totals">15.07</td>
                                                <td class="totals">8.52</td>
                                                <td class="totals">4.31</td>
                                                <td class="totals">1.81</td>
                                                <td class="totals">0.23</td>
                                                <td class="totals">&nbsp;</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <script src="js/plugins/morris/raphael.min.js"></script>
        <script src="js/plugins/morris/morris.min.js"></script>
        <script src="morris-data.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="js/sb-admin-2.js"></script>
    </body>

</html>
