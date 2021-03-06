
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
            $year = $_GET['year'];
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
                            <h2>Infants Data</h2>
                            <?php
//                            echo 'birth year is' .  $birth_year;
                                $collection = $db->infants;
                                $cursor = $collection->findOne(array('year' => (int)$year));
                            ?>

                            <form name="UpdateInfantsData" class="form-horizontal" action="UpdateInfantsDataExec.php" enctype="multipart/form-data" method='post'>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-xs-2 col-form-label">Total: </label>
                                    <div class="col-xs-10">
                                        <input type="hidden" name="year" value= "<?php echo $cursor['year']?>"/>
                                        <input type="hidden" name="prev_value" value="<?php echo $cursor['value']?>"/>
                                        <input class="form-control" name="value" type="text" value= "<?php echo $cursor['value']?>"/>
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

<!--<form name="UpdateInfantsData" class="form-horizontal" action="UpdateInfantsDataExec.php" enctype="multipart/form-data" method='post'>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-xs-2 col-form-label">Total: </label>
                                    <div class="col-xs-10">
                                        <input type="hidden" name="birth_year"/>
                                        <input type="hidden" name="prev_total"/>
                                        <input class="form-control" name="total" type="text" value= "<?php echo (string)$document['_id']?>"/>
                                    </div> 
                                    </div> 
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                        <button type="submit" class="btn btn-primary">Test Edit Assist</button>
                                        <a href="View.php" class="btn btn-primary">Cancel</a>
                                    </div>
                                </div>
                            </form>-->