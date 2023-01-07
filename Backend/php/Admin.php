<?php

    include_once "../Connection/adminconnection.php";

    session_start();
    if(!isset($_SESSION['AdminID']))
    {
        header('location:signin.php');
    }
    $sqlquery='SELECT * FROM products ORDER BY Date DESC';
    $result = $connection->query($sqlquery);


    if(isset($_POST['logout']))
    {
        session_destroy();
        header('location: signin.php');
    }
?>


<?php include_once "../html/backendadmin.php"?>

<section>
  <div class="flex items-center">
  <div class="container ml-auto mr-auto flex flex-wrap items-start">
    <?php 
        if ($result->num_rows > 0) {
            while($products = $result->fetch_assoc()){?>
        <div class="w-full md:w-1/2 lg:w-1/4 pl-5 pr-5 mb-5 lg:pl-2 lg:pr-2">
            <div class="bg-white rounded-lg m-h-64 p-2 transform hover:translate-y-2 hover:shadow-xl transition duration-300">
            <figure class="mb-2">
                <img
                src="<?php echo $products['Thumbnail']?>"
                alt="<?php echo $products['Title']?>"
                class="h-64 ml-auto mr-auto"
                />
            </figure>
            <div class="rounded-lg p-4 bg-gray-700 flex flex-col">
                <div class="text-center">
                    <h5 class="text-white text-2xl font-bold leading-none">
                        <?php echo $products['Title'] ?>
                    </h5>
                    <span class="text-lg text-gray-400 leading-none"><?php echo $products['Description'] ?></span>
                </div>
                <div class="flex items-center">
                    <div class="text-xl text-white font-bold text-xl ">$<?php echo $products['Price'] ?></div>
                </div>
            </div>
            </div>
        </div>
        <?php }
    } 
    else {
        echo "0 results";
    }
    $connection->close();
    ?>
  </div>
    </div>
</section>


<script src="../Javascript/upload.js"></script>
</body>
</html>
