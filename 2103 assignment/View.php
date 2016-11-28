<html>
     <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Infant Watch</title>
        <link href="css.css" rel="stylesheet">

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

        <style>
            div.scroll {


                height: 500px;
                overflow: scroll;
            }



        </style>
        
    <div id="wrapper">  
        <header>
        <?php include 'header.php'; 
        $location = 'Edit'?>
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

                <!-- INFANTS TABLE -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="scroll">
                            <h2>Infants
                                <div>
                                    <a href="addInfantsData.php" class="btn btn-primary">Add New Infants Record</a>
                                </div>
                            </h2>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Birth Year</th>
                                        <th>Total</th>
                                        <th>Update</th>                                        
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $infants_sql = "select * from infants";
                                    $infants_query = sqlsrv_query($conn, $infants_sql);
                                    if ($infants_query === false) {
                                        die(print_r(sqlsrv_errors(), true));
                                    }
                                    while( $row_infants = sqlsrv_fetch_array( $infants_query, SQLSRV_FETCH_ASSOC) ) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row_infants['birth_year']; ?></td>
                                        <td><?php echo $row_infants['total']; ?></td>
                                        <!-- ADD IN DELETE HREF HERE -->
                                        <td><a href="UpdateInfantsData.php?birth_year=<?php echo $row_infants['birth_year']; ?>">Edit</a></td> 
										<td><a href="delete2.php?infantID=<?php echo $row_infants['birth_year'];?>&total=<?php echo $row_infants['total']?>"onclick="return deletechecked();">Delete</a></td>
                                    </tr>   <?php } ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END OF INFANTS TABLE -->
                
                <!-- MORTALITY TABLE -->    
                <div class="col-lg-7">
                    <div class="scroll">
                        <h2>
                            Mortality_under_a_year
                            <div>
                                <a href="addMortalityData.php" class="btn btn-primary">Add New Mortality Record</a>
                            </div>
                        </h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Birth Year</th>
                                        <th>Ethnicity</th>
                                        <th>Death Toll</th>
                                        <th>Update</th>                                        
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $mortality_sql = "select * from Mortality_under_a_year";
                                    $mortality_query = sqlsrv_query($conn, $mortality_sql);
                                    if ($mortality_query === false) {
                                        die(print_r(sqlsrv_errors(), true));
                                    }
                                    while ($row_mortality = sqlsrv_fetch_array($mortality_query, SQLSRV_FETCH_ASSOC)) {
                                        ?>
                                    <tr>
                                        <td><?php echo $row_mortality['birth_year']; ?></td>
                                        <td><?php echo $row_mortality['ethnicity']; ?></td>
                                        <td><?php echo $row_mortality['death_toll']; ?></td>
                                        <!-- ADD IN DELETE HREF HERE -->
										
                                        <td><a href="UpdateMortalityData.php?birth_year=<?php echo $row_mortality['birth_year']; ?> 
                                               &ethnicity=<?php echo $row_mortality['ethnicity']?>">Edit</a></td> 
											   
											   <td><a href="delete2.php?mortID=<?php echo $row_mortality['birth_year']; ?> 
													 &dea=<?php echo $row_mortality['death_toll']?>	
                                               &eth=<?php echo $row_mortality['ethnicity']?>"onclick="return deletechecked();">Delete</a></td> 
											   
                                    </tr>   <?php } ?>
									
									
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END OF MORTALITY TABLE -->
                <div class="row">
                    <div class="col-lg-12">
                        
                            <h2>Search By year</h2>
                            <div class="table-responsive">
                               
<form action="processing2.php" method="POST">
                Search for Mother <select name=year>
  <option name=year value="2012">2012</option>
  <option name=year value="2013">2013</option>
  <option name=year value="2014">2014</option>
  <option name=year value="2015">2015</option>
</select><br><br>
				

  Search for Father:

  
<select name=yeara>
  <option name=yeara value="2012">2012</option>
  <option name=yeara value="2013">2013</option>
  <option name=yeara value="2014">2014</option>
  <option name=yeara value="2015">2015</option>
