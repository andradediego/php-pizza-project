<?php
require_once('./utils/session.php');

if (!$_SESSION['islogged'] || $_SESSION['user'] == null) {
	header("Location:index.php");
}

if (isset($_POST['PIZZA_DOUGH']) && isset($_POST['PIZZA_SAUCE']) && isset($_POST['PIZZA_CHEESE']) && isset($_POST['PIZZA_TOPPING'])
&& strlen(trim($_POST['PIZZA_DOUGH'])) > 0 && strlen(trim($_POST['PIZZA_SAUCE'])) > 0 && strlen(trim($_POST['PIZZA_CHEESE'])) > 0
&& (count($_POST['PIZZA_TOPPING']) > 0 && count($_POST['PIZZA_TOPPING']) < 6)) {
	
	$_SESSION['orders'][] = $_POST;            
	header("Location:orderpizza.php");
	
} else {
	
}
?>