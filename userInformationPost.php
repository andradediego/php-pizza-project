<?php
require_once('./utils/session.php');
require_once('./utils/user/userInformationData.php');
var_dump($userErrors);
var_dump($_POST);
if (isset($_POST['CUST_EMAIL']) && isset($_POST['CUST_NAME']) && isset($_POST['CUST_ADDRESS']) && isset($_POST['CUST_CITY'])
&& isset($_POST['CUST_PROVINCE']) && isset($_POST['CUST_POSTALCODE'])
&& strlen(trim($_POST['CUST_EMAIL'])) > 0 && strlen(trim($_POST['CUST_NAME'])) > 0) {

	$user = $_SESSION['user'];

	if (isset($user['CUST_EMAIL'])) {
		$cust_email = $user['CUST_EMAIL'];
	}

	if (isset($user['CUST_ID'])) {
		$cust_id = $user['CUST_ID'];
	}

	require_once('./utils/user/userInformationFunctions.php');
	$userOld = getData('select * from TBLCUSTOMERS where CUST_EMAIL = ? and CUST_ID = ?', array($cust_email, $cust_id)); 			


	$email = addslashes(trim($_POST['CUST_EMAIL']));
	if ($email == trim($userOld['CUST_EMAIL'])) {

		$name = addslashes(trim($_POST['CUST_NAME']));
		$address = addslashes(trim($_POST['CUST_ADDRESS']));
		$phone = addslashes(trim($_POST['CUST_PHONE']));
		$city = addslashes(trim($_POST['CUST_CITY']));
		$province = addslashes(trim($_POST['CUST_PROVINCE']));
		$postalCode = addslashes(trim($_POST['CUST_POSTALCODE']));

		insertData('update TBLCUSTOMERS set CUST_NAME = ?, CUST_ADDRESS = ?, CUST_CITY = ?, CUST_PROVINCE = ?, CUST_POSTALCODE = ?, CUST_PHONE = ? where CUST_EMAIL = ? and CUST_ID = ?', 
			array($name, $address, $city, $province, $postalCode, $phone, $email, $userOld['CUST_ID']));

		$_SESSION['user'] = getData('select * from TBLCUSTOMERS where CUST_EMAIL = ? and CUST_ID = ?', array($cust_email, $cust_id));						
	} 
	
} else {		
	$userErrors['CUST_EMAIL'] = isset($_POST['CUST_EMAIL']) && strlen(trim($_POST['CUST_EMAIL'])) == 0;
	$userErrors['CUST_NAME'] = isset($_POST['CUST_NAME']) && strlen(trim($_POST['CUST_NAME'])) == 0;
	$userErrors['CUST_ADDRESS'] = isset($_POST['CUST_ADDRESS']) && strlen(trim($_POST['CUST_ADDRESS'])) == 0;
	$userErrors['CUST_PHONE'] = isset($_POST['CUST_PHONE']) && strlen(trim($_POST['CUST_PHONE'])) == 0;
	$userErrors['CUST_PROVINCE'] = isset($_POST['CUST_PROVINCE']) && strlen(trim($_POST['CUST_PROVINCE'])) == 0;
	$userErrors['CUST_CITY'] = isset($_POST['CUST_CITY']) && strlen(trim($_POST['CUST_CITY'])) == 0;
	$userErrors['CUST_POSTALCODE'] = isset($_POST['CUST_POSTALCODE']) && strlen(trim($_POST['CUST_POSTALCODE'])) == 0;
	// var_dump($userErrors);
}
header("Location:userInformation.php");
?>