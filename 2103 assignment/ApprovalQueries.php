<?php
include ("database.php");
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
        }

        // approve to UPDATE the respective entity and attribute
        if ($updateType == "update") {
            $updateQuery = "$updateType $entity SET $attribute = $newValue WHERE birth_year = $birthYear";
            $updateResult = sqlsrv_query($conn, $updateQuery);
            if ($updateResult === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }

        if ($updateType == "delete") {
            $deleteQuery = "$updateType FROM $entity WHERE birth_year = $birthYear";
            $deleteResult = sqlsrv_query($conn, $deleteQuery);
             if ($deleteResult === false) {
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
