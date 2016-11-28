
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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

        <?php require_once('Dbconnect.php'); ?>
    </head>

    <body>
        <div id="wrapper"> 
            <header>
            <?php
            include 'header.php';
            $location = 'EditData';
            $birth_year = $_GET['birth_year'];
            $ethnicity = $_GET['ethnicity'];
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
                            
                        </div>
                    </div>
                    <!-- End of Page Heading -->                  

                    <div class="row">
                        <div class="col-lg-12">
                            <?php                            
                            $sql = "select * from Mortality_under_a_year 
                                    where birth_year = ? and ethnicity = ?;";
                            $query = sqlsrv_query($conn, $sql, array($birth_year, $ethnicity));
                            if ($query === false) {
                                die(print_r(sqlsrv_errors(), true));
                            }
                            $row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
                            ?>
                            <h2>Mortality Data</h2>

                            <form name="UpdateMortalityData" class="form-horizontal" action="UpdateMortalityDataExec.php" enctype="multipart/form-data" method='post'>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-xs-2 col-form-label">Birth Year: </label>
                                    <div class="col-xs-10">
                                        <input type="hidden" name="birth_year" value="<?php echo $birth_year ?>"/>
                                        <input type="hidden" name="prev_ethnicity" value="<?php echo $row['ethnicity'] ?>"/>
                                        <input class="form-control" name="ethnicity" type="text" value="<?php echo $row['ethnicity'];?>"/>
                                    </div>
                                    <label for="example-text-input" class="col-xs-2 col-form-label">Death Toll: </label>
                                    <div class="col-xs-10">
                                        <input type="hidden" name="prev_death_toll" value="<?php echo $row['death_toll'] ?>"/>
                                        <input class="form-control" name="death_toll" type="text" value="<?php echo $row['death_toll'];?>"/>
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

