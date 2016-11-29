<?php
include ("Dbconnect.php");
$collection = $db->selectCollection('AssistantLog_tentative_updates_on');
$approveCollection = $db->selectCollection('Approves');
$collection1 = $db->selectCollection('assistant_admin_acc');
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Infant Watch</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/sb-admin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="css/plugins/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!--<link href="css/customCSS.css" rel="stylesheet">-->

    </head>
    <body id="AdminLog">
        <div id="wrapper">

            <?php include "header.php" ?>
            <div id="page-wrapper">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Approving Logs</h1>
                            <!--                            <form method="post">
                                                            <input type="text" name='searchInput' id="myInput"  placeholder="Search" autofocus/>
                                                            <button class="btn btn-info" name = "submit" type = "submit" value = "submit">Submit</button>
                                                        </form>-->
                            <br/>
                            <p> Total number of records: <u>
                                <?php
                                $countResults = $collection->find(); //assistant_tentative
                                $compareUpdateid = $approveCollection->find(); //approves
                                $counter = 0;
                                
                               
                                foreach ($countResults as $row) {
                                    foreach ($compareUpdateid as $updateID) {
                                        if ((string) $row["_id"] == $updateID['updateID']) { //check whether got same id
                                            $counter +=1;  //if have, counter +1 
                                        }
                                    }
                                }
                                $countResults1 = $collection->count(); //count the total records in the assistant log.
                                $finalResult = $countResults1 - $counter;
                                echo $finalResult;
                                ?>
                            </u></p>
                            <div class="table-responsive">
                                <form method="post" action="ApprovalQueries.php">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th><center>Select</center></th>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Birth Year</th>
                                        <th>Entity</th>
                                        <th>New Value</th>
                                        <th>Prev Value</th>
                                        <th>Update type</th>
                                        <th>Attribute</th>
                                        <th>Unique Keys</th>
                                        <th>Date & Time Stamp</th>            
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // RETRIEVE ALL RECORDS THAT HAVEN'T BEEN APPROVED
                                            $retrieveResults = $collection->find(); //assistant_tentative
                                            $retrieveUsername = $collection1->find(); //assistant_admin_acc
                                            $compareUpdateid1 = $approveCollection->find(); //approves
                                            $unApproveID = [];
                                            foreach ($retrieveResults as $retrieve) {
                                                foreach ($compareUpdateid1 as $updateID1) {
                                        
                                                    if ((string) $retrieve["_id"] == $updateID1["updateID"]) { //check for distinct ID
                                                       
                                                        $unApproveID[] = $retrieve["_id"]; //put distinct ID into an array
                                                    }
                                                  
                                                }
                                            }
                        
                                            $retrieveResults1 = $collection->find(array("_id" => array('$nin' => $unApproveID)));
                                            
                                            foreach ($retrieveResults1 as $row) {
                                                
                                                foreach ($retrieveUsername as $username) {
                                                    if ((string) $username["userID"] == $row["userID"]) {
                                                        $date_string = date('jS M Y, G:i A', $row['timestamp']->sec);  // format the date and time
                                                        if(isset($row['_id'])==false){
                                                            $row['_id'] = "";
                                                        }
                                                        if(isset($username['username'])==false){
                                                            $username['username'] = "";
                                                        }
                                                        if(isset($row['entity'])==false){
                                                            $row['entity'] = "";
                                                        }
                                                        if(isset($row['new_value'])==false){
                                                            $row['new_value'] = "";
                                                        }
                                                        if(isset($row['prev_value'])==false){
                                                            $row['prev_value'] = "";
                                                        }
                                                        if(isset($row['update_value'])==false){
                                                            $row['update_value'] = "";
                                                        }
                                                        if(isset($row['attribute'])==false){
                                                            $row['attribute'] = "";
                                                        }
                                                        if(isset($row['unique_keys'])==false){
                                                            $row['unique_keys'] = "";
                                                        }                                                        
                                                        echo '<tr>';
                                                        echo '<td><center><input type="checkbox" name="select[]" value="' . $row['_id'] . '"/></center</td>';
                                                        echo '<td>' . $row['_id'] . '</td>';
                                                        echo '<td>' . $username['username'] . '</td>';
                                                        echo '<td>' . $row['birth_year'] . '</td>';
                                                        echo '<td>' . $row['entity'] . '</td>';
                                                        echo '<td>' . $row['new_value'] . '</td>';
                                                        echo '<td>' . $row['prev_value'] . '</td>';
                                                        echo '<td>' . $row['update_type'] . '</td>';
                                                        echo '<td>' . $row['attribute'] . '</td>';
                                                        echo '<td>' . $row['unique_keys'] . '</td>';
                                                        echo '<td>' . $date_string . '</td>';
                                                        echo '</tr>';
                                                    }
                                                }
                                            } // END OF RETRIEVING ALL THE RECORDS THAT HAVENT BEEN APPROVED
                                            ?> 

                                            <tr><td><button class="btn btn-info" style="width:100%;display: block;" name = "approve" type = "approve" value = "approve">Approve</button></td></tr>
                                        </tbody>
                                    </table>
                                </form>

                            </div>

                        </div>
                    </div>
                    <!-- /.row -->

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

        <!-- Morris Charts JavaScript -->
        <script src="js/plugins/morris/raphael.min.js"></script>
        <script src="js/plugins/morris/morris.min.js"></script>
        <script src="js/plugins/morris/morris-data.js"></script>


    </body>
</html>
