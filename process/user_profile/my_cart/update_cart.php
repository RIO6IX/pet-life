<?php
    session_start();
    require '../../connect_dbshop.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
       if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $product_id = $_POST['product_id'];
        $user_id = $_SESSION['userid'];
        $query = "";

        switch ($action) {
            case 'add':
                header("Content-Type: application/json");
                $query = "SELECT * FROM Cart WHERE product_id=$product_id AND customer_id=$user_id";
                $results = $conn->query($query);

                if ($results->num_rows > 0) {
                    echo json_encode([
                        "status"=>"error",
                        "body"=>"Product already in the cart."
                    ]);
                    exit;
                } else {
                    $add_query = "INSERT INTO cart(product_id, customer_id, product_amount) VALUES($product_id, $user_id, 1)";
                    $conn->query($add_query);
                    echo json_encode([
                        "status"=>"success",
                        "body"=>"Product added to cart!."
                    ]);
                    exit;
                }

                break;

            case 'decrease':
                $query = "UPDATE cart SET product_amount=product_amount-1 WHERE product_id=$product_id";
                $conn->query($query);
                break;

            case 'increase':
                $query = "UPDATE cart SET product_amount=product_amount+1 WHERE product_id=$product_id";
                $conn->query($query);
                break;

            case 'delete':
                $query = "DELETE FROM cart WHERE product_id=$product_id";
                $conn->query($query);
                break;
        }
        $conn->close();
       }
    }
?>  