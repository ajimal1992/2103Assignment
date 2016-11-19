<?php
require_once('authenticate.php'); 
//session_start();
//$_SESSION['username'] = 'ajimal';

//require_once('authenticate.php');
$username = $_SESSION['username'];
//SELECT userID,  'Admin'  as accountType FROM admin_account 
//WHERE  pwd='$pw' AND username='$name'
//UNION 
//SELECT userID, 'Assistant' as accountType FROM asst_admin_account 
//WHERE  pwd='$pw' AND username='$name

$query = "SELECT userID, username,  'Admin'  as accountType FROM admin_acc 
          WHERE username='$username' 
          UNION 
          SELECT userID, username, 'Assistant' as accountType FROM assistant_admin_acc 
          WHERE username='$username' ";

$result = sqlsrv_query($conn, $query);
//if(!$result){
//
//    die(print_r("query returned empty rows", true));
//}
$user = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

//if($row['accountType'] == 'Assistant'){
//    echo $row['username'] . " is a " . $row['accountType'] . $row['userID'];
//}
//else if($row['accountType'] == 'Admin'){
//    echo $row['username'] . " is a " . $row['accountType'] . $row['userID'];
//}
//else{
//    echo "NO USER EXISTS!!!!!";
//}

?>

