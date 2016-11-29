 <?php
require_once('authenticate.php');
require_once('Dbconnect.php');
$userType = $_SESSION['userType'];
$userID = $_SESSION['userID'];

$value = $_POST['value'];
$year = $_POST['year'];

$tempdoc = array(
    "birth_year" => (int)$year,
    "value" => (int)$value
);

$collection = $db->infants;
$collection_check = $collection->find(array('birth_year' => (int)$year));


if($collection_check->count() > 0){
    echo $collection_check->count() . '<br>';
    echo '<br> Record already exists in DB...';
}
else{
    if($userType == "Admin"){
        $collection->insert($tempdoc);
        echo 'Add to infants collection successful! <br>';
        
        $insert_admin = array(
            "userID" => $userID,
            "birth_year" => (int)$year,
            "entity" => "infants",
            "new_value" => (int)$value,
            "prev_value" => "",
            "update_type" => "insert",
            "attribute" => "value",
            "unique_keys" => "",
            "timestamp" => new MongoDate()
        );
        
        $collection_AdminLog_updates_on = $db->AdminLog_updates_on;
        $collection_AdminLog_updates_on->insert($insert_admin);
        echo 'Update to AdminLog successful! <br>';
    }
    else{
//        $insert_assist = array(
//            "userID" => $userID,
//            "year" => $year,
//            "entity" => "infants",
//            "new_value" => $value,
//            "update_type" => "insert",
//            "attribute" => "value"
//        );
//        
//        $collection_Assist_updates_on = $db->AssistantLog_tentative_updates_on;
//        $collection_Assist_updates_on->insert($insert_assist);
//        echo 'Update to AdminLog successful! <br>';
        echo 'Only admin can insert infant... <br>';
    }
}


