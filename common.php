<?php 
    // defines for windows
    //define('DBHOST', 'localhost');
    //define('DBDB', 'pizza_store');
    //define('DBUSER', 'root');
    //define('DBPW', '');

    //defines for Linux
     define('DBHOST', 'localhost');
     define('DBDB', 'pizza_store');
     define('DBUSER', 'pizzauser');
     define('DBPW', 'pizza123');

    function connectDB() {
        $dsn = 'mysql:host='.DBHOST.';dbname='.DBDB.';charset=utf8';
        try {
            $db_conn = new PDO($dsn, DBUSER, DBPW);
            return $db_conn;
        } catch (PDOException $e) {
            echo '<p>Error opening database: '.$e->getMessage().'</p>';
            exit(1);
        }
    }
?>