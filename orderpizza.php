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

    
    require_once('./common.php');
    $db_conn = connectDB();    

    

    if(isset($_POST['submit']))
    {   
        $PIZZA_DOUGH = $_POST['PIZZA_DOUGH'];
        $PIZZA_SAUCE = $_POST['PIZZA_SAUCE'];
        $PIZZA_CHEESE = $_POST['PIZZA_CHEESE'];
        
            $stmt= $db_conn->prepare('INSERT INTO TBLPIZZA (PIZZA_DOUGH, PIZZA_SAUCE, PIZZA_CHEESE)
            values(:PIZZA_DOUGH, :PIZZA_SAUCE, :PIZZA_CHEESE)');
            
            if (!$stmt){
                echo "Error ".$db_conn->errorCode()."\nMessage".implode($db_conn->errorInfo())."\n";
                exit(1);
            }

            $data = array(
                ":PIZZA_DOUGH" => $PIZZA_DOUGH, 
                ":PIZZA_SAUCE" => $PIZZA_SAUCE, 
                ":PIZZA_CHEESE" => $PIZZA_CHEESE
            );

            $status = $stmt->execute($data);
                        
            if(!$status){
                echo "Error ".$stmt->errorCode()
                ."\nMessage".implode($stmt->errorInfo())."\n";
                exit(1);
            }
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
                <form method="post">
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
                                    <input type="checkbox" name="PIZZA_TOPPING[ ]" value= "" ' . $topping . '">' . $topping . '
                                </label>
                            </div>';
                        }	
                    ?>
                   	<hr>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Add Another Pizza</button>   
                    <button type="submit" class="btn btn-success btn-block">Order Now</button>
                </form> 
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>