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
                            <h1 class="page-header">Admin Logs</h1>

                            <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

                                <input type="text" name='searchInput' id="myInput"  placeholder="Search" autofocus/>
                                <button class="btn btn-info" name = "submit" type = "submit" value = "submit">Submit</button>
                                <a href="#" aria-label="Left Align" onclick="AdvanceSearchToggle();">Advance Search</a>
                                <br>
                                <table id="hiddentable">
                                    <tr id="advanceSearchRow" style="display:none" >
                                        <td><button class="btn btn-info" id="advSearch" name = "Asubmit" type = "submit" value = "submit">ASubmit</button></td>
                                        <td>   <input type="text"  name="update_ID"  placeholder="Update ID" value=""/></td>
                                        <td>   <input type="text"  name="username"  placeholder="Name" value=""/></td>
                                        <td><input type="text"  name="birth_year"  placeholder="Birth year" value=""/></td>
                                        <td><input type="text"  name="entity"  placeholder="Entity" value=""/></td>
                                        <td><input type="text"  name="new_value"  placeholder="New value" value=""/></td>
                                        <td><input type="text"  name="prev_value"  placeholder="Pre value" value=""/></td>
                                        <td><input type="text"  name="update_type"  placeholder="Update type" value=""/></td>
                                        <td><input type="text"  name="attribute"  placeholder="Attribute" value=""/></td>
                                        <td><input type="text"  name="unique_keys"  placeholder="Unique keys" value=""/></td>
                                    </tr>
                                </table>


                            </form><hr>
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
                                                    array("unique_keys" => new MongoRegex("/$searchInput/i")), array("timestamp" => new MongoRegex("/$searchInput/i")))));
                                            $retrieveUsername = $collection1->find(); //admin_acc
//                                           
                                            foreach ($searchResults as $row) {
                                                foreach ($retrieveUsername as $username) {
                                                    if ($username["userID"] == $row["userID"]) {
                                                        $date_string = date('jS M Y, G:i A', $row['timestamp']->sec);  // format the date and time
                                                        if (isset($row['_id']) == false) {
                                                            $row['_id'] = "";
                                                        }
                                                        if (isset($username['username']) == false) {
                                                            $username['username'] = "";
                                                        }
                                                        if (isset($row['entity']) == false) {
                                                            $row['entity'] = "";
                                                        }
                                                        if (isset($row['new_value']) == false) {
                                                            $row['new_value'] = "";
                                                        }
                                                        if (isset($row['prev_value']) == false) {
                                                            $row['prev_value'] = "";
                                                        }
                                                        if (isset($row['update_value']) == false) {
                                                            $row['update_value'] = "";
                                                        }
                                                        if (isset($row['attribute']) == false) {
                                                            $row['attribute'] = "";
                                                        }
                                                        if (isset($row['unique_keys']) == false) {
                                                            $row['unique_keys'] = "";
                                                        }
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
                                        } elseif (isset($_POST['Asubmit'])) {

                                            $searchInput4 = trim($_POST['entity']);
                                            $searchInput5 = trim($_POST['new_value']);
                                            $searchInput6 = trim($_POST['prev_value']);
                                            $searchInput7 = trim($_POST['update_type']);
                                            $searchInput8 = trim($_POST['attribute']);
                                            $searchInput9 = trim($_POST['unique_keys']);

                                            $searchQuery1 = $collection->find(array('$and' => array(array("entity" => new MongoRegex("/$searchInput4/i")),
                                                    array("new_value" => new MongoRegex("/$searchInput5/i")), array("prev_value" => new MongoRegex("/$searchInput6/i")),
                                                    array("update_type" => new MongoRegex("/$searchInput7/i")), array("attribute" => new MongoRegex("/$searchInput8/i")),
                                                    array("unique_keys" => new MongoRegex("/$searchInput9/i")))));
                                            $retrieveUsername = $collection1->find(); //admin_acc

                                            foreach ($searchQuery1 as $row) {
                                                foreach ($retrieveUsername as $username) {
                                                    if ($username["userID"] == $row["userID"]) {
                                                        $date_string = date('jS M Y, G:i A', $row['timestamp']->sec);  // format the date and time
                                                        if (isset($row['_id']) == false) {
                                                            $row['_id'] = "";
                                                        }
                                                        if (isset($username['username']) == false) {
                                                            $username['username'] = "";
                                                        }
                                                        if (isset($row['entity']) == false) {
                                                            $row['entity'] = "";
                                                        }
                                                        if (isset($row['new_value']) == false) {
                                                            $row['new_value'] = "";
                                                        }
                                                        if (isset($row['prev_value']) == false) {
                                                            $row['prev_value'] = "";
                                                        }
                                                        if (isset($row['update_value']) == false) {
                                                            $row['update_value'] = "";
                                                        }
                                                        if (isset($row['attribute']) == false) {
                                                            $row['attribute'] = "";
                                                        }
                                                        if (isset($row['unique_keys']) == false) {
                                                            $row['unique_keys'] = "";
                                                        }
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
                                        } else { // RETRIEVE ALL TABLES WITHOUT SEARCHING FUNCTION
                                            $retrieveResults = $collection->find(); //AdminLog_updates_on
                                            $retrieveUsername = $collection1->find(); //admin_acc

                                            foreach ($retrieveResults as $row) {
                                                foreach ($retrieveUsername as $username) {
                                                    if ($username["userID"] == $row["userID"]) {
                                                        $date_string = date('jS M Y, G:i A', $row['timestamp']->sec);  // format the date and time
                                                        if (isset($row['_id']) == false) {
                                                            $row['_id'] = "";
                                                        }
                                                        if (isset($username['username']) == false) {
                                                            $username['username'] = "";
                                                        }
                                                        if (isset($row['entity']) == false) {
                                                            $row['entity'] = "";
                                                        }
                                                        if (isset($row['new_value']) == false) {
                                                            $row['new_value'] = "";
                                                        }
                                                        if (isset($row['prev_value']) == false) {
                                                            $row['prev_value'] = "";
                                                        }
                                                        if (isset($row['update_value']) == false) {
                                                            $row['update_value'] = "";
                                                        }
                                                        if (isset($row['attribute']) == false) {
                                                            $row['attribute'] = "";
                                                        }
                                                        if (isset($row['unique_keys']) == false) {
                                                            $row['unique_keys'] = "";
                                                        }
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
