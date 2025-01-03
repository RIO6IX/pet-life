<?php
    session_start();
    require 'process/connect_dbshop.php';

    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $query = "DELETE FROM cart WHERE product_id=$id";
            $conn->query($query);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/user_profile/main.css">
    <link rel="stylesheet" href="css/user_profile/my_cart.css">
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">

    <script src="js/main.js" defer></script>
    <script src="js/side_menubar.js" defer></script>
    <script src="js/user_profile/my_cart/cart_script.js" defer></script>
    <title>MyCart</title>
</head>
<body>

    <?php require 'include/header.php' ?>
    
    <div class="grid-container">
        <div class="sidebar">
            <a href="user_profile.php" class="btn active">My Account</a>
            <a href="my_pets.php" class="btn">My Pets</a>
            <a href="my_appointments.php" class="btn">My Appointments</a>
            <a href="my_cart.php" class="btn">My Cart</a>
            <button id="log-out-btn"><a href="process/log_out.php">Log out</a></button>
        </div>
        
        <div class="profile-content">
        <h1>Shopping Cart</h1>

        <?php
           
            $userid = $_SESSION['userid'];

            $get_cart_items_query = "select product_data.product_id, product_data.product_name, product_data.product_price, 
                                     product_data.product_image_path, cart.product_amount from cart, 
                                     product_data where product_data.product_id=cart.product_id and cart.customer_id=$userid";

            $results = $conn->query($get_cart_items_query);

            if ($results->num_rows > 0) {
                $_SESSION['is_cart_empty'] = false;
            ?>
            <table>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Item Count</th>
                    <th>Action</th>
                </tr>
            
            <?php
                while ($row = $results->fetch_assoc()) {
                    $product_id = $row['product_id'];
                    $product_name = $row['product_name'];
                    $product_price = $row['product_price'];
                    $product_count = $row['product_amount'];
                    $image_path = $row['product_image_path'];
            ?>
                <tr>
                    <td><img class="product-image" src="assets/images/product_images/<?php echo $image_path ?>" alt=""></td>
                    <td><?php echo $product_name ?></td>
                    <td>Rs.<?php echo $product_price ?></td>
                    <td>
                        <div class="item-count">
                            <button onclick="decreaseItemCount(<?php echo $product_id ?>)" class="update-amount-btn">-</button>
                            <p id="item-count-<?php echo $product_id ?>"><?php echo $product_count ?></p>
                            <button onclick="increaseItemCount(<?php echo $product_id ?>)" class="update-amount-btn">+</button>
                        </div>
                    </td>
                    <td><a href="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $product_id ?>"><button class="delete-btn"><img src="assets/icons/delete_icon.png" alt=""></button></a></td>
                </tr>

            <?php
                }
            } else {
                $_SESSION['is_cart_empty'] = true;
                echo "Cart is Empty";
            }

            $conn->close();
        ?>
        </table>

        <?php
            if (!$_SESSION['is_cart_empty']) {
                echo '
                    <div id="cart-summary">
                        <p id="label">Total:</p>
                        <p id="amount"></p>
                        <a href="payment_portal.php"><button>Check Out</button></a>
                    </div>';
            }
        ?>

        </div>
    </div>
    
    
    <?php require 'include/footer.php' ?>
</body>
</html>