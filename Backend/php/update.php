<?php

require "../function/function.php";

$pdo=new PDO('mysql:host=localhost;port=3306;dbname=e-shop','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$id=$_GET['id']??null;
if(!$id){
    header('Location:view list.php');
    exit;
}
$statement=$pdo->prepare('SELECT * FROM products WHERE ID=:id');
$statement->bindValue(':id',$id);
$statement->execute();
$products=$statement->fetch(PDO::FETCH_ASSOC);

$errors=[]; 
$id=$products['ID'];
$title=$products['Title'];
$price=$products['Price'];
$description=$products['Description'];
if($_SERVER['REQUEST_METHOD']==='POST')
{
    $id=$_POST['pid'];
    $title=$_POST["ptitle"];
    $description=$_POST["pdescription"];
    $price=$_POST["pprice"];
    $date=date('Y-m-d H:i:s');

    if(!$id)
    {
      $error[]='Product ID is required';
    }
    if(!$title){
      $errors[]='Product title is required';
    }
    if(!$price){
      $errors[]='Product price is required';
    }
    if(!is_dir('../../images')){
      mkdir('../../images');
    }
   
    if (empty($errors)){
      $image=$_FILES['image']??null;
      $imagePath=$products['Thumbnail'];
      if($image && $image['tmp_name']){
        if($products['Thumbnail']){
            unlink($products['Thumbnail']);
        }
        $imagePath='../../images/'.randomstring(8).'/'.$image['name'];
        mkdir(dirname($imagePath));
        move_uploaded_file($image['tmp_name'],$imagePath);
      }
      
      $statement=$pdo->prepare("UPDATE products SET ID=:id,
      Title=:title,Description=:description,Thumbnail=:image,Price=:price,Date=:date WHERE ID=:id");

      $statement->bindValue(':id',$id);
      $statement->bindValue(':title',$title);
      $statement->bindValue(':description',$description);
      $statement->bindValue(':image',$imagePath);
      $statement->bindValue(':price',$price);
      $statement->bindValue(':date',$date);
      $statement->execute(); 
      
    }

    header('Location:view list.php');
}



?>

<?php include_once "../html/htmlHeader.php"?>
<?php if(!empty($errors)):?>
<div>
  <?php foreach ($errors as $error):?>
    <div><?php echo $error ?></div>
  <?php endforeach;?>
</div>
<?php endif; ?>
<div class="flex justify-center bg-gray-400 pt-2">
  <form action="" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 space-y-5 w-80 items-center">
  <a type="button" href="Admin.php" class="shadow bg-black hover:bg-white-700 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Back</a>
    <h1 class="text-3xl text-center">Update product <?php echo $products['Title']?></h2>
    <input type="Number" id="id" name="pid" value="<?php echo $id?>" class="border-blackshadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="ID" autofocus>
    <input type="text" id="title" name="ptitle" value="<?php echo $title ?>" class="border-blackshadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Title" autofocus>
    <textarea type="text" id="description" name="pdescription" class="border-blackshadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Description"><?php echo $description ?></textarea>  
    <input type="Number" id="pid" name="pprice" value="<?php echo $price ?>" class="border-blackshadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Price">

    <input type="file" name="image">

    <input type="submit" value="Submit" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">   
  </form>        
  
</div>


</body>
</html>