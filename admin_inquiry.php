<?php
    session_start();
    require 'process/connect_dbshop.php';

    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if (isset($_GET['action'])) {
            $inq_id = $_GET['id'];

            $del_query = "delete from inquiry where inquiry_id=$inq_id";

            if (!$conn->query($del_query)) {
                die("Inquiry deletion failed: ".$conn->error);
            }
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
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">
    <script src="js/main.js" defer></script>
    <title>Inquiries</title>

    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table {
            margin: 20px;
            font-size: 1.5rem;
            background-color: white;
        }

        td {
            padding: 15px;
        }

        .remove-btn {
            padding: 8px 10px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 5px;  
        }

    </style>
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
            <table>
                <tr>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Inquiry Date - Time</th>
                    <th>Inquiry Type</th>
                    <th>Inquiry Description</th>
                    <th>Action</th>
                </tr>
                <?php
                    $query = "select u.first_name, u.last_name, u.email, i.inquiry_date, i.inquiry_type, i.inquiry_description, i.inquiry_id
                              from user_data u, inquiry i
                              where i.customer_id=u.user_id";

                    $results = $conn->query($query);

                    if ($results->num_rows > 0) {
                        while ($row = $results->fetch_assoc()) {
                            $id = $row['inquiry_id'];
                            $fname = $row['first_name'];
                            $lname = $row['last_name'];
                            $email = $row['email'];
                            $inq_date = $row['inquiry_date'];
                            $inq_type = $row['inquiry_type'];
                            $inq_desc = $row['inquiry_description'];

                            $full_name = $fname." ".$lname;
                ?>
                            <tr>
                                <td><?php echo $full_name ?></td>
                                <td><?php echo $email ?></td>
                                <td><?php echo $inq_date ?></td>
                                <td><?php echo $inq_type ?></td>
                                <td><?php echo $inq_desc ?></td>
                                <td><a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>?action=del&id=<?php echo $id ?>"><button class="remove-btn">Remove</button></td>
                            </tr>
                <?php
                        }
                    } else {
                        echo "<h2>No Inquiries</h2>";
                    }
                ?>
                
            </table>
        </div>  
    </div>

    <?php require 'include/footer.php' ?>
</body>
</html>