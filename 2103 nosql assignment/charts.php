<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Infant Watch</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- custom css -->
    <link href="css/plugins/customCSS.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

         <?php include "header.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

<!--                 Page Heading 
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Infant Watch
                        </h1>
                    </div>
                </div>-->
                <!-- /.row -->

                <!-- Flot Charts -->
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">Population chart</h2>
                        <p class="lead">Infant watch is a tool which can be used to visualize the births of infants in Singapore.</p>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Infant population watch</h3><br/>                           
                                <table>
                                    <tr>
                                        <td>Data</td>
                                        <td style="padding-left: 20px;">Min Year</td>
                                        <td style="padding-left: 20px;">Max Year</td>
                                        <td class="filter" style="padding-left: 20px;">Filter</td>
                                        <td style="padding-left: 20px;"></td>
                                        <td style="padding-left: 20px;"></td>
                                    </tr>
                                    <tr>
                                    <td style="vertical-align:top;">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="background-color: #23355b;"><span id="sortBy">Select data</span>
                                            <span class="caret"></span></button>
                                            <ul id="sortByDD" class="dropdown-menu">
                                                <li><a href="#">Total Infants</a></li>
                                                <li><a href="#">Total births by Mother's race</a></li>
                                                <li><a href="#">Total births by Mother's child gender</a></li>
                                                <li><a href="#">Total births by Mother's age group</a></li>
                                                <li><a href="#">Total births by Fathers's race</a></li>
                                                <li><a href="#">Total births by Fathers's child gender</a></li>
<!--                                                <li><a href="#">Sort by </a></li>
                                                <li><a href="#">Total births by Fathers's race</a></li>-->
                                            </ul>
                                        </div>
                                    </td>
                                    <td style="vertical-align:top; padding-left: 20px;">
                                        <select style="color: black;" id="minYear">                            
                                        </select>
                                    </td>
                                    <td style="vertical-align:top; padding-left: 20px;">
                                        <select style="color: black;" id="maxYear">                          
                                        </select>
                                    </td>
                                    <td class="filter" style="vertical-align:top; padding-left: 20px;">
                                        <select style="color: black;" id="filterBy" multiple>                          
                                        </select>
                                    </td>
                                    <td style="vertical-align:top; padding-left: 20px;">
                                        <button onclick="add()"><font color="grey">Add</font></button>
                                    </td>
                                    <td style="vertical-align:top; padding-left: 20px;">
                                        <button onclick="reset()"><font color="grey">Reset</font></button>
                                    </td>
                                    </tr>
                                </table>                                
                            </div>
                            <div class="panel-body">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="flot-line-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Flot Charts JavaScript -->
    <!--[if lte IE 8]><script src="js/excanvas.min.js"></script><![endif]-->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="js/plugins/flot/flot-data.js"></script>

</body>

</html>
