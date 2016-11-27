<?php

require_once('Dbconnect.php');
$userID = 1;

$id = $_POST['_id'];
$birth_year = $_POST['birth_year'];
$race = $_POST['race'];
$mth = $_POST['mth'];
$child_gender = $_POST['child_gender'];
$age_group = $_POST['age_group'];
$live_births = $_POST['live_births'];

$prev_race = $_POST['prev_race'];
$prev_mth = $_POST['prev_mth'];
$prev_child_gender = $_POST['prev_child_gender'];
$prev_age_group = $_POST['prev_age_group'];
$prev_live_births = $_POST['prev_live_births'];

$new_val = array($race, $mth, $child_gender, $age_group, $live_births);
$prev_val = array($prev_race, $prev_mth, $prev_child_gender, $prev_age_group, $prev_live_births);
$attribute = array('race', 'mth', 'child_gender', 'age_group', 'live_births');
$all_of_new_val = array();
$all_of_prev_val = array();
$all_of_attribute = array();

$collection_mother = $db->Mother_births_by;
$collection_exist = $collection_mother->find(array(
    "birth_year" => $birth_year,
    "race" => $race,
    "mth" => $mth,
    "child_gender" => $child_gender,
    "age_group" => $age_group
        ));

$total = count($collection_exist);

$count = count($new_val);
for ($x = 0; $x < $count; $x++) {
    if ($new_val[$x] != $prev_val[$x]) {
        array_push($all_of_new_val, $new_val[$x]);
        array_push($all_of_prev_val, $prev_val[$x]);
        array_push($all_of_attribute, $attribute[$x]);
    }
}

if ($total > 0) {
    if ($race != $prev_race || $child_gender != $prev_child_gender || $mth != $prev_mth || $age_group != $prev_age_group) { //dont allow duplicate pk
        echo 'Update failed. Cannot have repeated _id/ birth_year/ race/ mth/ child_gender <br>';
    } else {
        if ($userID == 1) {
            $update_mother = array(
                "birth_year" => $birth_year,
                "race" => $race,
                "mth" => $mth,
                "child_gender" => $child_gender,
                "age_group" => $age_group,
                "live_births" => $live_births
            );

            $insert_admin = array(
                "userID" => $userID,
                "birth_year" => $birth_year,
                "entity" => "Mother_births_by",
                "new_value" => implode(", ", $all_of_new_val),
                "prev_value" => implode(", ", $all_of_prev_val),
                "update_type" => "update",
                "attribute" => implode(", ", $all_of_attribute),
                "unique_keys" => $id
            );
            $collection = $db->Mother_births_by;
            $collection->update(array("_id" => new MongoId($id)), $update_mother);

            $collection_AdminLog_updates_on = $db->AdminLog_updates_on;
            $collection_AdminLog_updates_on->insert($insert_admin);
        } else {
            $insert_assist = array(
                "userID" => $userID,
                "birth_year" => $birth_year,
                "entity" => "Mother_births_by",
                "new_value" => implode(", ", $all_of_new_val),
                "prev_value" => implode(", ", $all_of_prev_val),
                "update_type" => "update",
                "attribute" => implode(", ", $all_of_attribute),
                "unique_keys" => $id
            );

            $collection_AdminLog_updates_on = $db->AssistantLog_tentative_updates_on;
            $collection_AdminLog_updates_on->insert($insert_assist);
        }
    }
}
else{
    echo 'You need to add instead. Add infants first..';
}

