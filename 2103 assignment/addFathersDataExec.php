<?php

require_once('Dbconnect.php');
require_once('grabID.php');

$birth_year = $_POST['birth_year'];
$child_gender = $_POST['child_gender'];
$race = $_POST['race'];
$mth = $_POST['mth'];
$live_births = $_POST['live_births'];

$new_val = array($race, $mth, $child_gender, $live_births);
$attribute = array('race', 'mth', 'child_gender', 'live_births');
$all_of_new_val = array();
$all_of_attribute = array();

$count = count($new_val);
for ($x = 0; $x < $count; $x++) {
    array_push($all_of_new_val, $new_val[$x]);
    array_push($all_of_attribute, $attribute[$x]);
}

$check = "select * from Father_births_by 
        where birth_year = '$birth_year' and child_gender ='$child_gender' and race = '$race' and mth = '$mth'";

$result = sqlsrv_query($conn, $check);

$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

if ($row) {
    echo 'Record already exist. Update instead... <br>';
}// end if
else {
    $check_PK = "select * from infants where birth_year = '$birth_year'";
    $check_result = sqlsrv_query($conn, $check_PK);
    $row_infants = sqlsrv_fetch_array($check_result, SQLSRV_FETCH_ASSOC);
    if ($row_infants) {
        if ($user['accountType'] == 'Admin') {
            echo 'Logged in as Admin.';
            $update_live_births = "insert into Father_births_by (birth_year, child_gender, race, mth, live_births) values
                (?, ?, ?, ?, ?)";
            $vals = array($birth_year, $child_gender, $race, $mth, $live_births);
            $result_update = sqlsrv_query($conn, $update_live_births, $vals);

            //UPDATE TO ADMIN LOG    
            $update_log = "insert into AdminLog_updates_on (userID, birth_year, entity, new_value, update_type, attribute)
            values(?, ?, ?, ?, ?, ?)";
            $log_result = sqlsrv_query($conn, $update_log, array($user['userID'], $birth_year, 'Father_births_by', implode(", ", $all_of_new_val), 'insert', implode(", ", $all_of_attribute)));

            echo 'update to log successful!';
            echo 'Add successful!';
        }// end if admin
        else {
            echo 'Logged in as Assistant.';
            //update to assist log
            $update_log = "insert into AssistantLog_tentative_updates_on (userID, birth_year, entity, new_value, update_type, attribute)
            values(?, ?, ?, ?, ?, ?)";
            $log_result = sqlsrv_query($conn, $update_log, array($user['userID'], $birth_year, 'Father_births_by', implode(", ", $all_of_new_val), 'insert', implode(", ", $all_of_attribute)));
            
            echo 'update to log successful!';
            echo 'Add successful!';
        }//end else assistant
    }// check if pk of infants is added
    else {
        echo "There is no infant of '$birth_year'...";
    }
}//end else

header('View.php');
?>
