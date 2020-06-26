<?php
    $dsn = 'mysql:host=localhost:3308;dbname=comp1006_summer2020';
    $username = 'root';
    $password = ''; 
    $db = new PDO($dsn, $username, $password);
    //set error mode to exception 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>