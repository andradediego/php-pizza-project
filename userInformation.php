<?php
	// load all provinces
	require_once('./utils/provinces.php');
	require_once('./utils/session.php');
	require_once('./utils/user/userInformationData.php');
	
	
	$userData = setUserData($userData);	

	if (isset($_POST['CUST_EMAIL']) && isset($_POST['CUST_NAME']) && isset($_POST['CUST_ADDRESS']) && isset($_POST['CUST_CITY'])
		&& isset($_POST['CUST_PROVINCE']) && isset($_POST['CUST_POSTALCODE'])) {

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
			$userData = setUserData($userData);
		}

	} else {

	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Brazucas Pizzeria</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
    <?php
        // navigation menu
        require_once('./navigationMenu.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-offset-4 col-md-4">
							<form action="userInformation.php" method="post">
								<div class="form-group">
									<label for="CUST_EMAIL">Email</label>
									<?php echo '<input type="email" class="form-control" name="CUST_EMAIL" id="CUST_EMAIL" value="'.$userData['CUST_EMAIL'].'" placeholder="jane.doe@gmail.com">'; ?>									
								</div>
								<div class="form-group">
									<label for="CUST_NAME">Name</label>
									<?php echo '<input type="text" class="form-control" name="CUST_NAME" id="CUST_NAME" value="'.$userData['CUST_NAME'].'" placeholder="Jane Doe">'; ?>									
								</div>
								<div class="form-group">
									<label for="CUST_PHONE">Phone</label>
									<?php echo '<input type="text" class="form-control" name="CUST_PHONE" id="CUST_PHONE" value="'.$userData['CUST_PHONE'].'" placeholder="519 123 4567">'; ?>										
								</div>
								<!-- <div class="form-group">
									<label for="CUST_DOB">Date of Birth</label>
									<input type="date" class="form-control" name="CUST_DOB" id="CUST_DOB">
								</div> -->
								<div class="form-group">
									<label for="CUST_ADDRESS">Address</label>
									<?php echo '<input type="text" class="form-control" name="CUST_ADDRESS" id="CUST_ADDRESS" value="'.$userData['CUST_ADDRESS'].'" placeholder="Ex: 1235 First Street">'; ?>										
								</div>	
								<div class="form-group">
									<label for="CUST_CITY">CITY</label>
									<?php echo '<input type="text" class="form-control" name="CUST_CITY" id="CUST_CITY" value="'.$userData['CUST_CITY'].'" placeholder="Ex: London">'; ?>										
								</div>		
								<div class="form-group">
									<label for="CUST_PROVINCE">Province</label>
									<select class="form-control" name="CUST_PROVINCE" id="CUST_PROVINCE">
										<option value="">Please select</option>
											<?php
												foreach ($provinces as $province) {
													if ($userData['CUST_PROVINCE'] == $province['postal']) {
														echo '<option selected="selected" value="' . $province['postal'] . '">' . $province['postal'] . ' - ' . $province['name'] . '</option>';
													} else {
														echo '<option value="' . $province['postal'] . '">' . $province['postal'] . ' - ' . $province['name'] . '</option>';
													}
												}	
											?>
									</select>									
								</div>
								<div class="form-group">
									<label for="CUST_POSTAL_CODE">Postal Code</label>
									<?php echo '<input type="text" class="form-control" name="CUST_POSTALCODE" id="CUST_POSTALCODE" value="'.$userData['CUST_POSTALCODE'].'" placeholder="Ex: N3P 5U2">'; ?>										
								</div>					
								<button type="submit" class="btn btn-primary btn-block">Update</button>
							</form> 
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>