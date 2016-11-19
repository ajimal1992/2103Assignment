<?php
require_once('Dbconnect.php'); 
require_once('grabID.php');

$birth_year = $_POST['birth_year'];
$total = $_POST['total'];

$prev_total = $_POST['prev_total'];

if($user['accountType'] == 'Admin'){
    echo 'Logged in as Admin';

    $sql = "update infants set total = ?
            where birth_year = ?";

    $result = sqlsrv_query($conn, $sql, array($total, $birth_year));

    if ($result) {
        echo 'Update success!';
        if($total != $prev_total){
                $update_log = "insert into AdminLog_updates_on (userID, birth_year, entity, new_value, prev_value, update_type, attribute)
                values(?, ?, ?, ?, ?, ?, ?)";
                $log_result = sqlsrv_query($conn, $update_log, array($user['userID'], $birth_year, 'infants', $total, $prev_total, 'update', 'total'));
            
                if($log_result === false){
                    die(print_r(sqlsrv_errors(), true));
                }
        }
        header( "refresh:3; url=View.php" );
    }
    else{
         echo "No duplicates key values are allowed... . <br>";
        die(print_r(sqlsrv_errors(), true));
    }
}
else{
    echo 'Logged in as Assistant';
    if($total != $prev_total){
                $update_log = "insert into AssistantLog_tentative_updates_on (userID, birth_year, entity, new_value, prev_value, update_type, attribute)
                values(?, ?, ?, ?, ?, ?, ?)";
                $log_result = sqlsrv_query($conn, $update_log, array($user['userID'], $birth_year, 'infants', $total, $prev_total, 'update', 'total'));
            }
        header( "refresh:3; url=View.php" );    
}
        
?>

