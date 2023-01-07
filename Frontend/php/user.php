
<?php

include_once "../connection/dbconnection.php";


session_start();
if(!isset($_SESSION['UserID']))
{
    header('location:login.php');
}

$sqlquery='SELECT * FROM products ORDER BY Date DESC';
$result = $connection->query($sqlquery);








if(isset($_POST['logout']))
{
    session_destroy();
    header('location: login.php');
    exit();
}

// Check connection
if ($connection->connect_error) {
  die("Connection failed: " . $con->connect_error);
}



include_once "../html/indexFront.php";
?>



<nav id="header" class="bg-yellow-500 w-full z-10 top-0 shadow">

    <div class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-2 pb-2 md:pb-0">

        <div class="w-1/2 pl-2 md:pl-5 md:pb-4 text-4xl text-violet-800 font-bold">
            <h4>E-SHOP</h4>
        </div>

        <div class="w-1/2 pr-0">
            <div class="flex relative inline-block float-right">
                <div class="relative text-sm">
                    <button id="userButton" class="flex items-center focus:outline-none mr-3 pt-2">
                        <img class="w-10 h-10 rounded-full bg-white mb-4 mr-2" src="../resourse/account.svg" alt="user photo">
                    </button>
                    <div id="userMenu" class="bg-white rounded shadow-md mt-2 absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 invisible">
                        <ul class="list-reset">
                            <li><a href="#" class="px-4 py-2 block text-gray-900 hover:bg-gray-400 no-underline hover:no-underline">My account</a></li>
                            <li><a href="#" class="px-4 py-2 block text-gray-900 hover:bg-gray-400 no-underline hover:no-underline">Notifications</a></li>
                            <li>
                                <hr class="border-t mx-2 border-gray-400">
                            </li>
                            <li>
                                <form method="post" action="user.php">
                                    <button type="submit" name="logout" class="px-4 py-2 block text-gray-900 hover:bg-gray-400 no-underline hover:no-underline">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="block lg:hidden pr-4">
                    <button id="nav-toggle" class="flex items-center px-3 py-2 mt-3 border rounded text-gray-500 border-gray-600 hover:text-green-800 hover:border-teal-500 appearance-none focus:outline-none">
                        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>Menu</title>
                            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>


        <div class="bg-black w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 z-20" id="nav-content">
            <ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0 text-white ml-4">
                <li class="mr-6 my-2 md:my-0">
                    <a href="user.php" class="block py-1 md:py-3 pl-1 align-middle  no-underline hover:text-green-800 border-b-2 hover:border-green-600">
                        <i class="fas fa-home fa-fw mr-3 "></i><span class="pb-1 md:pb-0 text-sm">Home</span>
                    </a>
                </li>
                <li class="mr-6 my-2 md:my-0">
                    <a href="purchase.php" class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-green-800 border-b-2 border-white hover:border-green-600">
                        Purchase
                    </a>
                </li>
                <li class="mr-6 my-2 md:my-0">
                    <a href="#" class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-green-800 border-b-2 border-white hover:border-green-600">
                        Messages
                    </a>
                </li>
                <li class="mr-6 my-2 md:my-0">
                    <a href="#" class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-green-800 border-b-2 border-white hover:border-green-600">
                        Customer Service
                    </a>
                </li>
                <li class="mr-6 my-2 md:my-0">
                    <a href="#" class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-green-800 border-b-2 border-white hover:border-green-600">
                        Gift cards
                    </a>
                </li>
            </ul>

            <div class="relative pull-right pl-4 pr-4 md:pr-0 mr-4 mb-2 pt-2">
                <input type="search" placeholder="Search" class="w-full bg-gray-100 text-sm text-gray-800 transition border focus:outline-none focus:border-gray-700 rounded py-1 px-2 pl-10 appearance-none leading-normal">
                <div class="absolute search-icon" style="top: 0.375rem;left: 1.75rem;">
                    <img class="w-5 h-5 mb-2 ml-0 mt-2" src="../resourse/search.svg" alt="search">
                </div>
            </div>

        </div>

    </div>
</nav>
<section>
    <div class="flex items-center mt-8">
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
                    <form action="addtocart.php" method="post">
                        <div class="rounded-lg p-4 bg-blue-800 flex flex-col">
                            <div class="text-center">
                                <h5 class="text-white text-2xl font-bold leading-none">
                                    <?php echo $products['Title'] ?>
                                </h5>
                                <input type="hidden" value="<?php echo $products['Thumbnail'] ?>" name="product_img">
                                <input type="hidden" value="<?php echo $products['ID'] ?>" name="product_id">
                                <input type="hidden" value="<?php echo $products['Title'] ?>" name="product_title">
                                <span class="text-lg text-gray-400 leading-none"><?php echo $products['Description'] ?></span>
                            </div>
                            <div class="flex items-center">
                                <h6 class="text-xl text-yellow-500 font-bold text-xl ">$<?php echo $products['Price'] ?></h6>
                                <input type="hidden" value="<?php echo $products['Price'] ?>" name="product_price">
                                <button name="addtocart"
                                class="rounded-full bg-purple-900 text-white hover:bg-white hover:text-purple-900 hover:shadow-xl focus:outline-none w-10 h-10 flex ml-auto transition duration-300">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="28"
                                        height="28"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="stroke-current m-auto">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>

                            </div>           
                        </div>
                    </form>
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
    </div>
</section>

<footer class="bg-white border-t border-gray-400 shadow">
    
</footer>


<script>
    document.title="Dashboard";
</script>
<script src="../js/default.js"></script>
