<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName="products";

    // Create connection
    $con = new mysqli($servername, $username, $password,$dbName);



    // Check connection
    if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
    }



    if($_SERVER["REQUEST_METHOD"]==="POST")
    {
        $ID=$_POST['ID'];
        $Title= $_POST['Title'];
        $Description=$_POST['Description'];
        $Thumbnail=$_POST['Thumbnail'];
        $Price=$_POST['Price'];
        $sql = "INSERT INTO product(ID,Title,Description,Thumbnail,Price)VALUES('$ID','$Title','$Description','$Thumbnail','$Price')";
        if (mysqli_query($con, $sql)) {
            echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }

    else{
        echo "error";
    }
    
?>