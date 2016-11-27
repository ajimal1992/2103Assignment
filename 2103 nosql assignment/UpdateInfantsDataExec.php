<?php

require_once('Dbconnect.php');

$userID = 1;

$prev_value = $_POST['prev_value'];
$value = $_POST['value'];
$year = $_POST['year'];

if($userID == 1){
    $tempdoc = array(
    "year" => (int)$year,
    "value" => (int)$value
    );

    $collection = $db->infants;
    $collection->update(array("year" => (int)$year),
            $tempdoc);
    
    $insert_admin = array(
        "userID" => $userID,
        "year" => (int)$year,
        "entity" => "infants",
        "new_value" => $value,
        "prev_value" => $prev_value,
        "update_type" => "update",
        "attribute" => "value"
    );
    
    $collection_AdminLog_updates_on = $db->AdminLog_updates_on;
    $collection_AdminLog_updates_on->insert($insert_admin);
}
else{
    $insert_assit = array(
        "userID" => $userID,
        "year" => (int)$year,
        "entity" => "infants",
        "new_value" => $value,
        "prev_value" => $prev_value,
        "update_type" => "update",
        "attribute" => "value",
    );
    
    $collection_AdminLog_updates_on = $db->AssistantLog_tentative_updates_on;
    $collection_AdminLog_updates_on->insert($insert_assit);
}
