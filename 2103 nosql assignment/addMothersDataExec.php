<?php

require_once('Dbconnect.php');
$userID = 1;

$birth_year = $_POST['birth_year'];
$child_gender = $_POST['child_gender'];
$race = $_POST['race'];
$mth = $_POST['mth'];
$age_group = $_POST['age_group'];
$live_births = $_POST['live_births'];

$new_val = array($race, (int)$mth, $child_gender, $age_group, (int)$live_births);
$attribute = array('race', 'mth', 'child_gender', 'age_group', 'live_births');
$all_of_new_val = array();
$all_of_attribute = array();

$count = count($new_val);
for ($x = 0; $x < $count; $x++) {
    array_push($all_of_new_val, $new_val[$x]);
    array_push($all_of_attribute, $attribute[$x]);
}
$collection_infants = $db->infants;
$collection_weak = $collection_infants->find(array('year' => (int) $birth_year));

$collection_mother = $db->Mother_births_by;
$collection_exist = $collection_mother->find(array('birth_year' => (int) $birth_year, 'child_gender' => $child_gender, 'race' => $race,
    'mth' => (int)$mth, 'age_group' => $age_group));


if ($collection_weak->count() <= 0) {
    echo '<br> Add infant first.';
} else {
    if ($collection_exist->count() > 0) {
        echo '<br> Record already exists in DB... Update instead..';
    } else {
        if ($userID == 1) {
            $insert_mother = array(
                "birth_year" => (int)$birth_year,
                "race" => $race,
                "mth" => (int)$mth,
                "child_gender" => $child_gender,
                "age_group" => $age_group,
                "live_births" => (int)$live_births
            );
            $collection_mother->insert($insert_mother);
            echo 'Insert to Mother_births_by successful! <br>';

            //UPDATE TO LOG  
            $insert_admin = array(
                "userID" => $userID,
                "birth_year" => (int)$birth_year,
                "entity" => "Mother_births_by",
                "new_value" => implode(", ", $all_of_new_val),
                "update_type" => "insert",
                "attribute" => implode(", ", $all_of_attribute),
                "timestamp" => new MongoDate()
            );

            $collection_AdminLog_updates_on = $db->AdminLog_updates_on;
            $collection_AdminLog_updates_on->insert($insert_admin);
            echo 'Insert to Admin Log successful! <br>';
        } else {//assistant admin
            $insert_assist = array(
                "userID" => $userID,
                "birth_year" => (int)$birth_year,
                "entity" => "Mother_births_by",
                "new_value" => implode(", ", $all_of_new_val),
                "update_type" => "update",
                "attribute" => implode(", ", $all_of_attribute),
                "timestamp" => new MongoDate()
            );

            $collection_Assist_updates_on = $db->AssistantLog_tentative_updates_on;
            $collection_Assist_updates_on->insert($insert_assist);
            echo 'Insert to Assisstant Log successful! <br>';
        }
    }
}