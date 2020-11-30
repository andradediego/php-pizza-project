<?php
	session_start();

	if (!isset($_SESSION['islogged'])){
			$_SESSION['islogged'] = false;        
	}

	if (!isset($_SESSION['user'])){
			$_SESSION['user'] = null;        
	}

	if (!isset($_SESSION['orders'])){
		$_SESSION['orders'] = array();        
	}
?>