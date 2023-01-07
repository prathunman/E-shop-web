<?php

    include_once "../Connection/adminconnection.php";

    $sqlquery='SELECT * FROM products ORDER BY Date DESC';
    $result = $connection->query($sqlquery);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewpoint" content="width=device-width,initial-scale=1">
<title>my site</title>
<link rel="stylesheet" href="">
<script src="https://cdn.tailwindcss.com"></script>    
<link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css" />
<script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>

</head>
<body>



<div class="overflow-x-auto relative shadow-md sm:rounded-lg">
    <div class="mb-5 mt-5">
        <a href="Admin.php" class=" ml-5 text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Back</a>
        <h1 class="text-4xl text-center">Products List</h1>
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    <span class="">ID</span>
                </th>
                <th scope="col" class="py-3 px-6">
                    <span class="sr-only">Image</span>
                </th>
                <th scope="col" class="py-3 px-6">
                    Product Title
                </th>
                <th scope="col" class="py-3 px-6">
                    Product Description
                </th>
                <th scope="col" class="py-3 px-6">
                    Price
                </th>
                <th scope="col" class="py-3 px-6" colspan="2">
                    Action
                </th>
            </tr>
        </thead>
        <tbody class="justify-center">
            <?php 
            if ($result->num_rows > 0) {
                while($products = $result->fetch_assoc()){?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="p-4 w-32">
                        <?php echo $products['ID']?>
                    </td>
                    <td class="p-4 w-32">
                        <img src="<?php echo $products['Thumbnail']?>" alt="<?php echo $products['Title'] ?>">
                    </td>
                    <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                        <?php echo $products['Title'] ?>
                    </td>
                    <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                        <?php echo $products['Description'] ?>
                    </td>
                    <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                        $<?php echo $products['Price'] ?>
                    </td>
                    <td class="flex space-x-2 justify-center py-4 px-6">
                        <a href="update.php?id=<?php echo $products['ID']?>" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Edit</a>
                        <form action="delete.php" method="post" style="display: inline-block;">
                            <input type="hidden" name="id" value="<?php echo $products['ID']?>">
                            <button type="submit" ?id=<?php echo $products['ID']?> class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php }
            } 
            else {
                echo "0 results";
            }
            $connection->close();
            ?>
        </tbody>
    </table>
</div>



</body>
</html>
