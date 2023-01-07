<?php
include_once "../connection/dbconnection.php";

$sqlquery="SELECT * FROM order_list";
$result=mysqli_query($connection,$sqlquery);


include_once "../html/indexFront.php";
?>

<div class="flex flex-wrap relative mb-5 justify-center bg-gray-200">
    <h1 class="text-green-900 text-2xl font-bold text-center pt-5 pb-5">Chech out</h1>
</div>
<div class="flex items-center">
  <div class="container ml-auto mr-auto flex flex-wrap items-start">
    <?php 
        if ($result->num_rows > 0) {
            while($products = $result->fetch_assoc()){?>
        <div class="w-full md:w-1/2 lg:w-1/4 pl-5 pr-5 mb-5 lg:pl-2 lg:pr-2">
            <div class="bg-white rounded-lg m-h-64 p-2 transform hover:translate-y-2 hover:shadow-xl transition duration-300 flex flex-row">
            <figure class="flex items-center mb-2 ">
                <img
                src="<?php echo $products['PThumbnail']?>"
                alt="<?php echo $products['PTitle']?>"
                class="h-30"
                />
            </figure>
            <div class="rounded-lg p-4 bg-gray-700 flex space-x-4 items-center">
                <div>
                    <h5 class="text-white text-lg leading-none">
                        <?php echo $products['PTitle'] ?>
                    </h5>
                </div>
                <div>
                    <div class="text-xl text-yellow-600 font-bold text-2xl ">$<?php echo $products['PPrice'] ?></div>
                </div>
                <div>
                    <form action="delete.php" method="post" style="display: inline-block;">
                        <input type="hidden" name="id" value="<?php echo $products['PID']?>">
                        <button type="submit" ?id=<?php echo $products['PID']?> class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</button>
                    </form>
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

<script>
    document.title='Purchase';
</script>