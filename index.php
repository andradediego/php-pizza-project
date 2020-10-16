<?php
    if (isset($_POST['username'])) {
        $username = $_POST['username'];

        require_once('./common.php');

        $db_conn = connectDB();

        $stmt = $db_conn->prepare('select * from TBLCUSTOMERS where CUST_EMAIL = ?');
        if (!$stmt) {
            echo 'Error '.$dbc->errorCode().'\n Message '.implode($dbc->errorInfo()).'\n';
            exit(1);
        }

        $status = $stmt->execute([$username]); 
        
        if (!$status) {
            echo 'Error '.$stmt.errorCode().'\n Message'.implode($stmt->errorInfo()).'\n';
            exit(1);
        }  
        $user = $stmt->fetch();

        if (!$user) {
            $stmt = $db_conn->prepare('insert into TBLCUSTOMERS (CUST_EMAIL, CUST_NAME) values (?, ?)');

            if (!$stmt) {
                echo 'Error '.$dbc->errorCode().'\n Message '.implode($dbc->errorInfo()).'\n';
                exit(1);
            }

            $status = $stmt->execute(array($username, $username));

            if (!$status) {
                echo 'Error '.$stmt.errorCode().'\n Message'.implode($stmt->errorInfo()).'\n';
                exit(1);
            }  
        } else {
            header("Location:orderpizza.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzeria - Team Brazucas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-offset-4 col-md-4">
                <h2 class="text-center">Pizzeria Team Brazucas</h2>
                <p class="text-center">We welcome you to taste the best pizza in London Ontario</p>
            </div>
            <hr>
            <div class="col-sm-12 col-md-offset-4 col-md-4">                
                <p class="text-center">Please enter you e-mail to order online</p>
                <form action="index.php" method="post">
                    <div class="form-group">							
						<input type="email" name="username" class="form-control" id="username" placeholder="jane.doe@gmail.com">							
					</div>
                    <input type="submit" class="btn btn-block btn-success" id="btn-submit" value="Begin">
                </form>
            </div>
        </div>
    </div>
</body>
</html>