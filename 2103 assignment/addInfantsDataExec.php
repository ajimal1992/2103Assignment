<?php

require_once('Dbconnect.php');
require_once('grabID.php');

$birth_year = $_POST['birth_year'];
$total = $_POST['total'];

$check = "select * from infants where birth_year = '$birth_year'";
$result = sqlsrv_query($conn, $check);

$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

if ($row) {
    echo 'Record already exist. Update instead...';
} else {
    if ($user['accountType'] == 'Admin') {
        echo 'Logged in as Admin';
        $insert_infants = "insert into infants (birth_year, total) values (?, ?)";
        $insert_result = sqlsrv_query($conn, $insert_infants, array($birth_year, $total));
        echo 'Add successful! <br>';

        //Update admin log
        $update_log = "insert into AdminLog_updates_on (userID, birth_year, entity, new_value, update_type, attribute)
                values(?, ?, ?, ?, ?, ?, ?)";
        $log_result = sqlsrv_query($conn, $update_log, array($user['userID'], $birth_year, 'infants', $total, 'insert', 'total'));
        echo 'Update to Admin log successful!';
    }//end if admin
    else {
        echo 'Logged in as Assistant <br>';
        echo 'Only Admin can insert infant...';
    }//end if assistant
}
header('View.php');
?>