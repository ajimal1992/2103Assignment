<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

require_once 'Dbconnect.php';
$username = $_REQUEST['username'];
$password  = $_REQUEST['pwd'];
$sql = "SELECT * FROM admin_acc WHERE username='$username' AND pwd='$password'";
$sqli = "SELECT * FROM assistant_admin_acc WHERE username='$username' AND pwd='$password'";
$query = sqlsrv_query( $conn, $sql );
$queryi = sqlsrv_query( $conn, $sqli );

if( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
    $_SESSION['valid_user'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['userType'] = 'Admin';
    header('Location: AdminLog.php');
  	
}elseif( $row = sqlsrv_fetch_array( $queryi, SQLSRV_FETCH_ASSOC) )
{
    $_SESSION['valid_user'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['userType'] = 'Assistant';
    header('Location: AssistantLog.php');
    
}
else{
    //wrong password&username
    header('Location: login.php?err=1');
}
?>