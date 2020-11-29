<?php
    require_once('./utils/session.php');

    if (!isset($_SESSION['ORD_ID'])){
        header("Location:orderPizza.php");
    }

    require_once('./utils/user/userInformationFunctions.php');
    $query = 'select p.PIZZA_DOUGH, p.PIZZA_SAUCE, p.PIZZA_CHEESE, p.PIZZA_TOPPING1, p.PIZZA_TOPPING2, p.PIZZA_TOPPING3, 
    p.PIZZA_TOPPING4, p.PIZZA_TOPPING5 from tblpizza p join order_pizza o on o.PIZZA_ID = p.PIZZA_ID WHERE o.ORD_ID = ?';
    
    $pizzas = getMultipleData($query, array($_SESSION['ORD_ID']));    
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
                <?php
                    $user = $_SESSION['user'];
                    echo '<h4>'.$user['CUST_EMAIL'].' ordered:</h4>';
                    echo '<hr/>';
                    
                    foreach ($pizzas as &$pizza) {                        
                        $toppings = '';
                        $countPizza = 1;
                        $count = 1;
                        while ($pizza['PIZZA_TOPPING' . $count] != null) {
                            $toppings = $toppings . '<li><em>'. $pizza['PIZZA_TOPPING' . $count] .'</em></li>';
                            $count++;
                        }
                        echo 
                            '<ul>
                                <li>
                                    Pizza '.$countPizza.'
                                    <ul>
                                        <li><strong>Dough:</strong> '.$pizza['PIZZA_DOUGH'].'</li>
                                        <li><strong>Sauce:</strong> '.$pizza['PIZZA_SAUCE'].'</li>
                                        <li><strong>Cheese:</strong> '.$pizza['PIZZA_CHEESE'].'</li>
                                        <li>
                                            <strong>Toppings</strong>
                                            <ul>
                                                '.$toppings.'
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>';
                    }
                    echo 
                        '<p>
                            <em>Pizza will be ready in 40 minutes and will be delivered to Address: </em>
                            '.$user['CUST_ADDRESS'].', '.$user['CUST_CITY'].', '.$user['CUST_PROVINCE'].', '.$user['CUST_POSTALCODE'].'
                        </p>';
                ?>
                
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>