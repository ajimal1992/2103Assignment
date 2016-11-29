<?php

require_once('authenticate.php');
require_once('Dbconnect.php');
$userType = $_SESSION['userType'];
$userID = $_SESSION['userID'];

$inforID = $_POST['_id'];
$prev_value = $_POST['prev_value'];
$value = $_POST['value'];
$year = $_POST['year'];

if($userType == "Admin"){
    $tempdoc = array(
    "birth_year" => (int)$year,
    "value" => (int)$value
    );

    $collection = $db->infants;
    $collection->update(array("birth_year" => (int)$year),
            $tempdoc);
    
    $insert_admin = array(
        "userID" => $userID,
        "birth_year" => (int)$year,
        "entity" => "infants",
        "new_value" => (int)$value,
        "prev_value" => (int)$prev_value,
        "update_type" => "update",
        "attribute" => "value",
        "unique_keys" => $inforID,
        "timestamp" => new MongoDate()
    );
    
    $collection_AdminLog_updates_on = $db->AdminLog_updates_on;
    $collection_AdminLog_updates_on->insert($insert_admin);
}
else{
    $insert_assit = array(
        "userID" => $userID,
        "birth_year" => (int)$year,
        "entity" => "infants",
        "new_value" => (int)$value,
        "prev_value" => (int)$prev_value,
        "update_type" => "update",
        "attribute" => "value",
        "unique_keys" => $inforID,
        "timestamp" => new MongoDate()
    );
    
    $collection_AdminLog_updates_on = $db->AssistantLog_tentative_updates_on;
    $collection_AdminLog_updates_on->insert($insert_assit);
}
