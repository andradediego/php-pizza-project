<?php
    require_once('./utils/session.php');
    

    // var_dump($_SESSION['user']);

    if (!$_SESSION['islogged']) {
        header("Location:index.php");
    }

    // load all variables
    require_once('./utils/doughs.php');
    require_once('./utils/sauces.php');
    require_once('./utils/toppings.php');
    require_once('./utils/cheeses.php');

    require_once('./utils/order/orderPizzaData.php');

    // tblorder
    // tblpizza
    // order_pizza
    // var_dump($_POST);
    if (isset($_POST['PIZZA_DOUGH']) && isset($_POST['PIZZA_SAUCE']) && isset($_POST['PIZZA_CHEESE']) && isset($_POST['PIZZA_TOPPING'])
    && strlen(trim($_POST['PIZZA_DOUGH'])) > 0 && strlen(trim($_POST['PIZZA_SAUCE'])) > 0 && strlen(trim($_POST['PIZZA_CHEESE'])) > 0
    && (count($_POST['PIZZA_TOPPING']) > 0 && count($_POST['PIZZA_TOPPING']) < 6)) {
        
        require_once('./utils/user/userInformationFunctions.php');

        $user = $_SESSION['user'];
        // var_dump($user);

        $idOrder = insertData('insert into tblorder (CUST_ID) values (?)', 
        array($user['CUST_ID']));        
        // var_dump($idOrder);

        $dough = addslashes(trim($_POST['PIZZA_DOUGH']));
        $sauce = addslashes(trim($_POST['PIZZA_SAUCE']));
        $cheese = addslashes(trim($_POST['PIZZA_CHEESE']));        
        $postData = array($dough, $sauce, $cheese);

        $count = 1;
        foreach ($_POST['PIZZA_TOPPING'] as &$value) {
            $postData[] = addslashes(trim($value));
            $count++;
        }

        for ($i = $count; $i < 6; $i++) {
            $postData[] = null;
        }
        // var_dump($postData);
        $idPizza = insertData('insert into tblpizza (PIZZA_DOUGH, PIZZA_SAUCE, PIZZA_CHEESE, PIZZA_TOPPING1, PIZZA_TOPPING2, PIZZA_TOPPING3, PIZZA_TOPPING4, PIZZA_TOPPING5) values (?, ?, ?, ?, ?, ?, ?, ?)', 
        $postData);
        
        insertData('insert into order_pizza (ORD_ID, PIZZA_ID) values (?, ?)', 
        array($idOrder, $idPizza)); 
        $_SESSION['ORD_ID'] = $idOrder;        
        header("Location:orderSummary.php");
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
                <form action="orderpizza.php" method="post">
                    <div class="form-group">
                        <label for="PIZZA_DOUGH">Dough</label>
                        <select class="form-control" name="PIZZA_DOUGH" id="PIZZA_DOUGH">
                            <option value="">Please select</option>
                            <?php
                                foreach ($doughs as $dough) {
                                    echo '<option value="' . $dough. '">' . $dough . '</option>';
                                }	
                            ?>										
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="PIZZA_SAUCE">Sauce</label>
                        <select class="form-control" name="PIZZA_SAUCE" id="PIZZA_SAUCE">
                            <option value="">Please select</option>
                            <?php
                                foreach ($sauces as $sauce) {
                                    echo '<option value="' . $sauce. '">' . $sauce . '</option>';
                                }	
                            ?>										
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="PIZZA_CHEESE">Cheese</label>
                        <select class="form-control" name="PIZZA_CHEESE" id="PIZZA_CHEESE">
                            <option value="">Please select</option>
                            <?php
                                foreach ($cheeses as $cheese) {
                                    echo '<option value="' . $cheese. '">' . $cheese . '</option>';
                                }	
                            ?>										
                        </select>
                    </div>	
                    <?php
                        foreach ($toppings as $topping) {
                        echo '<div class="classCheckbox">
                                <label>
                                    <input type="checkbox" name="PIZZA_TOPPING[]" value="' . $topping . '">' . $topping . '
                                </label>
                            </div>';
                        }	
                    ?>
                   	<hr>
                    <button type="button" id="btn-add-pizza" class="btn btn-primary btn-block">Add Another Pizza</button>   
                    <button type="submit" id="btn-order-now" class="btn btn-success btn-block">Order Now</button>
                </form> 
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $("input[name='PIZZA_TOPPING[]']").on('click', function (e) {            
            if ($("input[name='PIZZA_TOPPING[]']:checkbox:checked").length > 5) {
                alert('The maximum topping allowed is 5!');
                $(this).prop('checked', false);
            }
        });

        $('#btn-order-now').on('click', function(e) {
            var toppingSelected = $("input[name='PIZZA_TOPPING[]']:checkbox:checked");
            if (toppingSelected.length < 1) {
                alert('Selected at least 1 topping!');
                e.preventDefault();
            } else if (toppingSelected.length > 6) {
                alert('The maximum topping allowed is 5!');
                e.preventDefault();
            }
        });
    </script>
</body>
</html>