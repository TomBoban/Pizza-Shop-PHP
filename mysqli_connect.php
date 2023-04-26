<?php
        // vaibhav rudani(8810171), niki soni(8806834)
        $host = "localhost:3306";
$username = "root";
$pass = "";
$db = "pizza_store";

$conn = mysqli_connect($host, $username, $pass, $db) or die('database connection fail: ' . mysqli_connect_error());