<?php
    require_once('./utils/session.php');

    if (!$_SESSION['islogged'] || $_SESSION['user'] == null) {
        header("Location:index.php");
    }

    require_once('./utils/user/userInformationFunctions.php');
    
    $query = '
    select    
    t.ORD_ID, 
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
    WHERE t.CUST_ID = ?';
    $user = $_SESSION['user'];
    $pizzas = getMultipleData($query, array($user['CUST_ID']));
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
                    $pizzaOrder = 0;
                    $orderId = '';
                    foreach ($pizzas as &$pizza) {                        
                        $toppings = '';
                        
                        $count = 1;
                        while ($pizza['PIZZA_TOPPING' . $count] != null) {
                            $toppings = $toppings . '<li><em>'. $pizza['PIZZA_TOPPING' . $count] .'</em></li>';
                            $count++;
                        }                        
                        if ($orderId != $pizza['ORD_ID']) {
                            $orderId = $pizza['ORD_ID'];
                            $pizzaOrder++;
                            echo 
                            '<hr>
                            <div class="text-center">
                                <form action="orderAgain.php" method="post">
                                    <input type="hidden" name="ORDER_NUMBER" value ="'.$pizza['ORD_ID'].'">
                                    <button class="btn btn-primary" value="" type="submit">Order Again</button>
                                </form>
                            </div>';
                        }
                        echo 
                            '<ul>
                                <li>
                                    Order '.$pizzaOrder.'
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
                ?>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>