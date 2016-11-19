<?php
require_once('Dbconnect.php'); 
require_once('grabID.php');

$inforID = $_POST['inforID'];
$birth_year = $_POST['birth_year'];
$race = $_POST['race'];
$mth = $_POST['mth'];
$child_gender = $_POST['child_gender'];
$age_group = $_POST['age_group'];
$live_births = $_POST['live_births'];

$prev_birth_year = $_POST['prev_birth_year'];
$prev_race = $_POST['prev_race'];
$prev_mth = $_POST['prev_mth'];
$prev_child_gender = $_POST['prev_child_gender'];
$prev_age_group = $_POST['prev_age_group'];
$prev_live_births = $_POST['prev_live_births'];

//if user is admin
if($user['accountType'] == 'Admin'){
    echo 'Logged in as Admin';
    
    $sql = "UPDATE Mother_births_by
        SET birth_year = ?, mth = ?, child_gender = ?, age_group = ?, live_births = ?   
        WHERE inforID = ?";

    $result = sqlsrv_query($conn, $sql, array($birth_year, $mth, $child_gender, $age_group, $live_births, $inforID));
    
    $new_val = array($race, $mth, $child_gender, $age_group, $live_births);
    $prev_val = array($prev_race, $prev_mth, $prev_child_gender, $prev_age_group, $prev_live_births);
    $attribute = array('race', 'mth', 'child_gender', 'age_group', 'live_births');
    $all_of_new_val = array();
    $all_of_prev_val = array();
    $all_of_attribute = array();


    if ($result) {
        echo 'Update success!';        
        
        $count = count($new_val);
        for($x = 0; $x < $count; $x++){
            if($new_val[$x] != $prev_val[$x]){
                array_push($all_of_new_val, $new_val[$x]);
                array_push($all_of_prev_val, $prev_val[$x]);
                array_push($all_of_attribute, $attribute[$x]);
            }
        }
        $update_log = "insert into AdminLog_updates_on (userID, birth_year, entity, new_value, prev_value, update_type, attribute, unique_keys)
        values(?, ?, ?, ?, ?, ?, ?, ?)";
        $log_result = sqlsrv_query($conn, $update_log, array($user['userID'], $prev_birth_year, 'Mother_births_by', 
            implode(", ", $all_of_new_val), implode(", ", $all_of_prev_val), 'update', implode(", ", $all_of_attribute), $inforID));
    //    header( "refresh:3; url=View.php" );
    }
    else{
        echo "No duplicates key values are allowed... . <br>";
        die(print_r(sqlsrv_errors(), true));
    }
}
else{
    echo 'Logged in as Assistant';

        $count = count($new_val);
        for($x = 0; $x < $count; $x++){
            if($new_val[$x] != $prev_val[$x]){
                array_push($all_of_new_val, $new_val[$x]);
                array_push($all_of_prev_val, $prev_val[$x]);
                array_push($all_of_attribute, $attribute[$x]);
            }
        }
        $update_log = "insert into AssistantLog_tentative_updates_on (userID, birth_year, entity, new_value, prev_value, update_type, attribute, unique_keys)
        values(?, ?, ?, ?, ?, ?, ?, ?)";
        $log_result = sqlsrv_query($conn, $update_log, array($user['userID'], $prev_birth_year, 'Mother_births_by', 
            implode(", ", $all_of_new_val), implode(", ", $all_of_prev_val), 'update', implode(", ", $all_of_attribute), $inforID));
}

header('View.php');
?>

