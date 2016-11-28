<?php

include ("Dbconnect.php");
//require_once('grabID.php');
?>
<?php

// if clicked approve button and selected checkbox
if (isset($_POST['approve']) && isset($_POST['select'])) {
//        && $user['accountType'] == 'Admin') {
    foreach ($_POST['select'] as $check) {
        $collection = $db->selectCollection('AssistantLog_tentative_updates_on');
        $approvingQuery = $collection->find(array("_id" => new MongoId($check)));
        //$approvingQuery = "SELECT * FROM AssistantLog_tentative_updates_on WHERE update_ID = $check";
        // use variable to store the checked table row
        foreach ($approvingQuery as $row) {
            $updateID = $row['_id'];
            $AssistUserID = $row['userID'];
            $birthYear = $row['birth_year'];
            $entity = $row['entity'];
            $newValue = $row['new_value'];
            $prevValue = $row['prev_value'];
            $updateType = $row['update_type'];
            $attribute = $row['attribute'];
            $uniqueKey = $row['unique_keys'];
        }

        // approve to UPDATE the respective entity and attribute
        if ($updateType == "update") {
            // Make it to array for new value
            $splitWords = explode(',', $newValue);
            $d = array();
            foreach ($splitWords as $name) {
                $d[] = '' . $name . '';
            }
            $latestValue = implode(",", $d);
            
            // Make it to array for attribute
            $splitAttribute = explode(',', $attribute);
            $a = array();
            foreach ($splitAttribute as $name) {
                $a[] = '' . $name . '';
            }
            $latestAttribute = implode(",", $a);
            
            $count = count($a);
            $pushAtt = array();
            $pushVal = array();
            for ($x = 0; $x < $count; $x++) {
                array_push($pushAtt, $a[$x]);
                array_push($pushVal, $d[$x]);
            }
            $count1 = count($pushVal);
            $updateDatas = [];
            for ($i = 0; $i < $count1; $i++) {
              $updateDatas[$pushAtt[$i]] = $pushVal[$i];
            }

            $updateDatas['birth_year'] = $birthYear;
  
            $updateQuery = $db->selectCollection($entity);

            $updateQuery->update(array("_id" => new MongoId($uniqueKey)), array('$set' => $updateDatas));
            
        }
        // END

        // approve to DELETE the respective entity and attribute
        if ($updateType == "delete") {
            $deleteQuery = $db->selectCollection($entity);
            $deleteQuery->remove(array("_id"=>new MongoId($uniqueKey)));     
        }

        // approve to INSERT the respective entity and attribute
        if (( $updateType == "insert")) {
            // Make it to array for new value
            $splitWords = explode(',', $newValue);
            $d = array();
            foreach ($splitWords as $name) {
                $d[] = ' ' . $name . '';
            }
            $latestValue = implode(", ", $d);

            // Make it to array for attribute
            $splitAttribute = explode(',', $attribute);
            $a = array();
            foreach ($splitAttribute as $name) {
                $a[] = '' . $name . '';
            }
            $latestAttribute = implode(",", $a);

            $count = count($a);
            $pushAtt = array();
            $pushVal = array();
            for ($x = 0; $x < $count; $x++) {
                array_push($pushAtt, $a[$x]);
                array_push($pushVal, $d[$x]);
            }
            $count1 = count($pushVal);
            $insertDatas = [];
            for ($i = 0; $i < $count1; $i++) {
              $insertDatas[$pushAtt[$i]] = $pushVal[$i];
            }

            $insertDatas['birth_year'] = $birthYear;
            $insertQuery = $db->selectCollection($entity);
            $insertQuery->insert($insertDatas);

        }
       

        //$userID = $user['userID'];
        // Insert the admin who approved the assistant logs
        // Assume admin id is 1.
        $approveCollection = $db->selectCollection('Approves');
        $approveCollection->insert(array("updateID"=>(string)$updateID, "admin_userID"=> 1, "assist_userID"=> $AssistUserID,"timestamp"=> new MongoDate()));

    }
    header("Location:ApproveLogs.php");
}
//else {
//    echo '<script language="javascript">';
//    echo 'alert("You are not an Admin!"); location.href="ApproveLogs.php"';
//    echo '</script>';
//}
?>
