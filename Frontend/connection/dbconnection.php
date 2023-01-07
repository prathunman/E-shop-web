<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName="e-shop";

// Create connection
$connection = new mysqli($servername, $username, $password,$dbName);


// Check connection
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}



?>