<html>
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
    </head>
    <?php include 'header.php'?>
    <body>

     <div id="wrapper">        

        <div id="page-wrapper">

            <div class="container">

                <div class="row">
                        <div class="col-lg-12">
                            
                            <h2>Mortality Data</h2>

                            <form name="addMortality" class="form-horizontal" action="addMortalityDataExec.php" enctype="multipart/form-data" method='post'>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-xs-2 col-form-label">Birth Year: </label>
                                    <div class="col-xs-10">
                                        <input type='text' name='birth_year' class='form-control'></input>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-xs-2 col-form-label">Ethnicity: </label>
                                    <div class="col-xs-10">
                                        <input type='text' name='ethnicity' class='form-control'></input>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-xs-2 col-form-label">Death Toll: </label>
                                    <div class="col-xs-10">
                                        <input type='text' name='death_toll' class='form-control'></input>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <!--<button type="submit" class="btn btn-primary">Test Add Assist</button>-->
                                        <a href="View.php" class="btn btn-primary">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.row --> 

                    </div>
                
            </div>
        </div>
    </div>
        
    </body>
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
</html>
