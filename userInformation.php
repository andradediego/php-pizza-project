<?php
	// load all provinces
	require_once('./utils/provinces.php');	
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
							<form>
								<div class="form-group">
									<label for="CUST_NAME">Name</label>
									<input type="text" class="form-control" name="CUST_NAME" id="CUST_NAME" placeholder="Jane Doe">
								</div>
								<div class="form-group">
									<label for="CUST_DOB">Date of Birth</label>
									<input type="date" class="form-control" name="CUST_DOB" id="CUST_DOB">
								</div>
								<div class="form-group">
									<label for="CUST_ADDRESS">Address</label>
									<input type="text" class="form-control" name="CUST_ADDRESS" id="CUST_ADDRESS" placeholder="Ex: 1235 First Street">
								</div>	
								<div class="form-group">
									<label for="CUST_CITY">CITY</label>
									<input type="text" class="form-control" name="CUST_CITY" id="CUST_CITY" placeholder="Ex: London">
								</div>		
								<div class="form-group">
									<label for="CUST_PROVINCE">CITY</label>
									<select class="form-control" name="CUST_PROVINCE" id="CUST_PROVINCE">
										<option value="">Please select</option>
											<?php
												foreach ($provinces as $province) {
													echo '<option value="' . $province['postal'] . '">' . $province['postal'] . ' - ' . $province['name'] . '</option>';
												}	
											?>
									</select>									
								</div>	
								<div class="form-group">
									<label for="CUST_POSTAL_CODE">CITY</label>
									<input type="text" class="form-control" name="CUST_POSTAL_CODE" id="CUST_POSTAL_CODE" placeholder="Ex: London">
								</div>					
								<button type="submit" class="btn btn-default btn-block">Submit</button>
							</form> 
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>