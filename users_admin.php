<?php
    session_start();
    require 'process/connect_dbshop.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(isset($_REQUEST['action'])) {
            $action = $_REQUEST['action'];
            $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : "";
            $id = $_REQUEST['id'];

            switch($action) {
                case 'update-img':
                    $new_image = isset($_FILES['new-profile-pic']['name']) ? basename($_FILES['new-profile-pic']['name']) : "";
                    $target_dir = "profile_pictures/users/".$new_image;

                    if (!move_uploaded_file($_FILES['new-profile-pic']['tmp_name'], $target_dir)) {
                        die("Image Upload failed");
                    }

                    $update_img = "update user_data set user_image_path='$new_image' where user_id=$id";
                    $conn->query($update_img);

                    break;
                case 'edit':
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $phone_num = $_POST['phone_num'];
                    $email = $_POST['email'];
                    $street = $_POST['street'];
                    $city = $_POST['city'];
                    $postal_code = $_POST['postal_code'];

                    $update_user_data = "";
                    $update_user_phone = "";

                    if ($type == "customer") {
                        $update_user_data = "update user_data
                                             set first_name='$fname',
                                             last_name='$lname',
                                             email='$email',
                                             street='$street',
                                             city='$city',
                                             postal_code=$postal_code                                             
                                             
                                             where user_id=$id";

                        $update_user_phone = "update user_phone set phone_num=$phone_num where user_id=$id";
                    } else {
                        $update_user_data = "update employee
                                             set first_name='$fname',
                                             last_name='$lname',
                                             email='$email',
                                             street='$street',
                                             city='$city',
                                             postal_code=$postal_code
                                                                                          
                                             where emp_id=$id";

                        $update_user_phone = "update employee_phone set phone_num=$phone_num where emp_id=$id";
                    }

                    $conn->query($update_user_data);
                    $conn->query($update_user_phone);

                    break;
            }
            
        } else {
            header("Content-Type: application/json");

            $account_type = $_POST['account_type'];
            $user_email = htmlspecialchars($_POST['user_email']);
            $get_user_info = "";

            if ($account_type == "cust") {
                $get_user_info = "select u.user_id, u.role, u.first_name, u.last_name, u.email, u.street, u.city, u.postal_code, u.user_image_path, p.phone_num 
                                  from user_data u, user_phone p 
                                  where u.email='$user_email' and p.user_id=u.user_id";
            } else {
                $get_user_info = "select e.emp_id, e.role, e.first_name, e.last_name, e.email, e.street, e.city, e.postal_code, p.phone_num 
                                  from employee e, employee_phone p 
                                  where e.email='$user_email' and p.emp_id=e.emp_id";
            }

            $results = $conn->query($get_user_info);

            if ($results->num_rows > 0) {
                $row = $results->fetch_assoc();

                $user_data = [
                    "userid"=> isset($row['user_id']) ? $row['user_id'] : $row['emp_id'],
                    "account_type"=>$row['role'],
                    "fname"=>$row['first_name'],
                    "lname"=>$row['last_name'],
                    "phone_num"=>$row['phone_num'],
                    "email"=>$row['email'],
                    "street"=>$row['street'],
                    "city"=>$row['city'],
                    "postal_code"=>$row['postal_code'],
                    "image"=> isset($row['user_image_path']) ? $row['user_image_path'] : "none",
                    "status"=>"success"
                ];

                echo json_encode($user_data);
                exit;
            } else {
                $user_data = ["status"=>"error"];
                echo json_encode($user_data);
                exit;
            }
        }
        
    }

    if ($_SERVER['REQUEST_METHOD'] == "GET" ) {
        if (isset($_GET['action'])) {
            $type = $_GET['type'];
            $id = $_GET['id'];

            $delete_query = "";
            if ($type == "customer") {
                $delete_query = "delete from user_data where user_id=$id";
            } else {
                $delete_query = "delete from employee where emp_id=$id";
            }

            if(!$conn->query($delete_query)) {
                die("Account deletion failed");
            };
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/profile_menu.css">
    <link rel="stylesheet" href="css/users_admin.css">
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">


    <script src="js/main.js" defer></script>
    <script src="js/users_admin.js" defer></script>
    <title>Users</title>
</head>
<body>
    <?php require 'include/header.php' ?>
    <div class="grid-container">
            <div class="sidebar">
                <a href="dashboard.php" class="btn active">Dashboard</a>
                <a href="users_admin.php" class="btn">Users</a>
                <a href="appointments.php" class="btn">Appointments</a>
                <a href="products.php" class="btn">Products</a>
                <a href="services_admin.php" class="btn">Services</a>
                <a href="admin_inquiry.php" class="btn">Inquiry</a>
                <button id="log-out-btn"><a href="process/log_out.php">Log out</a></button>
            </div>
            
            <div class="profile-content">
                <form id="search-form">
                    <div>
                        <label for="account_type">Account Type</label><br>
                        <select name="account_type" id="account_type">
                            <option value="cust">Customer</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>

                    <div id="user-email-search">
                        <label for="user_email">User Email</label><br>
                        <input type="email" name="user_email" id="user_email" required>
                    </div>

                    <div>
                        <input type="submit" value="Search" id="search-btn">
                    </div>
                </form>

                <form action="" method="POST" id="user-image-form" enctype="multipart/form-data" hidden>
                    <div id="profile-pic-container">
                        <img id="user-profile-pic"><br>
                        <input type="file" name="new-profile-pic" id="new-profile-pic">
                    </div>
                    <button type="submit" id="submit-img-btn">Submit</button>
                </form>

                <form action="" method="POST" id="user-info-form">

                    <label for="account_type">Account Type:</label><br>
                    <input type="text" name="user_account_type" id="user_account_type" value="" disabled><br>

                    <label for="fname">First name:</label><br>
                    <input type="text" name="fname" id="fname" class="editable" value="" disabled><br>

                    <label for="lname">Last Name:</label><br>
                    <input type="text" name="lname" id="lname" class="editable" value="" disabled><br>

                    <label for="phone_num">Phone Number:</label><br>
                    <input type="text" name="phone_num" id="phone_num" class="editable" value="" disabled><br>

                    <label for="email">Email:</label><br>
                    <input type="email" name="email" id="email" class="editable" value="" disabled><br>

                    <label for="Address">Address:</label><br>
                    <input type="text" name="street" id="street" class="editable" value="" disabled><br>
                    <input type="text" name="city" id="city" class="editable" value="" disabled><br>
                    <input type="text" name="postal_code" id="postal_code" class="editable" value="" disabled><br>

                    <div>
                        <button type="submit" id="submit-btn" hidden>Submit</button>
                    </div>
                </form>

                <div id="action-btn">
                    <button id="edit-btn" onclick="enableEdit()" disabled>Edit</button>
                    <a href="" id="delete-link"><button id="delete-btn" onclick="confirm('Do you want to delete this account?')" disabled>Delete</button></a>
                    <a href="staff_registration.php"><button id="add-user-btn" onclick=" return confirm('Do you want to add a new account?')">Add User</button></a>

                </div>

            </div>
    </div>

    <?php require 'include/footer.php' ?>
</body>
</html>