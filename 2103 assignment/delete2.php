	<?php
	require_once('DB_Connection.php'); 
	require_once('grabID.php');

	$inforID = $_GET['inforID'];
	$fatherbr= $_GET['fatherbr'];
	
	$motherbr= $_GET['motherbr'];
	$inforIDm = $_GET['inforIDm'];
	
	$total = $_POST['total'];
	$infantID = $_GET['infantID'];
	
	$mortID= $_GET['mortID'];
	$dea= $_GET['dea'];
	$eth= $_GET['eth'];
	
	
	$birth_year = $_POST['birth_year'];
	$race = $_POST['race'];
	$mth = $_POST['mth'];
	$child_gender = $_POST['child_gender'];
	$live_births = $_POST['live_births'];

	$prev_birth_year = $_POST['prev_birth_year'];
	$prev_race = $_POST['prev_race'];
	$prev_mth = $_POST['prev_mth'];
	$prev_child_gender = $_POST['prev_child_gender'];
	$prev_live_births = $_POST['prev_live_births'];

	
	$prev_val = array($prev_birth_year, $prev_race, $prev_mth, $prev_child_gender, $prev_live_births);
	
if( isset($_GET['inforID']) ) {
	if($user['accountType'] == 'Admin'){
		echo 'Logged in as Admin';
				
		$sql = "Delete FROM Father_births_by WHERE inforID = $inforID";
			   
				
													
		$result = sqlsrv_query($conn, $sql, array($fatherbr, $mth, $child_gender, $live_births, $inforID));

		if ($result) {
			echo 'Delete success!';       

			
					$update_log = "insert into AdminLog_updates_on (userID, birth_year, entity, new_value, prev_value, update_type, attribute, unique_keys)
					values(?, ?, ?, ?, ?, ?, ?, ?)";
					$log_result = sqlsrv_query($conn, $update_log, array($user['userID'],$fatherbr, 'Father_births_by', '', '', 'delete', '', $inforID));
				
			
		}
	else{
			echo "No duplicates key values are allowed... . <br>";
			die(print_r(sqlsrv_errors(), true));
		}
	}
	
else{
    echo 'Logged in as Asisstant';
    
			
            $update_log = "insert into AssistantLog_tentative_updates_on (userID, birth_year, entity, new_value, prev_value, update_type, attribute, unique_keys)
            values(?, ?, ?, ?, ?, ?, ?, ?)";
            $log_result = sqlsrv_query($conn, $update_log, array($user['userID'], $fatherbr, 'Father_births_by', '', '', 'delete', '', $inforID));
        
    
}
}

if( isset($_GET['infantID'], $_GET['total']) )  {
if($user['accountType'] == 'Admin'){
		echo 'Logged in as Admin';
				
				
				
		$sql2 = "Delete FROM infants WHERE birth_year = $infantID";
			   
			
		
		$result = sqlsrv_query($conn, $sql2, array($infantID,$total,));
		if ($result) {
			echo 'Delete success!';       
			
			$update_log = "insert into AdminLog_updates_on (userID, birth_year, entity, new_value, prev_value, update_type, attribute, unique_keys)
            values(?, ?, ?, ?, ?, ?, ?, ?)";
            $log_result = sqlsrv_query($conn, $update_log, array($user['userID'], $infantID, 'infants', '', '', 'delete', '', ''));
        
				
			
		}
	else{
			echo "No duplicates key values are allowed... . <br>";
			die(print_r(sqlsrv_errors(), true));
		}
	}
	
else{
    echo 'Logged in as Asisstant';
    
			
            $update_log = "insert into AssistantLog_tentative_updates_on (userID, birth_year, entity, new_value, prev_value, update_type, attribute, unique_keys)
            values(?, ?, ?, ?, ?, ?, ?, ?)";
            $log_result = sqlsrv_query($conn, $update_log, array($user['userID'], $infantID, 'infants', '', '', 'delete', '', ''));
        
    
}
}	
//Mother command
if( isset($_GET['inforIDm']) ) {
	if($user['accountType'] == 'Admin'){
		echo 'Logged in as Admin';
				
		$sql3 = "Delete FROM Mother_births_by WHERE inforID = $inforIDm";
			   
				

		$result = sqlsrv_query($conn, $sql3, array($motherbr, $mth, $child_gender, $live_births, $inforIDm));

		if ($result) {
			echo 'Delete success!';       

			
					$update_log = "insert into AdminLog_updates_on (userID, birth_year, entity, new_value, prev_value, update_type, attribute, unique_keys)
					values(?, ?, ?, ?, ?, ?, ?, ?)";
					$log_result = sqlsrv_query($conn, $update_log, array($user['userID'],$motherbr, 'Mother_births_by', '', '', 'delete', '', $inforIDm));
				
			
		}
	else{
			echo "No duplicates key values are allowed... . <br>";
			die(print_r(sqlsrv_errors(), true));
		}
	}
	
else{
    echo 'Logged in as Asisstant';
    
			
            $update_log = "insert into AssistantLog_tentative_updates_on (userID, birth_year, entity, new_value, prev_value, update_type, attribute, unique_keys)
            values(?, ?, ?, ?, ?, ?, ?, ?)";
            $log_result = sqlsrv_query($conn, $update_log, array($user['userID'], $motherbr, 'Mother_births_by', '', '', 'delete', '', $inforIDm));
        
    
}
}		

//morta


	
if( isset($_GET['mortID'], $_GET['eth']) ) {
if($user['accountType'] == 'Admin'){
		echo 'Logged in as Admin';
				
		$sql4 = "Delete FROM Mortality_under_a_year WHERE birth_year = '$mortID' and ethnicity='$eth'";
			   
				

		$result = sqlsrv_query($conn, $sql4, array($mortID, $eth, $dea));

		if ($result) {
			echo 'Delete success! 	';       

			
					$update_log = "insert into AdminLog_updates_on (userID, birth_year, entity, new_value, prev_value, update_type, attribute, unique_keys)
					values(?, ?, ?, ?, ?, ?, ?, ?)";
					$log_result = sqlsrv_query($conn, $update_log, array($user['userID'],$mortID, 'Mortality_under_a_year', '', '', 'delete', '', $eth));
				
			
		}
	else{
			echo "No duplicates key values are allowed... . <br>";
			die(print_r(sqlsrv_errors(), true));
		}
	}
	
else{
    echo 'Logged in as Asisstant';
    
			
            $update_log = "insert into AssistantLog_tentative_updates_on (userID, birth_year, entity, new_value, prev_value, update_type, attribute, unique_keys)
            values(?, ?, ?, ?, ?, ?, ?, ?)";
            $log_result = sqlsrv_query($conn, $update_log, array($user['userID'], $mortID, 'Mortality_under_a_year', '', '', 'delete', '', $eth));
			
}

}

	header( "Location: View.php" );
	?>


