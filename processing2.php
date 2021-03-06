<html>
     <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SB Admin - Bootstrap Admin Template</title>
        <link href="css.css" rel="stylesheet">

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/sb-admin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="css/plugins/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        
        <?php require_once('Dbconnect.php'); 
        include'header.inc.php'?>
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

                <!-- INFANTS TABLE -->
                <div class="row">
                    <div class="col-lg-5">
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
                                    $collection = $db->infants;
                                    $cursor = $collection->find();
                                    foreach($cursor as $document) {
                                    ?>
                                    <tr>
                                        <td><?php echo $document["year"]; ?></td>
                                        <td><?php echo $document["value"]; ?></td>
                                        <!-- ADD IN DELETE HREF HERE -->
                                        <td><a href="UpdateInfantsData.php?year=<?php echo $document["year"]; ?>">Edit</a></td> 
										<!-- delete -->
										<td><a href="delete2.php?infantID=<?php echo $document['_id'];?>&total=<?php echo $document['value']?>&infantyear=<?php echo $document['year']?>"onclick="return deletechecked();">Delete</a></td>
										
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
                                    $collection_mortality = $db->Mortality_under_a_year;
                                    $cursor_mortality = $collection_mortality->find();
                                    foreach($cursor_mortality as $document_mortality) {
                                        ?>
                                    <tr>
                                        <td><?php echo $document_mortality['birth_year']; ?></td>
                                        <td><?php echo $document_mortality['ethnicity']; ?></td>
                                        <td><?php echo $document_mortality['death_toll']; ?></td>
                                        <!-- ADD IN DELETE HREF HERE -->
                                        <td><a href="UpdateMortalityData.php?birth_year=<?php echo $document_mortality['birth_year']; ?> 
                                               &ethnicity=<?php echo $document_mortality['ethnicity']?>">Edit</a></td> 
											   <!--DELETE HERE -->
												<td><a href="delete2.php?mortID=<?php echo $document_mortality['_id']; ?> 
													 &yea=<?php echo $document_mortality['birth_year']?>	
                                               &eth=<?php echo $document_mortality['ethnicity']?>"onclick="return deletechecked();">Delete</a></td> 
                                    </tr>   <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END OF MORTALITY TABLE -->
                <!-- controls PROCESSING HERE-->
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
                                    $collection_mother = $db->Mother_births_by;
									$year = $_POST['year'];
									//find(array('birth_year' => intval($year)));
                                    $cursor_mother = $collection_mother->find(array('birth_year' => intval($year)));
                                    foreach($cursor_mother as $document_mother) {
                                        ?>
                                    <tr>
                                        <td><?php echo $document_mother['birth_year']; ?></td>
                                        <td><?php echo $document_mother['race']; ?></td>
                                        <td><?php echo $document_mother['age_group']; ?></td>
                                        <td><?php echo $document_mother['mth']; ?></td>
                                        <td><?php echo $document_mother['child_gender']; ?></td>
                                        <td><?php echo $document_mother['live_births']; ?></td>
                                        <!-- ADD IN DELETE HREF HERE -->
                                        <td><a href="UpdateMothersData.php?_id=<?php echo $document_mother['_id'];?>">Edit</a></td> 
										 <!--DELETE HERE -->
										<td><a href="delete2.php?inforIDm=<?php echo $document_mother['_id']; ?> 
											&motherbr=<?php echo $document_mother['birth_year']?>"onclick="return deletechecked();">Delete</a></td> 
										
										
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
                                    $collection_father = $db->Father_births_by;
									$yeara = $_POST['yeara'];
									//find(array('birth_year' => intval($yeara)));
                                    $cursor_father = $collection_father->find(array('birth_year' => intval($yeara)));
                                    foreach($cursor_father as $document_father) {
                                        ?>
                                <tr>
                                        <td><?php echo $document_father['birth_year']; ?></td>
                                        <td><?php echo $document_father['race']; ?></td>
                                        <td><?php echo $document_father['mth']; ?></td>
                                        <td><?php echo $document_father['child_gender']; ?></td>
                                        <td><?php echo $document_father['live_births']; ?></td>
                                        <!-- ADD IN DELETE HREF HERE -->
                                        <td><a href="UpdateFathersData.php?_id=<?php echo $document_father['_id'];?>">Edit</a></td> 
										 <!--DELETE HERE -->
										<td><a href="delete2.php?inforID=<?php echo $document_father['_id']; ?> 
										&fatherbr=<?php echo $document_father['birth_year']?>"onclick="return deletechecked();">Delete</a></td> 
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
