<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pet_store/product_page.css">
    <script src="js/side_menubar.js" defer></script>
    <script src="js/main.js" defer></script>
    <script src="js/user_profile/my_cart/cart_script.js" defer></script>
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">


    <title>Pet Store</title>

    <style>
        .content {
            height: 100vh;
        }
    </style>
</head>
<body>
    <?php require 'include/header.php' ?>

    <div class="content">

    <?php
        require 'process/connect_dbshop.php';

        function createRatingString($rating) {
            $string = "";
            for ($i = 0; $i < $rating; $i++) {
                $string .= "⭐";
            }

            return $string;
        }

        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if(isset($_GET['section'])) {
                $section = $_GET['section'];
                $product_type;
                $heading = "";

                switch($section) {
                    case 'food': $product_type = "pet_food";
                                 $heading = "Food";
                                 break;
                    case 'health': $product_type = "pet_care";
                                   $heading = "Pet Care";
                                   break;

                    case 'treat': $product_type = "pet_treat";
                                  $heading = "Pet Treats";
                                  break;

                }

    ?>
                <h1><?php echo $heading ?> Section</h1>
    <?php

                $query = "select * from product_data where product_type='$product_type'";
                $results = $conn->query($query);

                if ($results->num_rows > 0) {
                    while ($row = $results->fetch_assoc()) {
                        $product_id = $row['product_id'];
                        $product_name = $row['product_name'];
                        $product_price = $row['product_price'];
                        $product_rating = $row['product_rating'];
                        $product_image = $row['product_image_path'];

                        $rating_y = (int)$product_rating;
                        $rating_b = 5 - (int)$product_rating;

                        ?>                  
                        <div class="product-card">
                            <!-- <a href="product" class="product-link"> -->
                                <img src="assets/images/product_images/<?php echo $product_image?>" alt="" class="product-image">
                                <div class="product-info">
                                    <h2 class="product-name"><?php echo $product_name?></h2>
                                    <span class="product-rating"><span class="rating-yellow"><?php echo createRatingString($rating_y)?></span></span>
                                    <p class="product-price">Rs.<?php echo $product_price?></p>
                                </div>
                            <!-- </a> -->
                            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
                            ?>
                                <button class="add-to-cart-btn" onclick="addToCart(<?php echo $product_id ?>)">Add To cart</button>
                            <?php
                            }
                            ?>
                        </div>  
                        
    <?php
                    }

                } else {
                    echo "<h2>No Products</h2>";
                }
            }
        }
     ?>

    

    </div>

    <?php require 'include/footer.php' ?>
</body>
</html>