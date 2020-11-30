<?php
	require_once('./utils/session.php');
			
	if (!$_SESSION['islogged'] || $_SESSION['user'] == null) {
		header("Location:index.php");
	}

	if (isset($_POST['PIZZA_DOUGH']) && isset($_POST['PIZZA_SAUCE']) && isset($_POST['PIZZA_CHEESE']) && isset($_POST['PIZZA_TOPPING'])
	&& strlen(trim($_POST['PIZZA_DOUGH'])) > 0 && strlen(trim($_POST['PIZZA_SAUCE'])) > 0 && strlen(trim($_POST['PIZZA_CHEESE'])) > 0
	&& (count($_POST['PIZZA_TOPPING']) > 0 && count($_POST['PIZZA_TOPPING']) < 6)) {
		checkPizza($_POST, $_SESSION['orders']);	
		
	} else if (count($_SESSION['orders']) > 0) {
		checkPizza(null, $_SESSION['orders']);
	} else {
		$_SESSION['errorsOrder'] = array();
		$_SESSION['errorsOrder']['PIZZA_DOUGH'] = strlen(trim($_POST['PIZZA_DOUGH'])) == 0;
		$_SESSION['errorsOrder']['PIZZA_SAUCE'] = strlen(trim($_POST['PIZZA_SAUCE'])) == 0;
		$_SESSION['errorsOrder']['PIZZA_CHEESE'] = strlen(trim($_POST['PIZZA_CHEESE'])) == 0;
		$_SESSION['errorsOrder']['PIZZA_TOPPING'] = (count($_POST['PIZZA_TOPPING']) == 0 || count($_POST['PIZZA_TOPPING']) > 6);
		header("Location:orderpizza.php");
	}

	function checkPizza ($post, $session) {
		require_once('./utils/session.php');

		$user = $_SESSION['user'];
		
		if(strlen(trim($user['CUST_NAME'])) == 0
		|| strlen(trim($user['CUST_ADDRESS'])) == 0 || strlen(trim($user['CUST_CITY'])) == 0
		|| strlen(trim($user['CUST_PROVINCE'])) == 0 || strlen(trim($user['CUST_POSTALCODE'])) == 0
		) {
			$_SESSION['orders'][] = $_POST;
			$_SESSION['needUserDetails'] = true;
			header("Location:userInformation.php");
		} else {			
			$idOrder = null;

			$pizzaArray = array();
			if ($post != null) {
				$pizzaArray[] = $_POST;
			}
			
			if (count($session) > 0) {
				foreach ($session as &$pizza) {
					$pizzaArray[] = $pizza;
				}
			}

			$idOrder = addPizzas($pizzaArray, $user);
			
			$_SESSION['ORD_ID'] = $idOrder; 
			unset($_SESSION['orders']);       
			header("Location:orderSummary.php");
		}
	}


	function addPizzas ($pizzaArray, $user) {		
		require_once('./utils/user/userInformationFunctions.php');
		
		$idOrder = insertData('insert into tblorder (CUST_ID) values (?)', 
		array($user['CUST_ID']));
		
		foreach ($pizzaArray as &$pizza) {			
			$dough = addslashes(trim($pizza['PIZZA_DOUGH']));
			$sauce = addslashes(trim($pizza['PIZZA_SAUCE']));
			$cheese = addslashes(trim($pizza['PIZZA_CHEESE']));        
			$postData = array($dough, $sauce, $cheese);
	
			$count = 1;
			foreach ($pizza['PIZZA_TOPPING'] as &$value) {
				$postData[] = addslashes(trim($value));
				$count++;
			}
	
			for ($i = $count; $i < 6; $i++) {
				$postData[] = null;
			}
			// var_dump($postData);
			$idPizza = insertData('insert into tblpizza (PIZZA_DOUGH, PIZZA_SAUCE, PIZZA_CHEESE, PIZZA_TOPPING1, PIZZA_TOPPING2, PIZZA_TOPPING3, PIZZA_TOPPING4, PIZZA_TOPPING5) 
			values (?, ?, ?, ?, ?, ?, ?, ?)', 
			$postData);

			insertData('insert into order_pizza (ORD_ID, PIZZA_ID) values (?, ?)', 
			array($idOrder, $idPizza)); 
		}
		return $idOrder;		
	}
?>