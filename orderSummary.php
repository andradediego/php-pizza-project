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
                <h4>(Email) ordered:</h4>
                <ul>
                    <li>
                        Pizza 1
                        <ul>
                            <li><strong>Dough:</strong> [dough]</li>
                            <li><strong>Sauce:</strong> [sauce]</li>
                            <li><strong>Cheese:</strong> [dough]</li>
                            <li>
                                <strong>Toppings</strong>
                                <ul>
                                    <li><em>Topping 1</em></li>
                                    <li><em>Topping 2</em></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>