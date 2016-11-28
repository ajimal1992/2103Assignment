<?php
include ("Dbconnect.php");
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

        <link href="css/customCSS.css" rel="stylesheet">
        
        <script type="text/javascript">
      
        function AdvanceSearchToggle()
        {
            $('#advanceSearchRow').toggle();
        }
        
        
    </script>

    </head>
    <body>
        <div id="wrapper">
             <?php include "header.php" ?>
            <div id="page-wrapper">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Assistant Logs</h1>
                           <form method="post">
                                <input type="text" name='searchInput' id="myInput"  placeholder="Search" autofocus/>
                                <button class="btn btn-info" name = "submit" type = "submit" value = "submit">Submit</button>
                                <a href="#" aria-label="Left Align" onclick="AdvanceSearchToggle();">Advance Search</a>
                                <br>
                                <table id="hiddentable">
                                <tr id="advanceSearchRow" style="display:none" >
                                    <td><button class="btn btn-info" id="advSearch" name = "Asubmit" type = "submit" value = "submit">ASubmit</button></td><br>
                                    <td><input type="text"  name="update_ID"  placeholder="Update ID" value=""></td>
                                    <td><input type="text"  name="username"  placeholder="Name" value=""></td>
                                    <td><input type="text"  name="birth_year"  placeholder="Birth year" value=""></td>
                                    <td><input type="text"  name="entity"  placeholder="Entity" value=""></td>
                                    <td><input type="text"  name="new_value"  placeholder="New value" value=""></td>
                                    <td><input type="text"  name="prev_value"  placeholder="Pre value" value=""></td>
                                    <td><input type="text"  name="update_type"  placeholder="Update type" value=""></td>
                                    <td><input type="text"  name="attribute"  placeholder="Attribute" value=""></td>
                                    <td><input type="text"  name="unique_keys"  placeholder="Unique keys" value=""></td>
                               
                                </table>
                                
                            </form>
                            <br/>
                            <p> Total number of records: <u>
                                <?php
                                $countQuery = "SELECT COUNT(*) AS records FROM AssistantLog_tentative_updates_on assLog WHERE assLog.update_ID IN (SELECT app.update_ID FROM Approves app)";

                                $countResult = sqlsrv_query($conn, $countQuery);
                                if ($countResult === false) {
                                    die(print_r(sqlsrv_errors(), true));
                                }

                                while ($row = sqlsrv_fetch_array($countResult, SQLSRV_FETCH_ASSOC)) {
                                    echo $row['records'];
                                }
                                    ?>
                                </u></p>
                               <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
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
                                         // SEARCHING FUNCTION 
                                        if (isset($_POST['submit'])) {
                                            $searchInput = trim($_POST['searchInput']);
                                            $searchQuery = "SELECT assLog.update_ID, assAd.username, assLog.birth_year, assLog.entity, assLog.new_value, "
                                                    . "assLog.prev_value, assLog.update_type, app.timestamp, assLog.attribute, assLog.unique_keys FROM AssistantLog_tentative_updates_on assLog, assistant_admin_acc assAd, Approves app "
                                                    . "WHERE assAd.userID = assLog.userID AND app.update_ID = assLog.update_ID AND(assLog.update_ID LIKE '%$searchInput%' OR "
                                                    . "assAd.username LIKE '%$searchInput%' OR assLog.birth_year LIKE '%$searchInput%' OR "
                                                    . "assLog.entity LIKE '%$searchInput%' OR assLog.new_value LIKE '%$searchInput%' OR "
                                                    . "assLog.prev_value LIKE '%$searchInput%' OR assLog.update_type LIKE '%$searchInput%' "
                                                    . "OR app.timestamp LIKE '%$searchInput%' OR assLog.attribute LIKE '%$searchInput%' OR assLog.unique_keys LIKE '%$searchInput%') "
                                                    . "AND assLog.update_ID IN (SELECT app.update_ID FROM Approves app) ORDER BY assLog.update_ID ASC";

                                            $searchResult = sqlsrv_query($conn, $searchQuery);
                                            if ($searchResult === false) {
                                                die(print_r(sqlsrv_errors(), true));
                                            }
                                            $results =[];
                                            while ($searchRow = sqlsrv_fetch_array($searchResult, SQLSRV_FETCH_ASSOC)) {
                                                $results[] = $searchRow;
                                            }
                                            foreach($results as $row){
                                                $date_string = date_format($row['timestamp'], 'jS M Y, G:i A');  // format the date and time
                                                echo '<tr>';
                                                echo '<td>' . $row['update_ID'] . '</td>';
                                                echo '<td>' . $row['username'] . '</td>';
                                                echo '<td>' . $row['birth_year'] . '</td>';
                                                echo '<td>' . $row['entity'] . '</td>';
                                                echo '<td>' . $row['new_value'] . '</td>';
                                                echo '<td>' . $row['prev_value'] . '</td>';
                                                echo '<td>' . $row['update_type'] . '</td>';
                                                echo '<td>' . $row['attribute'] . '</td>';
                                                echo '<td>' . $row['unique_keys'] . '</td>';
                                                echo '<td>' . $date_string . '</td>';
                                                echo '</tr>';
                                            } //END OF SEARCHING FUNCTION 
                                        }elseif(isset($_POST['Asubmit'])){
                                            $searchInput1 = trim($_POST['update_ID']);
                                            $searchInput2 = trim($_POST['username']);
                                            $searchInput3 = trim($_POST['birth_year']);
                                            $searchInput4 = trim($_POST['entity']);
                                            $searchInput5 = trim($_POST['new_value']);
                                            $searchInput6 = trim($_POST['prev_value']);
                                            $searchInput7 = trim($_POST['update_type']);
                                            $searchInput8 = trim($_POST['attribute']);
                                            $searchInput9 = trim($_POST['unique_keys']);
                                            
                                            
                                            $searchQuery1 = "SELECT assLog.update_ID, assAd.username, assLog.birth_year, assLog.entity, assLog.new_value, "
                                                    . "assLog.prev_value, assLog.update_type, app.timestamp, assLog.attribute, assLog.unique_keys FROM AssistantLog_tentative_updates_on assLog, assistant_admin_acc assAd, Approves app "
                                                    . "WHERE assAd.userID = assLog.userID AND app.update_ID = assLog.update_ID AND(ISNULL(assLog.update_ID,'') LIKE '%$searchInput1%' AND "
                                                    . "ISNULL(assAd.username,'') LIKE '%$searchInput2%' AND ISNULL(assLog.birth_year,'') LIKE '%$searchInput3%' AND "
                                                    . "ISNULL(assLog.entity,'') LIKE '%$searchInput4%' AND ISNULL(assLog.new_value,'') LIKE '%$searchInput5%' AND "
                                                    . "ISNULL(assLog.prev_value,'') LIKE '%$searchInput6%' AND ISNULL(assLog.update_type,'') LIKE '%$searchInput7%' "
                                                    . "AND ISNULL(assLog.attribute,'') LIKE '%$searchInput8%' AND ISNULL(assLog.unique_keys,'') LIKE '%$searchInput9%') "
                                                    . "AND assLog.update_ID IN (SELECT app.update_ID FROM Approves app) ORDER BY assLog.update_ID ASC";

                                            $searchResult1 = sqlsrv_query($conn, $searchQuery1);
                                            if ($searchResult1 === false) {
                                                die(print_r(sqlsrv_errors(), true));
                                            }
                                            $results11 =[];
                                            while ($searchRow1 = sqlsrv_fetch_array($searchResult1, SQLSRV_FETCH_ASSOC)) {
                                                $results11[] = $searchRow1;
                                            }
                                            
                                            foreach($results11 as $row){
                                                $date_string = date_format($row['timestamp'], 'jS M Y, G:i A');  // format the date and time
                                                echo '<tr>';
                                                echo '<td>' . $row['update_ID'] . '</td>';
                                                echo '<td>' . $row['username'] . '</td>';
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
                                        }  else { // RETRIEVE ALL APPROVED RECORDS WITHOUT SEARCHING FUNCTION
                                            $retrieveQuery = "SELECT assLog.update_ID, assAd.username, assLog.birth_year, assLog.entity, assLog.new_value, "
                                                    . "assLog.prev_value, assLog.update_type, app.timestamp, assLog.attribute, assLog.unique_keys FROM AssistantLog_tentative_updates_on assLog, assistant_admin_acc assAd, Approves app "
                                                    . "WHERE assAd.userID = assLog.userID AND app.update_ID = assLog.update_ID AND assLog.update_ID IN (SELECT app.update_ID FROM Approves app) ORDER BY assLog.update_ID ASC";
                                            $retrieveResult = sqlsrv_query($conn, $retrieveQuery);
                                            if ($retrieveResult === false) {
                                                die(print_r(sqlsrv_errors(), true));
                                            }
                                            $results1 =[];   
                                            while ($retrieveRow = sqlsrv_fetch_array($retrieveResult, SQLSRV_FETCH_ASSOC)) {
                                                $results1[] = $retrieveRow;
                                            }
                                            foreach($results1 as $row){
                                            $date_string = date_format($row['timestamp'], 'jS M Y, G:i A');  // format the date and time
                                                echo '<tr>';
                                                echo '<td>' . $row['update_ID'] . '</td>';
                                                echo '<td>' . $row['username'] . '</td>';
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
                                             
                                        }  // END OF RETRIEVE ALL APPROVED RECORDS WITHOUT SEARCHING FUNCTION
                                        ?>
                                        </tbody>
                                </table>
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

