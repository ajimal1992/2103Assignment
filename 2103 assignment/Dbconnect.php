<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// DB connection info
$connectionInfo = array(
                   	"UID" => "team9@infantwatch",
                   	"pwd" => "1q2w3e4r%",
                   	"Database" => "InfantWatch",
                   	"LoginTimeout" => 30,
                   	"Encrypt" => 1
              	);
$serverName = "tcp:infantwatch.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
if( $conn === false ) {
	die( print_r( sqlsrv_errors(), true));
}
?>

