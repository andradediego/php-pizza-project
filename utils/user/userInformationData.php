<?php
	$userData = array();
	$userData['CUST_EMAIL'] = '';
	$userData['CUST_NAME'] = '';
	$userData['CUST_ADDRESS'] = '';
	$userData['CUST_PHONE'] = '';
	$userData['CUST_PROVINCE'] = '';
	$userData['CUST_CITY'] = '';
	$userData['CUST_POSTALCODE'] = '';

	$userErrors = array();
	$userErrors['CUST_EMAIL'] = false;
	$userErrors['CUST_NAME'] = false;
	$userErrors['CUST_ADDRESS'] = false;
	$userErrors['CUST_PHONE'] = false;
	$userErrors['CUST_PROVINCE'] = false;
	$userErrors['CUST_CITY'] = false;
	$userErrors['CUST_POSTALCODE'] = false;


	function setUserData ($userData) {
		require_once('./utils/session.php');
		if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
			$user = $_SESSION['user'];

			if (isset($user['CUST_EMAIL']) && $user['CUST_EMAIL'] != null) {
				$userData['CUST_EMAIL'] = $user['CUST_EMAIL'];
			}
	
			if (isset($user['CUST_NAME']) && $user['CUST_NAME'] != null) {
				$userData['CUST_NAME'] = $user['CUST_NAME'];
			}	
	
			if (isset($user['CUST_ADDRESS']) && $user['CUST_ADDRESS'] != null) {
				$userData['CUST_ADDRESS'] = $user['CUST_ADDRESS'];
			}
	
			if (isset($user['CUST_PHONE']) && $user['CUST_PHONE'] != null) {
				$userData['CUST_PHONE'] = $user['CUST_PHONE'];
			}
	
			if (isset($user['CUST_PROVINCE']) && $user['CUST_PROVINCE'] != null) {
				$userData['CUST_PROVINCE'] = $user['CUST_PROVINCE'];
			}
	
			if (isset($user['CUST_CITY']) && $user['CUST_CITY'] != null) {
				$userData['CUST_CITY'] = $user['CUST_CITY'];
			}
	
			if (isset($user['CUST_POSTALCODE']) && $user['CUST_POSTALCODE'] != null) {
				$userData['CUST_POSTALCODE'] = $user['CUST_POSTALCODE'];
			}

			return $userData;
		}
	}
	
?>