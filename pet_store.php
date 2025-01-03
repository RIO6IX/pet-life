<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pet_store/main.css">
    <script src="js/main.js" defer></script>
    <script src="js/pet_store/main.js" defer></script>
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">

    <title>Pet Store</title>
</head>
<body>
    <?php require 'include/header.php' ?>

    <div class="main-banner">
        <div class="wrapper">
            
            <div class="banner">
                <img src="assets/images/product_images/cat_food.jpeg" alt="">
                <p class="offer-info">Buy 1 Get 10% Off, Buy 2 Get 15% Off, Buy 3 Get 20% Off</p>
                <button>Learn More</button>
            </div>
    
            <div class="banner">
                <img src="assets/images/product_images/dog_food.jpeg" alt="">
                <p class="offer-info">New Year's Deal: 25% Off Large Bags of Dog/Cat Food</p>
                <button>Learn More</button>
            </div>

            <div class="banner">
                <img src="assets/images/product_images/dog_food.jpeg" alt="">
                <p class="offer-info">Celebrate Your Pet’s Birthday! 25% Off Pet Food</p>
                <button>Learn More</button>
            </div>

        </div>
    </div>

    <div class="sub-banner">
        <p>Clearance upto 50% off</p>
        <button>Learn More</button>
    </div>

    <h2 style="text-align:center;margin:30px 0;">Shop deals by the categories</h2>

    <div class="product-categories">
        <div class="category">
            <img src="assets/images/product_images/cat_food.jpeg" alt="">
            <a href="pet_store_products.php?section=food"><button>Food</button></a>
        </div>
        <div class="category">
            <img src="assets/images/product_images/cat_food.jpeg" alt="">
            <a href="pet_store_products.php?section=health"><button>Pet Care</button></a>
        </div>
        <div class="category">
            <img src="assets/images/product_images/cat_food.jpeg" alt="">
            <a href="pet_store_products.php?section=treat"><button>Treats</button></a>
        </div>
    </div>

    <section class="card-slider">
        <div class="slider-container">
            <button id="prevBtn" class="nav-btn">Prev</button>
            <div class="slider" id="slider">
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                <div class="product">
                    <img src="assets/images/logo.jpeg" alt="" class="product-image" width="100px">
                    <div class="product-info">
                        <h2 class="product-name">Cat Food</h2>
                        <span class="product-rating"><span class="rating-yellow">***</span><span class="rating-black">**</span></span>
                        <p class="product-price">Rs.2000</p>
                    </div>
                </div>
                
            </div>
            <button id="nextBtn" class="nav-btn">Next</button>
        </div>
    </section>

    </div>




    <?php require 'include/footer.php' ?>

</body>
</html>