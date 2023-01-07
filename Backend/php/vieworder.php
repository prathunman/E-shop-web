<?php
include_once "../Connection/adminconnection.php";
include_once "../html/header.php";



$sqlquery='SELECT * FROM order_list';
$result = $connection->query($sqlquery);
?>

<div class="flex flex-wrap relative mb-5 justify-center bg-gray-900 pt-5 pb-5">
    <h1 class="text-white text-4xl font-bold text-center">Order List</h1>
</div>
<div class="flex items-center">
  <div class="container ml-auto mr-auto flex flex-wrap items-start">
    <?php 
        if ($result->num_rows > 0) {
            while($products = $result->fetch_assoc()){?>
        <div class="w-full md:w-1/2 lg:w-1/4 pl-5 pr-5 mb-5 lg:pl-2 lg:pr-2">
            <div class="bg-white rounded-lg m-h-64 p-2 transform hover:translate-y-2 hover:shadow-xl transition duration-300 flex flex-row">
            <figure class="mb-2">
                <img
                src="<?php echo $products['PThumbnail']?>"
                alt="<?php echo $products['PTitle']?>"
                class="h-20"
                />
            </figure>
            <div class="rounded-lg p-4 bg-gray-700 flex flex-row space-x-4 items-center">
                <div>
                    <h5 class="text-white text-2xl font-bold leading-none">
                        <?php echo $products['PTitle'] ?>
                    </h5>
                </div>
                <div>
                    <div class="text-xl text-white font-bold text-2xl ">$<?php echo $products['PPrice'] ?></div>
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
    document.title='View order';
</script>