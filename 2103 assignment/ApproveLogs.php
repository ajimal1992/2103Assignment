<?php
include ("database.php");
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
        <title>Approving Logs</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/sb-admin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="css/plugins/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link href="css/customCSS.css" rel="stylesheet">

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
                                $countQuery = "SELECT COUNT(*) AS records FROM AssistantLog_tentative_updates_on assLog WHERE assLog.update_ID NOT IN (SELECT app.update_ID FROM Approves app)";

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
                                <form method="post" action="ApprovalQueries.php">
                                    <table id="myTable">
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

                                        <?php
                                        // RETRIEVE ALL RECORDS THAT HAVEN'T BEEN APPROVED
                                        $retrieveQuery = "SELECT assLog.update_ID, assAd.username, assLog.birth_year, assLog.entity, assLog.new_value, "
                                                . "assLog.prev_value, assLog.update_type, assLog.timestamp, assLog.attribute, assLog.unique_keys FROM AssistantLog_tentative_updates_on assLog, "
                                                . "assistant_admin_acc assAd "
                                                . "WHERE assAd.userID = assLog.userID AND assLog.update_ID NOT IN (SELECT app.update_ID FROM Approves app)";
                                        $retrieveResult = sqlsrv_query($conn, $retrieveQuery);
                                        if ($retrieveResult === false) {
                                            die(print_r(sqlsrv_errors(), true));
                                        }
                                        $results = [];
                                        while ($retrieveRow = sqlsrv_fetch_array($retrieveResult, SQLSRV_FETCH_ASSOC)) {
                                            $results[] = $retrieveRow;
                                        }

                                        foreach ($results as $row) {
                                            $date_string = date_format($row['timestamp'], 'jS M Y, G:i A');  // format the date and time
                                            echo '<tr>';
                                            echo '<td><center><input type="checkbox" name="select[]" value="' . $row['update_ID'] . '"/></center</td>';
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
                                        } // END OF RETRIEVING ALL THE RECORDS THAT HAVENT BEEN APPROVED
                                       
                                        ?> 
                                        <tr><td><button class="btn btn-info" style="width:100%;display: block;" name = "approve" type = "approve" value = "approve">Approve</button></td></tr>

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
