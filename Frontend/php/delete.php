<?php
include_once "../connection/dbconnection.php";
$id=$_POST['id']??null;

if(!$id){
}

$sqlQuery="DELETE FROM order_list WHERE PID=$id";
mysqli_query($connection,$sqlQuery);

header('Location: purchase.php');
exit();
?>