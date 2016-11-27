<?php

require_once('Dbconnect.php');
$userID = 1;

$birth_year = $_POST['birth_year'];
$ethnicity = $_POST['ethnicity'];
$death_toll = $_POST['death_toll'];

$new_val = array($ethnicity, $death_toll);
$attribute = array('ethnicity', 'death_toll');
$all_of_new_val = array();
$all_of_attribute = array();

$count = count($new_val);
for ($x = 0; $x < $count; $x++) {
    array_push($all_of_new_val, $new_val[$x]);
    array_push($all_of_attribute, $attribute[$x]);
}

$collection_infants = $db->infants;
$collection_weak = $collection_infants->find(array('year' => (int) $birth_year));

$collection_mortality = $db->Mortality_under_a_year;
$collection_exist = $collection_mortality->find(array('birth_year' => (int) $birth_year, 'ethnicity' => $ethnicity));

if ($collection_weak->count() <= 0) {
    echo '<br> Add infant first.';
} else {
    if ($collection_exist->count() > 0) {
        echo '<br> Record already exists in DB... Update instead..<br>';
    } else {
        if ($userID == 1) {
            $insert_mortality = array(
                "birth_year" => (int)$birth_year,
                "ethnicity" => $ethnicity,
                "death_toll" => $death_toll
            );

            $collection_mortality->insert($insert_mortality);
            echo 'Add to Mortality_under_a_year successful! <br>';

            //UPDATE TO LOG  
            $insert_admin = array(
                "userID" => $userID,
                "birth_year" => (int)$birth_year,
                "entity" => "Mortality_under_a_year",
                "new_value" => implode(", ", $all_of_new_val),
                "update_type" => "insert",
                "attribute" => implode(", ", $all_of_attribute)
            );

            $collection_AdminLog_updates_on = $db->AdminLog_updates_on;
            $collection_AdminLog_updates_on->insert($insert_admin);
            echo 'Insert to Admin Log successful! <br>';
        }
        else{//assist
            //UPDATE TO LOG  
            $insert_assist = array(
                "userID" => $userID,
                "birth_year" => (int)$birth_year,
                "entity" => "Mortality_under_a_year",
                "new_value" => implode(", ", $all_of_new_val),
                "update_type" => "insert",
                "attribute" => implode(", ", $all_of_attribute)
            );

            $collection_Assist_updates_on = $db->AdminLog_updates_on;
            $collection_Assist_updates_on->insert($insert_assist);
            echo 'Insert to Admin Log successful! <br>';
        }
    }
}//else