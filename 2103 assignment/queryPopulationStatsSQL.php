<?php

$queryType = $_GET['type'];

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

if($queryType === 'infants'){
    $min = $_GET['min'];
    $max = $_GET['max'];
    $sql = "SELECT birth_year, total FROM infants WHERE birth_year>= $min AND birth_year<= $max order by birth_year";
    $query = sqlsrv_query( $conn, $sql );
    if( $query === false) {
        die( print_r( sqlsrv_errors(), true) );
    }
    $allData = [];
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_NUMERIC) ) {
          $allData[] = $row;
    }
}

else if($queryType === 'distinctYears'){
    $tableName = $_GET['table'];
    $sql = "SELECT DISTINCT birth_year FROM $tableName order by birth_year";
    $query = sqlsrv_query( $conn, $sql );
    if( $query === false) {
        die( print_r( sqlsrv_errors(), true) );
    }
    $allData = [];
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_NUMERIC) ) {
          $allData[] = $row;
    }
}

else if($queryType === 'distinctColumn'){
    $tableName = $_GET['table'];
    $tableColumn = $_GET['column'];
    $sql = "SELECT DISTINCT $tableColumn FROM $tableName order by $tableColumn";
    $query = sqlsrv_query( $conn, $sql );
    if( $query === false) {
        die( print_r( sqlsrv_errors(), true) );
    }
    $allData = [];
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_NUMERIC) ) {
          $allData[] = $row;
    }
}

//else if($queryType === 'motherBirthsBy'){
//
//    $min = $_GET['min'];
//    $max = $_GET['max'];
//    $where = $_GET['where'];
//    $sql = "SELECT birth_year, SUM(live_births) FROM Mother_births_by WHERE birth_year>= $min AND birth_year<= $max AND $where GROUP BY birth_year order by birth_year";
//    $query = sqlsrv_query( $conn, $sql );
//    if( $query === false) {
//        die( print_r( sqlsrv_errors(), true) );
//    }
//    $allData = [];
//    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_NUMERIC) ) {
//          $allData[] = $row;
//    }
//}

else if($queryType === "yearlyStats"){
    $min = $_GET['min'];
    $max = $_GET['max'];
    $where = $_GET['where'];
    $tablename = $_GET['tableName'];
    $sql = "SELECT birth_year, SUM(live_births) FROM $tablename WHERE birth_year>= $min AND birth_year<= $max AND $where GROUP BY birth_year order by birth_year";
    $query = sqlsrv_query( $conn, $sql );
    if( $query === false) {
        die( print_r( sqlsrv_errors(), true) );
    }
    $allData = [];
    while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_NUMERIC) ) {
          $allData[] = $row;
    }
}
//var_dump($allData);
echo json_encode($allData);