<?php

require_once('authenticate.php');
require_once('Dbconnect.php');
$userType = $_SESSION['userType'];
$userID = $_SESSION['userID'];

$birth_year = $_POST['birth_year'];
$ethnicity = $_POST['ethnicity'];
$death_toll = $_POST['death_toll'];
$prev_death_toll = $_POST['prev_death_toll'];

$collection_mortality = $db->Mortality_under_a_year;
$mort = $collection_mortality->findOne(array("birth_year" => (int)$birth_year, "ethnicity" => $ethnicity));
$pass_unique = array($ethnicity, (string) $mort['_id']);

if($userType == "Admin"){
    $tempdoc = array(
    "birth_year" => (int)$birth_year,
    "ethnicity" => $ethnicity,
    "death_toll" => (int)$death_toll
    );
    
    $collection_mortality->update(array("birth_year" => (int)$birth_year, "ethnicity" => $ethnicity),
            $tempdoc);
    
    $insert_admin = array(
        "userID" => $userID,
        "birth_year" => (int)$birth_year,
        "entity" => "Mortality_under_a_year",
        "new_value" => (int)$death_toll,
        "prev_value" => (int)$prev_death_toll,
        "update_type" => "update",
        "attribute" => "death_toll",
        "unique_keys" => (string)$mort['_id'],
        "timestamp" => new MongoDate()
    );
    
    $collection_AdminLog_updates_on = $db->AdminLog_updates_on;
    $collection_AdminLog_updates_on->insert($insert_admin);
}
else{
    $insert_assit = array(
        "userID" => $userID,
        "birth_year" => (int)$birth_year,
        "entity" => "Mortality_under_a_year",
        "new_value" => (int)$death_toll,
        "prev_value" => (int)$prev_death_toll,
        "update_type" => "update",
        "attribute" => "death_toll",
        "unique_keys" => (string)$mort['_id'],
        "timestamp" => new MongoDate()
    );
    
    $collection_AdminLog_updates_on = $db->AssistantLog_tentative_updates_on;
    $collection_AdminLog_updates_on->insert($insert_assit);
}
