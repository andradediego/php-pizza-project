<?php
    require_once('./utils/session.php');
    
    if (!$_SESSION['islogged'] || $_SESSION['user'] == null) {
        header("Location:index.php");
    }

    // load all variables
    require_once('./utils/doughs.php');
    require_once('./utils/sauces.php');
    require_once('./utils/toppings.php');
    require_once('./utils/cheeses.php');
    
    // var_dump($_POST);
    $errors = null;
    if (isset($_SESSION['errorsOrder']) && count($_SESSION['errorsOrder']) > 0) {
        // var_dump($_SESSION['errorsOrder']);
        $errors = $_SESSION['errorsOrder'];
        unset($_SESSION['errorsOrder']);
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
    
    <?php echo '<input type="hidden" name="orders-cart" id="orders-cart" value="'.count($_SESSION['orders']).'">'; ?>
        <div class="row">
            <div class="col-sm-12 col-md-offset-4 col-md-4">
                <form id="order-form" method="post">
                    <div class="<?php echo $errors['PIZZA_DOUGH'] ? 'form-group has-error' : 'form-group' ?>">
                        <label for="PIZZA_DOUGH">Dough</label>
                        <select class="form-control" name="PIZZA_DOUGH" id="PIZZA_DOUGH">
                            <option value="">Please select</option>
                            <?php
                                foreach ($doughs as $dough) {
                                    echo '<option value="' . $dough. '">' . $dough . '</option>';
                                }	
                            ?>										
                        </select>
                        <?php echo $errors['PIZZA_DOUGH'] ? '<span class="help-block">Please select the type of dough!</span>' : '' ?> 
                    </div>

                    <div class="<?php echo $errors['PIZZA_SAUCE'] ? 'form-group has-error' : 'form-group' ?>">
                        <label for="PIZZA_SAUCE">Sauce</label>
                        <select class="form-control" name="PIZZA_SAUCE" id="PIZZA_SAUCE">
                            <option value="">Please select</option>
                            <?php
                                foreach ($sauces as $sauce) {
                                    echo '<option value="' . $sauce. '">' . $sauce . '</option>';
                                }	
                            ?>										
                        </select>
                        <?php echo $errors['PIZZA_SAUCE'] ? '<span class="help-block">Please select the type of sauce!</span>' : '' ?> 
                    </div>
                    <div class="<?php echo $errors['PIZZA_CHEESE'] ? 'form-group has-error' : 'form-group' ?>">
                        <label for="PIZZA_CHEESE">Cheese</label>
                        <select class="form-control" name="PIZZA_CHEESE" id="PIZZA_CHEESE">
                            <option value="">Please select</option>
                            <?php
                                foreach ($cheeses as $cheese) {
                                    echo '<option value="' . $cheese. '">' . $cheese . '</option>';
                                }	
                            ?>										
                        </select>
                        <?php echo $errors['PIZZA_CHEESE'] ? '<span class="help-block">Please select the type of cheese!</span>' : '' ?> 
                    </div>
                    <h5 class="text-center"><strong>Toppings</strong></h5>
                    <?php echo $errors['PIZZA_TOPPING'] ? '<h4 class="help-block has error">Please select at least one topic!</h4>' : '' ?> 	
                    <?php
                        foreach ($toppings as $topping) {
                        echo '<div class="classCheckbox">
                                
                                <label>
                                    <input type="checkbox" name="PIZZA_TOPPING[]" value="' . $topping . '"> ' . $topping . '
                                </label>
                            </div>';
                        }	

                        if (count($_SESSION['orders']) > 0) {
                            echo '<hr>';
                            $orders = $_SESSION['orders'];
                            $countPizza = 1;  
                            foreach ($orders as &$pizza) {   
                                // var_dump($pizza);
                                // var_dump($pizza['PIZZA_DOUGH']);
                                $toppings = '';
                                                              
                                foreach ($pizza['PIZZA_TOPPING'] as &$topping) {
                                    $toppings = $toppings . '<li><em>'. $topping .'</em></li>';                                    
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
                                    $countPizza++;
                            }
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
            e.preventDefault();
            
            var toppingSelected = $("input[name='PIZZA_TOPPING[]']:checkbox:checked");
            if ($('#orders-cart').val() > 0) {
                $('#order-form').attr('action', "orderPizzaNow.php").submit();
            } else if (toppingSelected.length < 1) {
                alert('Selected at least 1 topping!');
            } else if (toppingSelected.length > 6) {
                alert('The maximum topping allowed is 5!');                
            } else {
                $('#order-form').attr('action', "orderPizzaNow.php").submit();
            }
        });

        $('#btn-add-pizza').on('click', function(e) {
            e.preventDefault();
            var toppingSelected = $("input[name='PIZZA_TOPPING[]']:checkbox:checked");
            if (toppingSelected.length < 1) {
                alert('Selected at least 1 topping!');
                
            } else if (toppingSelected.length > 6) {
                alert('The maximum topping allowed is 5!');                
            } else {
                $('#order-form').attr('action', "addPizzaOrder.php").submit();
            }
        });
    </script>
</body>
</html>