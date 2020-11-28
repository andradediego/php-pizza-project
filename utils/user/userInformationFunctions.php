<?php
function getData ($query, $data) {
	require_once('./common.php');

	$db_conn = connectDB();

	$stmt = $db_conn->prepare($query);
	if (!$stmt) {
		echo 'Error '.$dbc->errorCode().'\n Message '.implode($dbc->errorInfo()).'\n';
		exit(1);
	}

	$status = $stmt->execute($data); 
	
	if (!$status) {
		echo 'Error '.$stmt.errorCode().'\n Message'.implode($stmt->errorInfo()).'\n';
		exit(1);
	}  

	return $stmt->fetch(); 
}

function insertData ($query, $data) {
	require_once('./common.php');

	$db_conn = connectDB();
	
	$stmt = $db_conn->prepare($query);

	if (!$stmt) {
		echo 'Error '.$dbc->errorCode().'\n Message '.implode($dbc->errorInfo()).'\n';
		exit(1);
	}

	$status = $stmt->execute($data);

	if (!$status) {
		echo 'Error '.$stmt->errorCode().'\n Message'.implode($stmt->errorInfo()).'\n';
		exit(1);
	}
}
?>