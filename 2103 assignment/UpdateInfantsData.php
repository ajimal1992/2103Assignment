
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SB Admin - Bootstrap Admin Template</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/sb-admin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="css/plugins/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <?php require_once('Dbconnect.php'); ?>
    </head>

    <body>
        <div id="wrapper"> 
            <header>
            <?php
            include 'header.inc.php';
            $location = 'EditData';
            $birth_year = $_GET['birth_year'];
            ?>
            </header>
            <div id="page-wrapper">
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Tables
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-table"></i> Tables
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- End of Page Heading -->                  

                    <div class="row">
                        <div class="col-lg-12">
                            <?php                            
                            $sql = "select * from infants 
                                    where birth_year = ?;";
                            $query = sqlsrv_query($conn, $sql, array($birth_year));
                            if ($query === false) {
                                die(print_r(sqlsrv_errors(), true));
                            }
                            $row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
                            ?>
                            <h2>Infants Data</h2>

                            <form name="UpdateInfantsData" class="form-horizontal" action="UpdateInfantsDataExec.php" enctype="multipart/form-data" method='post'>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-xs-2 col-form-label">Total: </label>
                                    <div class="col-xs-10">
                                        <input type="hidden" name="birth_year" value="<?php echo $birth_year ?>"/>
                                        <input type="hidden" name="prev_total" value="<?php echo $row['total'];?>"/>
                                        <input class="form-control" name="total" type="text" value="<?php echo $row['total'];?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                        <!--<button type="submit" class="btn btn-primary">Test Edit Assist</button>-->
                                        <a href="View.php" class="btn btn-primary">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.row --> 
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /#page-wrapper -->
            </div>
            <!-- /#wrapper -->
        </div>
        
        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <script src="js/plugins/morris/raphael.min.js"></script>
        <script src="js/plugins/morris/morris.min.js"></script>
        <script src="js/plugins/morris/morris-data.js"></script>
    </body>
</html>

