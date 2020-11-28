<?php
    // var_dump($_POST['username']);
    // user post
    require_once('./utils/session.php');

    if (isset($_POST['useremail'])) {
        $useremail = addslashes(trim($_POST['useremail']));

        require_once('./utils/user/userInformationFunctions.php');

        $user = getData('select * from TBLCUSTOMERS where CUST_EMAIL = ?', array($useremail));         

        if (!$user) {            
            insertData('insert into TBLCUSTOMERS (CUST_EMAIL) values (?)', array($useremail));
            $user = getData('select * from TBLCUSTOMERS where CUST_EMAIL = ?', array($useremail));
        } 
        
        $_SESSION['user'] = $user;
        // var_dump($_SESSION['user']);
        $_SESSION['islogged'] = true; 
        header("Location:orderpizza.php");
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
                <h2 class="text-center">Team Brazucas Pizzeria</h2>
                <p class="text-center">We welcome you to taste the best pizza in London Ontario</p>
            </div>
            <hr>
            <div class="col-sm-12 col-md-offset-4 col-md-4">                
                <p class="text-center">Please enter you e-mail to order online</p>
                <form action="index.php" method="post">
                    <div class="form-group">							
						<input type="email" name="useremail" class="form-control" id="useremail" placeholder="jane.doe@gmail.com">							
					</div>
                    <input type="submit" class="btn btn-block btn-success" id="btn-submit" value="Begin">
                </form>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>