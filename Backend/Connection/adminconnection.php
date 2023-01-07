<?php

$severname="localhost";
$username="root";
$password="";
$dbname="e-shop";


$connection=new mysqli($severname,$username,$password,$dbname);

if ($connection->connect_error) {
  die("Connection failed" . $connection->connect_error);
}
?>