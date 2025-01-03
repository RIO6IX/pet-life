<?php
    session_start();
    require '../../process/connect_dbshop.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['method'])) {
            $method = $_POST['method'];
            $userid = $_SESSION['userid'];
            
            switch ($method) {                
                case 'getcard':
                    header("Content-Type: application/json");
                    $check_card_availabitilty = "select * from payment_info where customer_id=$userid";
                    $results = $conn->query($check_card_availabitilty);

                    if ($results->num_rows > 0) {
                        $row = $results->fetch_assoc();
                        $credit_card_data = [
                            "status"=>"success",
                            "name"=>$row['customer_name'],
                            "cardnum"=>$row['card_number'],
                            "expdate"=>$row['expiry_date'],
                            'cvc'=>$row['card_verification_code']
                        ];

                    } else {
                        $credit_card_data = [
                            "status"=>"error",
                        ];
                    }
                    echo json_encode($credit_card_data);
                    exit;
                
                case 'getaddress':
                    header("Content-Type: application/json");
                    $check_address_availabitilty = "select u.first_name, u.last_name, u.street, u.city, u.postal_code, p.phone_num from user_data u, user_phone p where u.user_id=$userid and p.user_id=$userid ";
                    $results = $conn->query($check_address_availabitilty);

                    if ($results->num_rows > 0) {
                        $row = $results->fetch_assoc();
                        $address_data = [
                            "status"=>"success",
                            "name"=>$row['first_name']." ".$row['last_name'],
                            "street"=>$row['street'],
                            "city"=>$row['city'],
                            "postal_code"=>$row['postal_code'],
                            "mobile_num"=>$row['phone_num']
                        ];

                    } else {
                        $address_data = [
                            "status"=>"error"
                        ];
                    }

                    echo json_encode($address_data);
                    exit;

                    break;

                }
        }


        $conn->close();
    }
?>