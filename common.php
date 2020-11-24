<?php 
    define('DBHOST', 'localhost');
    define('DBDB', 'pizza_store');
    define('DBUSER', 'root');
    define('DBPW', '');

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