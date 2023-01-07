<?php
include_once "../connection/dbconnection.php";

if(isset($_POST['addtocart']))
{
    $ptitle=$_POST['product_title'];
    $pid=$_POST['product_id'];
    $pprice=$_POST['product_price'];
    $pimg=$_POST['product_img'];

    $sqlquery="SELECT * FROM order_list WHERE PTitle='$ptitle'";
    $selectCart=mysqli_query($connection,$sqlquery);

    if(mysqli_num_rows($selectCart)>0){
        $message[]="Product is already added";
    }
    else{
        $addcart="INSERT INTO order_list (PID,PTitle,PPrice,PThumbnail) VALUES('$pid','$ptitle','$pprice','$pimg')";
        mysqli_query($connection,$addcart);
        $message[]="Product add successfully";
    }
    header('Location:user.php');
    exit();
}




?>