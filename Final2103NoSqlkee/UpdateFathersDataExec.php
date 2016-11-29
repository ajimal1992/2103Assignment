<?php
require_once('authenticate.php');
require_once('Dbconnect.php');
$userType = $_SESSION['userType'];
$userID = $_SESSION['userID'];

$inforID = $_POST['_id'];
$birth_year = $_POST['birth_year'];
$child_gender = $_POST['child_gender'];
$race = $_POST['race'];
$mth = $_POST['mth'];
$live_births = $_POST['live_births'];

$prev_race = $_POST['prev_race'];
$prev_mth = $_POST['prev_mth'];
$prev_child_gender = $_POST['prev_child_gender'];
$prev_live_births = $_POST['prev_live_births'];

$new_val = array($race, (int)$mth, $child_gender, (int)$live_births);
$prev_val = array($prev_race, (int)$prev_mth, $prev_child_gender, (int)$prev_live_births);
$attribute = array('race', 'mth', 'child_gender', 'live_births');
$all_of_new_val = array();
$all_of_prev_val = array();
$all_of_attribute = array();

$count = count($new_val);
for ($x = 0; $x < $count; $x++) {
    if ($new_val[$x] != $prev_val[$x]) {
        array_push($all_of_new_val, $new_val[$x]);
        array_push($all_of_prev_val, $prev_val[$x]);
        array_push($all_of_attribute, $attribute[$x]);
    }
}

$collection_father = $db->Father_births_by;
$collection_exist = $collection_father->find(array('birth_year' => (int) $birth_year, 'child_gender' => $child_gender, 'race' => $race,
    'mth' => (int)$mth));

if ($collection_exist->count() > 0){//dont allow repeated birth_year/ race/ mth/ child_gender
        if ($userType == "Admin") {
            $update_father = array(
                "birth_year" => (int)$birth_year,
                "race" => $race,
                "mth" => (int)$mth,
                "child_gender" => $child_gender,
                "live_births" => (int)$live_births
            );
            $collection_father = $db->Father_births_by;
            $collection_father->update(array("_id" => new MongoId($inforID)), $update_father);

            //UPDATE TO LOG  
            $insert_admin = array(
                "userID" => $userID,
                "birth_year" => (int)$birth_year,
                "entity" => "Father_births_by",
                "new_value" => implode(", ", $all_of_new_val),
                "prev_value" => implode(", ", $all_of_prev_val),
                "update_type" => "update",
                "attribute" => implode(", ", $all_of_attribute),
                "unique_keys" => $inforID,
                "timestamp" => new MongoDate()
            );

            $collection_AdminLog_updates_on = $db->AdminLog_updates_on;
            $collection_AdminLog_updates_on->insert($insert_admin);
        } else {//assistant admin
            $insert_assist = array(
                "userID" => $userID,
                "birth_year" => (int)$birth_year,
                "entity" => "Father_births_by",
                "new_value" => implode(", ", $all_of_new_val),
                "prev_value" => implode(", ", $all_of_prev_val),
                "update_type" => "update",
                "attribute" => implode(", ", $all_of_attribute),
                "unique_keys" => $inforID,
                "timestamp" => new MongoDate()
            );

            $collection_Assist_updates_on = $db->AssistantLog_tentative_updates_on;
            $collection_Assist_updates_on->insert($insert_assist);
        }
    }
else{
    echo 'You need to add instead. Add infants first..';
}



