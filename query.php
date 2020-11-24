<?php
	require_once('./common.php');
	function executeQuery ($query) {
		$db_conn = connectDB();

		$stmt = $db_conn->prepare($query);
		if (!$stmt) {
				echo 'Error '.$dbc->errorCode().'\n Message '.implode($dbc->errorInfo()).'\n';
				exit(1);
		}

		$status = $stmt->execute();
		if ($status) {				
				if ($stmt->rowCount() > 0) { 
					return $stmt;
				}
		} else {
				echo 'Error '.$stmt.errorCode().'\n Message'.implode($stmt->errorInfo()).'\n';
				exit(1);
		}
	}
?>