<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test1";

try{
    //connect database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);

    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

?>