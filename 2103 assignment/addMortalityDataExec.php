<?php

require_once('Dbconnect.php');
require_once('grabID.php');

$birth_year = $_POST['birth_year'];
$ethnicity = $_POST['ethnicity'];
$death_toll = $_POST['death_toll'];

$new_val = array($ethnicity, $death_toll);
$attribute = array('ethnicity', 'death_toll');
$all_of_new_val = array();
$all_of_attribute = array();

$count = count($new_val);
for ($x = 0; $x < $count; $x++) {
    array_push($all_of_new_val, $new_val[$x]);
    array_push($all_of_attribute, $attribute[$x]);
}

$check = "select * from Mortality_under_a_year where birth_year = '$birth_year'and ethnicity = '$ethnicity'";
$result = sqlsrv_query($conn, $check);

$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

if ($row) {
    echo 'Record already exist. Update instead...';
} else {
    $check_PK = "select * from infants where birth_year = '$birth_year'"; //weak entity check
    $check_result = sqlsrv_query($conn, $check_PK);
    $row_infants = sqlsrv_fetch_array($check_result, SQLSRV_FETCH_ASSOC);
    if ($row_infants) {
        if ($user['accountType'] == 'Admin') {//Admin
            echo 'Logged in as Admin';
            $insert_mortality = "insert into Mortality_under_a_year (birth_year, ethnicity, death_toll) values (?, ?, ?)";
            $insert_result = sqlsrv_query($conn, $insert_mortality, array($birth_year, $ethnicity, $death_toll));
            echo 'Add successful! <br>';

            //Update to admin log            
            $update_log = "insert into AdminLog_updates_on (userID, birth_year, entity, new_value, update_type, attribute)
            values(?, ?, ?, ?, ?, ?)";
            $log_result = sqlsrv_query($conn, $update_log, array($user['userID'], $birth_year, 'Mortality', implode(", ", $all_of_new_val), 'insert', implode(", ", $all_of_attribute)));
            echo 'Update to Admin log successful!';
            
        } else {//Assist
            echo 'Logged in as Assistant <br>';
            //update to assist log
            $update_log = "insert into AssistantLog_tentative_updates_on (userID, birth_year, entity, new_value, update_type, attribute)
            values(?, ?, ?, ?, ?, ?)";
            $log_result = sqlsrv_query($conn, $update_log, array($user['userID'], $birth_year, 'Mortality', implode(", ", $all_of_new_val), 'insert', implode(", ", $all_of_attribute)));
            echo 'Update to Assistant log successful!';
        }
    }
    else{
        echo "<br>Add infant of '$birth_year' first...";
    }
}
header('View.php');
?>