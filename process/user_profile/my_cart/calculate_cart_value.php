<?php
    session_start();
    require '../../connect_dbshop.php';
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $body = file_get_contents('php://input');
        $user_id = $_SESSION['userid'];
        $total = 0.0;

        $query = "select product_data.product_price, cart.product_amount from product_data, cart where cart.customer_id=$user_id and product_data.product_id=cart.product_id;
";
        $results = $conn->query($query);

        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $price = (float)$row['product_price'];
                $count = (float)$row['product_amount'];

                $total += $price * $count;
            }
            echo json_encode(['amount' => "$total"]);
            exit;
        } else {
            echo json_encode([
                'amount' => "empty"
            ]);
            exit;
        }

    }


    $conn->close();

?>