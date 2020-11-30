<?php
	require_once('./utils/session.php');

	if (!$_SESSION['islogged'] || $_SESSION['user'] == null) {
		header("Location:index.php");
	}

	if (isset($_POST['ORDER_NUMBER']) && strlen(trim($_POST['ORDER_NUMBER'])) > 0) {		
		require_once('./utils/user/userInformationFunctions.php');
		
		$orderNumber = $_POST['ORDER_NUMBER'];
		
		// unset($_SESSION['orders']);
		
		$user = $_SESSION['user'];

		$query = '
    select        
    p.PIZZA_DOUGH, 
    p.PIZZA_SAUCE, 
    p.PIZZA_CHEESE, 
    p.PIZZA_TOPPING1, 
    p.PIZZA_TOPPING2, 
    p.PIZZA_TOPPING3, 
    p.PIZZA_TOPPING4, 
    p.PIZZA_TOPPING5 
    from 
        tblpizza p 
        join order_pizza o 
            on o.PIZZA_ID = p.PIZZA_ID 
        join tblorder t
            on t.ORD_ID = o.ORD_ID 
    WHERE o.ORD_ID = ?';
    $user = $_SESSION['user'];
		$pizzaArray = getMultipleData($query, array($orderNumber));

		$idOrder = insertData('insert into tblorder (CUST_ID) values (?)', 
		array($user['CUST_ID']));

		foreach ($pizzaArray as &$pizza) {			
			$dough = trim($pizza['PIZZA_DOUGH']);
			$sauce = trim($pizza['PIZZA_SAUCE']);
			$cheese = trim($pizza['PIZZA_CHEESE']);        
			$topping1 = trim($pizza['PIZZA_TOPPING1']);        
			$topping2 = trim($pizza['PIZZA_TOPPING2']);        
			$topping3 = trim($pizza['PIZZA_TOPPING3']);        
			$topping4 = trim($pizza['PIZZA_TOPPING4']);        
			$topping5 = trim($pizza['PIZZA_TOPPING5']);        
			$postData = array($dough, $sauce, $cheese, $topping1, $topping2, $topping3, $topping4, $topping5);
			// var_dump($postData);
			$idPizza = insertData('insert into tblpizza (PIZZA_DOUGH, PIZZA_SAUCE, PIZZA_CHEESE, PIZZA_TOPPING1, PIZZA_TOPPING2, PIZZA_TOPPING3, PIZZA_TOPPING4, PIZZA_TOPPING5) 
			values (?, ?, ?, ?, ?, ?, ?, ?)', 
			$postData);

			insertData('insert into order_pizza (ORD_ID, PIZZA_ID) values (?, ?)', 
			array($idOrder, $idPizza)); 
		}	

		$_SESSION['ORD_ID'] = $idOrder; 		
		header("Location:orderSummary.php");
	} else {
		// header("Location:index.php");
	}
	
?>