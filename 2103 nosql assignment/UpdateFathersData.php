
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
            $inforID = $_GET['_id'];
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
                                $collection = $db->Father_births_by;
                                $row = $collection->findOne(array('_id' => new MongoId($inforID)));
                            ?>
                            <h2>Fathers Data</h2>

                            <form name="UpdateFathersData" class="form-horizontal" action="UpdateFathersDataExec.php" enctype="multipart/form-data" method='post'>
                                <div class="form-group row">
                                    <div class="col-xs-10">
                                        <input type="hidden" name="_id" value="<?php echo $inforID ?>"/>
                                        <input type="hidden" name="birth_year" value="<?php echo $row['birth_year'] ?>"/>
                                        <input type="hidden" name="prev_race" value="<?php echo $row['race'] ?>"/>
                                        <input type="hidden" name="prev_mth" value="<?php echo $row['mth'] ?>"/>
                                        <input type="hidden" name="prev_child_gender" value="<?php echo $row['child_gender'] ?>"/>
                                        <input type="hidden" name="prev_live_births" value="<?php echo $row['live_births'] ?>"/>
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
