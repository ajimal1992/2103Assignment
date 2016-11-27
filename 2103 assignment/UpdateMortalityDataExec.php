<?php
require_once('Dbconnect.php'); 
require_once('grabID.php');

$birth_year = $_POST['birth_year'];
$ethnicity = $_POST['ethnicity'];
$death_toll = $_POST['death_toll'];

$prev_death_toll = $_POST['prev_death_toll'];
$prev_ethnicity = $_POST['prev_ethnicity'];

$new_val = array($ethnicity, $death_toll);
$prev_val = array($prev_ethnicity, $prev_death_toll);
$attribute = array('ethnicity', 'death_toll');
$all_of_new_val = array();
$all_of_prev_val = array();
$all_of_attribute = array();

$count = count($new_val);
for($x = 0; $x < $count; $x++){
    if($new_val[$x] != $prev_val[$x]){
        array_push($all_of_new_val, $new_val[$x]);
        array_push($all_of_prev_val, $prev_val[$x]);
        array_push($all_of_attribute, $attribute[$x]);
    }
}

if($user['accountType'] == 'Admin'){
    echo 'Logged in as Admin';

    $sql = "update Mortality_under_a_year set death_toll = ? where birth_year = ? and ethnicity = ?";
    $result = sqlsrv_query($conn, $sql, array($death_toll, $birth_year, $ethnicity));
    
    if ($result) {
        echo 'Update success!';
        
        $update_log = "insert into AdminLog_updates_on (userID, birth_year, entity, new_value, prev_value, update_type, attribute, unique_keys)
        values(?, ?, ?, ?, ?, ?, ?, ?)";
        $log_result = sqlsrv_query($conn, $update_log, array($user['userID'], $birth_year, 'Mortality', implode(", ", $all_of_new_val), implode(", ", $all_of_prev_val), 'update', implode(", ", $all_of_attribute), $ethnicity));
        if (!$log_result) {
            die(print_r(sqlsrv_errors(), true));            
        }
    }
    else{
        echo "No duplicates key values are allowed... . <br>";
        die(print_r(sqlsrv_errors(), true));
    }
}
else{
    echo 'Logged in as Assistant';  
    $update_log = "insert into AssistantLog_tentative_updates_on (userID, birth_year, entity, new_value, prev_value, update_type, attribute, unique_keys)
    values(?, ?, ?, ?, ?, ?, ?, ?)";
    $log_result = sqlsrv_query($conn, $update_log, array($user['userID'], $birth_year, 'Mortality', implode(", ", $all_of_new_val), implode(", ", $all_of_prev_val), 'update', implode(", ", $all_of_attribute), $ethnicity));    
}
header( "refresh:3; url=View.php" );
?>