</select>
<input type="submit">
  </form>


                            </div>
                        
                    </div>
                </div>
                <!-- MOTHERS TABLE -->
                <div class="col-lg-12">
                    <div class="scroll">
                        <h2>Mother
                        <div>
                            <a href="addMothersData.php" class="btn btn-primary">Add New Mothers Record</a>
                        </div> </h2>                                               
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Birth Year</th>
                                        <th>Race</th>
                                        <th>Age Group</th>
                                        <th>Month</th>
                                        <th>Child Gender</th>
                                        <th>Live Births</th>
                                        <th>Update</th>                                        
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									// $year = $_POST['year'];
                                    $mothers_sql = "select * from Mother_births_by";
                                    $mothers_query = sqlsrv_query($conn, $mothers_sql);
                                    if ($mothers_query === false) {
                                        die(print_r(sqlsrv_errors(), true));
                                    }
                                    while ($row_mothers = sqlsrv_fetch_array($mothers_query, SQLSRV_FETCH_ASSOC)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row_mothers['birth_year']; ?></td>
                                        <td><?php echo $row_mothers['race']; ?></td>
                                        <td><?php echo $row_mothers['age_group']; ?></td>
                                        <td><?php echo $row_mothers['mth']; ?></td>
                                        <td><?php echo $row_mothers['child_gender']; ?></td>
                                        <td><?php echo $row_mothers['live_births']; ?></td>
                                        
                                        <td><a href="UpdateMothersData.php?inforID=<?php echo $row_mothers['inforID'];?>">Edit</a></td> 
										<!-- ADD IN DELETE HREF HERE -->
										<td><a href="delete2.php?inforIDm=<?php echo $row_mothers['inforID']; ?> 
											&motherbr=<?php echo $row_mothers['birth_year']?>"onclick="return deletechecked();">Delete</a></td> 
										
										
                                    </tr>   <?php } ?>                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END OF MOTHERS TABLE -->
                
                <!-- FATHERS TABLE -->
                <div class="col-lg-12">
                    <div class="scroll">
                        <h2>
                            Father
                            <div>
                                <a href="addFathersData.php" class="btn btn-primary">Add New Infants Record</a>
                            </div>
                        </h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Birth Year</th>
                                        <th>Race</th>
                                        <th>Month</th>
                                        <th>Child Gender</th>
                                        <th>Live Births</th>
                                        <th>Update</th>                                        
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <?php
								// $yeara = $_POST['yeara'];
                                $fathers_sql = "select * from Father_births_by";
                                $fathers_query = sqlsrv_query($conn, $fathers_sql);
                                if ($fathers_query === false) {
                                        die(print_r(sqlsrv_errors(), true));
                                    }
                                    while ($row_fathers = sqlsrv_fetch_array($fathers_query, SQLSRV_FETCH_ASSOC)) {
                                ?>
                                <tr>
                                        <td><?php echo $row_fathers['birth_year']; ?></td>
                                        <td><?php echo $row_fathers['race']; ?></td>
                                        <td><?php echo $row_fathers['mth']; ?></td>
                                        <td><?php echo $row_fathers['child_gender']; ?></td>
                                        <td><?php echo $row_fathers['live_births']; ?></td>
                                       
                                        <td><a href="UpdateFathersData.php?inforID=<?php echo $row_fathers['inforID'];?>">Edit</a></td> 
										 <!-- ADD IN DELETE HREF HERE -->
										<td><a href="delete2.php?inforID=<?php echo $row_fathers['inforID']; ?> 
										&fatherbr=<?php echo $row_fathers['birth_year']?>"onclick="return deletechecked();">Delete</a></td> 
										
										
                                    </tr>   <?php } ?>                                  
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END OF FATHERS TABLE -->
                
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<script> function deletechecked()
    {
        if(confirm("Delete selected?"))
        {
            return true;
        }
        else
        {
            return false;  
        } 
   }</script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
</html>
