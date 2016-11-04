<?php
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

//$host = "infantwatch.database.windows.net";
//$user = "team9";
//$pwd = "1q2w3e4r%";
//$db = "InfantWatch";
//
//// Connecting to database
//try {
//    $conn = new PDO( "sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
//    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//}
//catch(Exception $e){
//    die(var_dump($e));
//}

?>
