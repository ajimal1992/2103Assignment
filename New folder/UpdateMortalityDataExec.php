<?php

require_once('Dbconnect.php');
$userID = 1;

$birth_year = $_POST['birth_year'];
$ethnicity = $_POST['ethnicity'];
$death_toll = $_POST['death_toll'];
$prev_death_toll = $_POST['prev_death_toll'];

if($userID == 1){
    $tempdoc = array(
    "birth_year" => (int)$birth_year,
    "ethnicity" => $ethnicity,
    "death_toll" => $death_toll
    );
    
    $collection_mortality = $db->Mortality_under_a_year;
    $collection_mortality->update(array("birth_year" => (int)$birth_year, "ethnicity" => $ethnicity),
            $tempdoc);
    
    $insert_admin = array(
        "userID" => $userID,
        "birth_year" => $birth_year,
        "entity" => "Mortality_under_a_year",
        "new_value" => $death_toll,
        "prev_value" => $prev_death_toll,
        "update_type" => "update",
        "attribute" => "death_toll",
        "unique_keys" => $ethnicity
    );
    
    $collection_AdminLog_updates_on = $db->AdminLog_updates_on;
    $collection_AdminLog_updates_on->insert($insert_admin);
}
else{
    $insert_assit = array(
        "userID" => $userID,
        "birth_year" => $birth_year,
        "entity" => "Mortality_under_a_year",
        "new_value" => $death_toll,
        "prev_value" => $prev_death_toll,
        "update_type" => "update",
        "attribute" => "death_toll",
        "unique_keys" => $ethnicity
    );
    
    $collection_AdminLog_updates_on = $db->AssistantLog_tentative_updates_on;
    $collection_AdminLog_updates_on->insert($insert_assit);
}
