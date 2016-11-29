<?php

$queryType = $_GET['type'];
//$queryType = 'yearlyStats';

$connection = new Mongo();
$db = $connection->selectDB('InfantWatch');

if($queryType === 'infants'){ //done
    $min = $_GET['min'];
    $max = $_GET['max'];
    $collection = $db->selectCollection('infants');    
    $query = array('birth_year' => array( '$gt' => $min-1, '$lt' => $max+1 ));
    $results = $collection->find($query);
    
    $allData = [];
    foreach($results as $result)
    {
        $allData[] = [$result['birth_year'],$result['value']];
    }
}

else if($queryType === 'distinctYears'){ //done
    $collectionName = $_GET['table'];
//    $collectionName = 'infants';
    if($collectionName === "infants"){
        $documentName = "birth_year";
    }
    else{
        $documentName = "birth_year";
    }
    $collection = $db->selectCollection($collectionName); 
    $allData = $collection->distinct($documentName);
}

else if($queryType === 'distinctColumn'){//done
//    $tableName = $_GET['table'];
//    $tableColumn = $_GET['column'];
    $collectionName = $_GET['table'];
    $documentName = $_GET['column'];
    $collection = $db->selectCollection($collectionName); 
    $allData = $collection->distinct($documentName);
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
//    $min = $_GET['min'];
//    $max = $_GET['max'];
    $min = 2012;
    $max = 2015;
//    $where = $_GET['where'];
//    $collectionName = $_GET['tableName'];
    $collectionName = "Mother_births_by";
    $collection = $db->selectCollection($collectionName); 
    $query = array(
        array(
            '$match' => array('race' => array('$in' => array('CHINESE', 'INDIANS')))
        ),
        array(
            '$group' => array(
                '_id' => array('year' => '$birth_year'),
                'total' => array('$sum' => '$live_births')
            )
        ),
    );

    $results = $collection->aggregate($query);
    $allData = [];
//    var_dump($results);
    echo "sdsds";
    foreach($results['result'] as $result)
    {
        $allData[] = [$result['_id']['year'],$result['total']];
//        var_dump($result);
    }

}
//var_dump($allData);
echo json_encode($allData);
