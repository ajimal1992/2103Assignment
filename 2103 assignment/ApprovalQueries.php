<?php

include ("Dbconnect.php");
?>
<?php

// if clicked approve button and selected checkbox
if (isset($_POST['approve']) && isset($_POST['select'])) {
    foreach ($_POST['select'] as $check) {

        $approvingQuery = "SELECT * FROM AssistantLog_tentative_updates_on WHERE update_ID = $check";
        $approvingResult = sqlsrv_query($conn, $approvingQuery);
        if ($approvingResult === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $results1 = [];
        // use variable to store the checked table row
        while ($approvingRow = sqlsrv_fetch_array($approvingResult, SQLSRV_FETCH_ASSOC)) {
            $results1[] = $approvingRow;
        }
        foreach ($results1 as $row) {
            $updateID = $row['update_ID'];
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
            $updateQuery = "$updateType $entity SET $attribute = $newValue WHERE birth_year = $birthYear";
            if (ctype_digit($uniqueKey) && strlen($uniqueKey) >= 1) {
                $updateQuery .= " AND inforID = $uniqueKey";
            }
            if (!ctype_digit($uniqueKey) && strlen($uniqueKey) >= 1) {
                $updateQuery .= " AND ethnicity = '$uniqueKey'";
            }
            $updateResult = sqlsrv_query($conn, $updateQuery);
            if ($updateResult === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }

        // approve to DELETE the respective entity and attribute
        if ($updateType == "delete") {
            //echo $attribute;
            $deleteQuery = "$updateType FROM $entity WHERE birth_year = $birthYear";
            if (ctype_digit($uniqueKey) && strlen($uniqueKey) >= 1) {
                $deleteQuery .= " AND inforID = $uniqueKey";
            }
            if (!ctype_digit($uniqueKey) && strlen($uniqueKey) >= 1) {
                $deleteQuery .= " AND ethnicity = '$uniqueKey'";
            }
            $deleteResult = sqlsrv_query($conn, $deleteQuery);
            if ($deleteResult === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }

        // approve to INSERT the respective entity and attribute
        if (($updateType == "insert")) {
            $splitWords = explode(',', $newValue);
            $d = array();
            foreach ($splitWords as $name) {
                $d[] = '\'' . $name . '\'';
            }
            $latestNewValue = implode(",", $d);
            $insertQuery = "$updateType INTO $entity (birth_year,$attribute) VALUES ('$birthYear',$latestNewValue)";
            $insertResult = sqlsrv_query($conn, $insertQuery);
            if ($insertResult === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }

        // Insert the admin who approved the assistant logs
        // Assume admin id is 1.
        $approvedQuery = "INSERT INTO Approves (update_ID, admin_userID, assist_userID) VALUES ($updateID,1,$AssistUserID)";
        $approvedResult = sqlsrv_query($conn, $approvedQuery);
        if ($approvedResult === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }
    header("Location:ApproveLogs.php");
}
?>
