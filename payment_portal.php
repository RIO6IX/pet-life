<?php
    session_start();
    require 'process/connect_dbshop.php';

    function emptyCart($id) {
        global $conn;
        $empty_cart_query = "delete from cart where customer_id=$id";
        $purchase_freq_query = "update user_data set purchase_freq=purchase_freq+1 where user_id=$id";
        $conn->query($empty_cart_query);
        $conn->query($purchase_freq_query);
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $userid = $_SESSION['userid'];
        
        if (isset($_POST['option'])) {
            $card_number = $_POST['card-number'];
            $exp_date = $_POST['exp-date'];
            $cvc = $_POST['cvc'];
            $name = $_POST['name'];
            $save = $_POST['option'];

            if ($save == "save") {
                $save_card_query = "insert into payment_info(customer_id, customer_name, card_number, expiry_date, card_verification_code) values($userid, '$name', '$card_number', '$exp_date', '$cvc');";
                $conn->query($save_card_query);
            }
        }
        emptyCart($userid);

        $conn->close();
        header("Location: purchase_confirmation_page.html");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/payment_portal/main.css">
    <script src="js/main.js" defer></script>
    <script src="js/payment_portal/main.js" defer></script>
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">
    <title>Check Out</title>
</head>
<body>

    <?php require 'include/header.php' ?>

    <div class="content">
        <h1>Payment Portal</h1>
        
        <button class="accordion" onclick="getSavedCardInfo()">Pay with Credit/Debit Card</button>
        <div class="panel" id="card">
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="card-form" class="payment-form">
                <label for="card-number">Card Number</label><br>
                <input type="text" name="card-number" id="card-number" placeholder="1234-5678-9012-3456" required><br>

                <label for="exp-date">Expiry Date</label><br>
                <input type="text" name="exp-date" id="exp-date" placeholder="mm/yy" required><br>

                <label for="cvc">CVC</label><br>
                <input type="password" name="cvc" id="cvc" pattern="[0-9]{3}" placeholder="123"><br>

                <label for="name">Name on Card</label><br>
                <input type="text" name="name" id="name"><br>

                <input type="checkbox" name="option" value="save" id="save-card"> Save my card for future payments<br>

                <input type="submit" value="Place Order">
            </form>
        </div>

        <button class="accordion">Cash On Delivery</button>
        <div class="panel">
            <button class="address-autofill-btn" onclick="getAddressInfo()">Auto Fill</button>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="card-form" id="card-form" class="payment-form">
                <label for="full-name">Full Name</label><br>
                <input type="text" name="full-name" id="full-name" required><br>

                <label for="mobile-num">Mobile Number</label><br>
                <input type="number" name="mobile-num" id="mobile-num" required><br>

                <label for="address">Address</label><br>
                <input type="text" name="street" id="street" placeholder="Street" required><br>
                <input type="text" name="city" id="city" placeholder="City" required><br>
                <input type="number" name="postal_code" id="postal-code" placeholder="Postal Code" required><br>

                <input type="submit" value="Place Order">
            </form>
        </div>

    </div>
</body>
</html>