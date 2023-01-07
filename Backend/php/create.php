<?php

include_once "../Connection/adminconnection.php";
include_once "../function/function.php";
$errors=[]; 

if($_SERVER["REQUEST_METHOD"]==="POST") 
{
    $ID=$_POST["pid"];
    $title=$_POST["ptitile"];
    $description=$_POST["pdescription"];
    $price=$_POST["pprice"];
    $date=date('Y-m-d H:i:s');

       
    if(!$title){
      $errors[]='Product title is required';
    }
    if(!$price){
      $errors[]='Product price is required';
    }
    if(!is_dir('../../images')){
      mkdir('../../images');
    }
    $imagePath='';
    if (empty($errors)){
      $image=$_FILES['image']??null;
      
      if($image){

        $imagePath='../../images/'.randomstring(8).'/'.$image['name'];
        mkdir(dirname($imagePath));
        move_uploaded_file($image['tmp_name'],$imagePath);
      }
    }

    $sqlQuery="INSERT INTO products (ID,Thumbnail,Title,Description,Price,Date) 
    VALUES('$ID','$imagePath','$title','$description','$price','$date')";
    if (mysqli_query($connection, $sqlQuery)) {
        echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Create product</title>
</head>
<body class="bg-black">
<div class="flex content-center justify-center mt-10">
  <form action="" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 space-y-5 w-80 items-center">
  <a type="button" href="Admin.php" class="text-gray-900 hover:text-white border border-gray-600 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-small rounded-lg text-sm px-5 py-1 text-center dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Back</a>
    <h1 class="text-4xl text-center">New product</h2>
    <input type="Number" id="id" name="pid" class="border-blackshadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="ID" autofocus>
    <input type="text" id="title" name="ptitile" class="border-blackshadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Title" autofocus>
    <textarea type="text" id="description" name="pdescription" class="border-blackshadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Description"></textarea>  
    <input type="Number" id="pid" name="pprice" class="border-blackshadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Price">
    <input type="file"  name="image">

    <input type="submit" value="Submit" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">   
  </form>        
  
</div>
</body>
</html>