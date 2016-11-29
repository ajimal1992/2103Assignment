<?php

require_once('Dbconnect.php');
require_once('authenticate.php');
$userType = $_SESSION['userType'];
$userID = $_SESSION['userID'];


//$fatherbr= $_GET['fatherbr'];
//$motherbr= $_GET['motherbr'];
//	$inforIDm = $_GET['inforIDm'];
//$total = $_POST['total'];
//$infantID = $_GET['infantID'];
//$mortID= $_GET['mortID'];
//$dea= $_GET['dea'];
///$eth= $_GET['eth'];
//$birth_year = $_POST['birth_year'];
//$race = $_POST['race'];
//$mth = $_POST['mth'];
//$child_gender = $_POST['child_gender'];
//$live_births = $_POST['live_births'];
//$prev_birth_year = $_POST['prev_birth_year'];
//$prev_race = $_POST['prev_race'];
//$prev_mth = $_POST['prev_mth'];
//$prev_child_gender = $_POST['prev_child_gender'];
//$prev_live_births = $_POST['prev_live_births'];
//$prev_val = array($prev_birth_year, $prev_race, $prev_mth, $prev_child_gender, $prev_live_births);
//mort






if (isset($_GET['mortID'], $_GET['eth'])) {
    $mortID = $_GET['mortID'];
    $eth = $_GET['eth'];
    $yea = $_GET['yea'];
    $collection_mortality = $db->Mortality_under_a_year;
    $asda = new MongoId(trim($mortID));


    if ($userType == "Admin") {
        echo $mortID;
        echo $eth;

        //$collectioninf->remove(array('birth_year' => intval($mortID)); 
        $collection_mortality->remove(array("_id" => $asda));

        //$collectionfa->remove(array("year"=>"$infantID"),array("justOne" => true));
        //UPDATE TO LOG  
        $insert_admin = array(
            "userID" => $userID,
            "birth_year" => $yea,
            "entity" => "Mortality_under_a_year",
            "new_value" => "",
            "prev_value" => "",
            "update_type" => "delete",
            "attribute" => "",
            "unique_keys" => trim($mortID),
            "timestamp" => new MongoDate()
        );

        $collection_AdminLog_updates_on = $db->AdminLog_updates_on;
        $collection_AdminLog_updates_on->insert($insert_admin);
    } else {//assistant admin
        $insert_assist = array(
            "userID" => $userID,
            "birth_year" => $yea,
            "entity" => "Mortality_under_a_year",
            "new_value" => "",
            "prev_value" => "",
            "update_type" => "delete",
            "attribute" => "",
            "unique_keys" => trim($mortID),
            "timestamp" => new MongoDate()
        );

        $collection_AdminLog_updates_on = $db->AssistantLog_tentative_updates_on;
        $collection_AdminLog_updates_on->insert($insert_assist);
    }
}
//infant
if (isset($_GET['infantID'], $_GET['total'])) {
    $infantID = $_GET['infantID'];
    $infantyear = $_GET['infantyear'];
    $total = $_GET['total'];
    $collection = $db->infants;


    $asdb = new MongoId(trim($infantID));
    if ($userType == "Admin") {

        echo $infantID;
        $collection->remove(array("_id" => $asdb));

        echo "Documents deleted successfully";

        //UPDATE TO LOG  
        $insert_admin = array(
            "userID" => $userID,
            "birth_year" => $infantyear,
            "entity" => "Infants",
            "new_value" => "",
            "prev_value" => "",
            "update_type" => "delete",
            "attribute" => "",
            "unique_keys" => trim($infantID),
            "timestamp" => new MongoDate()
        );

        $collection_AdminLog_updates_on = $db->AdminLog_updates_on;
        $collection_AdminLog_updates_on->insert($insert_admin);
    } else {//assistant admin
        $insert_assist = array(
            "userID" => $userID,
            "birth_year" => $infantyear,
            "entity" => "Infants",
            "new_value" => "",
            "prev_value" => "",
            "update_type" => "delete",
            "attribute" => "",
            "unique_keys" => trim($infantID),
            "timestamp" => new MongoDate()
        );

        $collection_AdminLog_updates_on = $db->AssistantLog_tentative_updates_on;
        $collection_AdminLog_updates_on->insert($insert_assist);
    }
}
//mother
if (isset($_GET['inforIDm'], $_GET['motherbr'])) {
    $inforIDm = $_GET['inforIDm'];
    $motherbr = $_GET['motherbr'];



    $collection_mother = $db->Mother_births_by;




    $asd1 = new MongoId(trim($inforIDm));


    if ($userType == "Admin") {

        // echo "$inforID";
        //echo "ASASJASHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH";

        $testid = "558393dcc019100735712557d";

        /* 	try {
          $inforID = new MongoId($inforID);
          } catch (MongoException $ex) {
          $inforID = new MongoId();
          } */



        $collection_mother->remove(array("_id" => $asd1));



        //UPDATE TO LOG  
        $insert_admin = array(
            "userID" => $userID,
            "birth_year" => $motherbr,
            "entity" => "Mother_births_by",
            "new_value" => "",
            "prev_value" => "",
            "update_type" => "delete",
            "attribute" => "",
            "unique_keys" => trim($inforIDm),
            "timestamp" => new MongoDate()
        );

        $collection_AdminLog_updates_on = $db->AdminLog_updates_on;
        $collection_AdminLog_updates_on->insert($insert_admin);
    } else {//assistant admin
        $insert_assist = array(
            "userID" => $userID,
            "birth_year" => $motherbr,
            "entity" => "Mother_births_by",
            "new_value" => "",
            "prev_value" => "",
            "update_type" => "delete",
            "attribute" => "",
            "unique_keys" => trim($inforIDm),
            "timestamp" => new MongoDate()
        );

        $collection_AdminLog_updates_on = $db->AssistantLog_tentative_updates_on;
        $collection_AdminLog_updates_on->insert($insert_assist);
    }
}


//father

if (isset($_GET['inforID'], $_GET['fatherbr'])) {

    $inforID = $_GET['inforID'];
    $fatherbr = $_GET['fatherbr'];
    $collection_father = $db->Father_births_by;
    $asd = new MongoId(trim($inforID));
    echo $asd;

    if ($userType == "Admin") {

        // echo "$inforID";
        //echo "ASASJASHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH";

        $testid = "558393dcc019100735712557d";

        /* 	try {
          $inforID = new MongoId($inforID);
          } catch (MongoException $ex) {
          $inforID = new MongoId();
          } */



        $collection_father->remove(array("_id" => $asd));



        //UPDATE TO LOG  
        $insert_admin = array(
            "userID" => $userID,
            "birth_year" => $fatherbr,
            "entity" => "Father_births_by",
            "new_value" => "",
            "prev_value" => "",
            "update_type" => "delete",
            "attribute" => "",
            "unique_keys" => trim($inforID),
            "timestamp" => new MongoDate()
        );

        $collection_AdminLog_updates_on = $db->AdminLog_updates_on;
        $collection_AdminLog_updates_on->insert($insert_admin);
    } else {//assistant admin
        $insert_assist = array(
            "userID" => $userID,
            "birth_year" => $fatherbr,
            "entity" => "Father_births_by",
            "new_value" => "",
            "prev_value" => "",
            "update_type" => "delete",
            "attribute" => "",
            "unique_keys" => trim($inforID),
            "timestamp" => new MongoDate()
        );

        $collection_AdminLog_updates_on = $db->AssistantLog_tentative_updates_on;
        $collection_AdminLog_updates_on->insert($insert_assist);
    }
}




header("Location: View.php");
?>


