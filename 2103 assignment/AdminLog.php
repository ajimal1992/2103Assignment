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
        <title>Admin Logs</title>

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
                            <h1 class="page-header">Admin Logs</h1>
                            <form method="post">
                                <input type="text" name='searchInput' id="myInput"  placeholder="Search" autofocus/>
                                <button class="btn btn-info" name = "submit" type = "submit" value = "submit">Submit</button>
                            </form>
                            <br/>
                            <p> Number of records: <u>
                                <?php
                                $sql2 = "SELECT COUNT(*) AS records FROM AdminLog_updates_on al";

                                $result2 = sqlsrv_query($conn, $sql2);
                                if ($result2 === false) {
                                    die(print_r(sqlsrv_errors(), true));
                                }

                                while ($row = sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC)) {
                                    echo $row['records'];
                                }
                                    ?>
                                </u></p>
                                <div class="table-responsive">
                                    <table id="myTable">

                                        <tr>
                                            <th>Log No.</th>
                                            <th>Name</th>
                                            <th>Birth Year</th>
                                            <th>Entity</th>
                                            <th>New Value</th>
                                            <th>Prev Value</th>
                                            <th>Update type</th>
                                            <th>Date & Time Stamp</th>            
                                        </tr>

                                        <?php
                                        // search function
                                        if (isset($_POST['submit'])) {
                                            $searchInput = trim($_POST['searchInput']);
                                            $sql1 = "SELECT al.update_ID, aa.username, al.birth_year, al.entity, al.new_value, "
                                                    . "al.prev_value, al.update_type, al.timestamp FROM AdminLog_updates_on al, admin_acc aa "
                                                    . "WHERE aa.userID = al.userID AND (al.update_ID LIKE '%$searchInput%' OR "
                                                    . "aa.username LIKE '%$searchInput%' OR al.birth_year LIKE '%$searchInput%' OR "
                                                    . "al.entity LIKE '%$searchInput%' OR al.new_value LIKE '%$searchInput%' OR "
                                                    . "al.prev_value LIKE '%$searchInput%' OR al.update_type LIKE '%$searchInput%' OR al.timestamp LIKE '%$searchInput%')";

                                            $result1 = sqlsrv_query($conn, $sql1);
                                            if ($result1 === false) {
                                                die(print_r(sqlsrv_errors(), true));
                                            }

                                            while ($row = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC)) {
                                                $date_string = date_format($row['timestamp'], 'jS F Y, G:i A');  // format the date and time
                                                echo '<tr>';
                                                echo '<td>' . $row['update_ID'] . '</td>';
                                                echo '<td>' . $row['username'] . '</td>';
                                                echo '<td>' . $row['birth_year'] . '</td>';
                                                echo '<td>' . $row['entity'] . '</td>';
                                                echo '<td>' . $row['new_value'] . '</td>';
                                                echo '<td>' . $row['prev_value'] . '</td>';
                                                echo '<td>' . $row['update_type'] . '</td>';
                                                echo '<td>' . $date_string . '</td>';
                                                echo '</tr>';
                                            }
                                        } else {
                                            $sql = "SELECT al.update_ID, aa.username, al.birth_year, al.entity, al.new_value, "
                                                    . "al.prev_value, al.update_type, al.timestamp FROM AdminLog_updates_on al, admin_acc aa "
                                                    . "WHERE aa.userID = al.userID";
                                            $result = sqlsrv_query($conn, $sql);
                                            if ($result === false) {
                                                die(print_r(sqlsrv_errors(), true));
                                            }

                                            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                                $date_string = date_format($row['timestamp'], 'jS F Y, G:i A');  // format the date and time
                                                echo '<tr>';
                                                echo '<td>' . $row['update_ID'] . '</td>';
                                                echo '<td>' . $row['username'] . '</td>';
                                                echo '<td>' . $row['birth_year'] . '</td>';
                                                echo '<td>' . $row['entity'] . '</td>';
                                                echo '<td>' . $row['new_value'] . '</td>';
                                                echo '<td>' . $row['prev_value'] . '</td>';
                                                echo '<td>' . $row['update_type'] . '</td>';
                                                echo '<td>' . $date_string . '</td>';
                                                echo '</tr>';
                                            }
                                        }
                                        ?>
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
