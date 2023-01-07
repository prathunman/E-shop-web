<?php
include_once "../Connection/adminconnection.php";
$id=$_POST['id']??null;

if(!$id){
}


$selecquery="SELECT * FROM products WHERE ID=$id";

$result=mysqli_query($connection,$selecquery);
if ($result) {
    while ($row = mysqli_fetch_row($result)) 
    {
        unlink($row[3]);
    }
    mysqli_free_result($result);
}

$sqlQuery="DELETE FROM products WHERE ID=$id";
mysqli_query($connection,$sqlQuery);

header('Location: view list.php')
?>