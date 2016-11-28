<?php
include ("Dbconnect.php");
$collection = $db->selectCollection('AdminLog_updates_on');
$collection1 = $db->selectCollection('admin_acc');
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

    </head>
    <body>
        <div id="wrapper">

            <?php include "header.php" ?>
            <div id="page-wrapper">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Admin Logs</h1>

                            <form method="post">
                                <input type="text" name='searchInput' id="myInput"  placeholder="Search" autofocus/>
                                <button class="btn btn-info" name = "submit" type = "submit" value = "submit">Submit</button>
                            </form>
                            <br/>
                            <p> Total number of records: <u>
                                <?php
                                $countResults = $collection->count();
                                echo $countResults;
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
                                            <th>Previous Value</th>
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
                                            //AdminLog_updates_on
                                            $searchResults = $collection->find(array('$or' => array(array("entity" => new MongoRegex("/$searchInput/i")),
                                                    array("new_value" => new MongoRegex("/$searchInput/i")), array("prev_value" => new MongoRegex("/$searchInput/i")),
                                                    array("update_type" => new MongoRegex("/$searchInput/i")), array("attribute" => new MongoRegex("/$searchInput/i")),
                                                    array("unique_keys" => new MongoRegex("/$searchInput/i")),array("timestamp" => new MongoRegex("/$searchInput/i")))));
                                            $retrieveUsername = $collection1->find(); //admin_acc
//                                            $searchQuery = "SELECT * FROM AdminLog_updates_on al, admin_acc aa "
//                                                    . "WHERE aa.userID = al.userID AND (al.update_ID LIKE '%$searchInput%' OR "
//                                                    . "aa.username LIKE '%$searchInput%' OR al.birth_year LIKE '%$searchInput%' OR "
//                                                    . "al.entity LIKE '%$searchInput%' OR al.new_value LIKE '%$searchInput%' OR "
//                                                    . "al.prev_value LIKE '%$searchInput%' OR al.update_type LIKE '%$searchInput%' "
//                                                    . "OR al.timestamp LIKE '%$searchInput%' OR al.attribute LIKE '%$searchInput%' OR al.unique_keys LIKE '%$searchInput%')";


                                            foreach ($searchResults as $row) {
                                                foreach ($retrieveUsername as $username) {
                                                    if ($username["userID"] == $row["userID"]) {
                                                        $date_string = date('jS M Y, G:i A', $row['timestamp']->sec);  // format the date and time
                                                        echo '<tr>';
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
                                            }
                                            //END OF SEARCHING FUNCTION
                                        } else { // RETRIEVE ALL TABLES WITHOUT SEARCHING FUNCTION
                                            $retrieveResults = $collection->find(); //AdminLog_updates_on
                                            $retrieveUsername = $collection1->find(); //admin_acc

                                            foreach ($retrieveResults as $row) {
                                                foreach ($retrieveUsername as $username) {
                                                    if ($username["userID"] == $row["userID"]) {
                                                         $date_string = date('jS M Y, G:i A', $row['timestamp']->sec);  // format the date and time

                                                        echo '<tr>';
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
                                            }
                                        } // END OF RETRIEVE ALL TABLES WITHOUT SEARCHING FUNCTION
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
