
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

        <?php require_once('DB_Connection.php'); ?>
    </head>

    <body>
        <div id="wrapper"> 
            <header>
            <?php
            include 'header.inc.php';
            $location = 'EditData';
            $inforID = $_GET['inforID'];
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
                            $sql = "select * from Mother_births_by 
                                    where inforID = ?;";
                            $query = sqlsrv_query($conn, $sql, array($inforID));
                            if ($query === false) {
                                die(print_r(sqlsrv_errors(), true));
                            }
                            $row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
                            ?>
                            <h2>Infants Data</h2>

                            <form name="UpdateMothersData" class="form-horizontal" action="UpdateMothersDataExec.php" enctype="multipart/form-data" method='post'>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-xs-2 col-form-label">Birth Year: </label>
                                    <div class="col-xs-10">
                                        <input type="hidden" name="inforID" value="<?php echo $inforID ?>"/>
                                        <input type="hidden" name="prev_birth_year" value="<?php echo $row['birth_year'] ?>"/>
                                        <input type="hidden" name="prev_race" value="<?php echo $row['race'] ?>"/>
                                        <input type="hidden" name="prev_mth" value="<?php echo $row['mth'] ?>"/>
                                        <input type="hidden" name="prev_child_gender" value="<?php echo $row['child_gender'] ?>"/>
                                        <input type="hidden" name="prev_age_group" value="<?php echo $row['age_group'] ?>"/>
                                        <input type="hidden" name="prev_live_births" value="<?php echo $row['live_births'] ?>"/>
                                        <input class="form-control" name="birth_year" type="text" value="<?php echo $row['birth_year'];?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-xs-2 col-form-label">Race: </label>
                                    <div class="col-xs-10">
                                        <input class="form-control" name="race" type="text" value="<?php echo $row['race'];?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-xs-2 col-form-label">Month: </label>
                                    <div class="col-xs-10">
                                        <input class="form-control" name="mth" type="text" value="<?php echo $row['mth'];?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-xs-2 col-form-label">Child Gender: </label>
                                    <div class="col-xs-10">
                                        <input class="form-control" name="child_gender" type="text" value="<?php echo $row['child_gender'];?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-xs-2 col-form-label">Mother's age group: </label>
                                    <div class="col-xs-10">
                                        <select name="age_group">
                                            <option value="15 - 19" <?php if($row['age_group'] == "15 - 19") echo'selected="selected"';?>>15 - 19</option>
                                            <option value="20 - 24" <?php if($row['age_group'] == "20 - 24") echo'selected="selected"';?>>20 - 24</option>
                                            <option value="25 - 29" <?php if($row['age_group'] == "25 - 29") echo'selected="selected"';?>>25 - 29</option>
                                            <option value="30 - 34" <?php if($row['age_group'] == "30 - 34") echo'selected="selected"';?>>30 - 34</option>
                                            <option value="35 - 39" <?php if($row['age_group'] == "35 - 39") echo'selected="selected"';?>>35 - 39</option>
                                            <option value="40 - 44" <?php if($row['age_group'] == "40 - 44") echo'selected="selected"';?>>40 - 44</option>
                                        </select>
                                    </div>
                                </div>      
                                
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-xs-2 col-form-label">Live Births: </label>
                                    <div class="col-xs-10">
                                        <input class="form-control" name="live_births" type="text" value="<?php echo $row['live_births'];?>">
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