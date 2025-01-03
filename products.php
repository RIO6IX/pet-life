<?php
    session_start();
    require 'process/connect_dbshop.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $pname = $_POST['pname'];
        $ptype = $_POST['ptype'];
        $pprice = $_POST['pprice'];
        $stock = $_POST['stock'];
        $rating = $_POST['rating'];

        $target_dir = "assets/images/product_images/";
        $image_name = basename($_FILES['pimage']['name']);

        $target_dir = $target_dir.$image_name;

        if (!move_uploaded_file($_FILES['pimage']['tmp_name'], $target_dir)) {
            die("Image upload failed!");
        }

        $query = "insert into product_data(product_name, product_price, product_rating, product_type, current_stock, product_image_path)
                  values('$pname', '$pprice', $rating, '$ptype', $stock, '$image_name')";

        if (!$conn->query($query)) {
            die("Add product failed");
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
    <script src="js/main.js" defer></script> 
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">
    <title>Products</title>

    <style>
        #add-prod-form {
            box-shadow: 0px 10px 15px rgba(0,0,0,0.1);
            width: 40%;
            border-radius: 20px;
            margin-bottom: 100vh;
            display: flex;
            flex-direction: column;
            padding: 30px 30px;
            margin: 150px auto;
            background-color: white;

        }

        label {
            font-size: 2rem;
            margin-top: 20px;
        }

        #add-prod-form > 
        input[type="text"], 
        input[type="email"], 
        input[type="password"],
        input[type="number"],
        input[type="file"],
        select {
            width: 100%;
            font-size:1.5rem;
            padding: 5px;
        }

        #submit-btn {
            margin-top: 20px;
            height: 50px;
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            background-color: green;
            border:none;
            padding: 10px 15px;
        }

        

        #submit-btn:hover {
            cursor: pointer;
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
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data" id="add-prod-form">
                <label for="pname">Product Name</label>
                <input type="text" name="pname" id="pname" required><br>

                <label for="ptype">Product Type</label>
                <select name="ptype" id="ptype" required>
                    <option value="pet_care">Pet Care</option>
                    <option value="pet_food">Pet Food</option>
                    <option value="pet_treat">Pet Treats</option>
                    <option value="medicine">Pet Medicine</option>
                </select>

                <label for="pprice">Product Price</label>
                <input type="number" name="pprice" id="pprice" min=0 placeholder="Rs." required>

                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" min=0 required>

                <label for="rating">Product Rating</label>
                <input type="number" name="rating" id="rating" min=0 max=5 placeholder="1-5"required>

                <label for="pimage">Product Image</label>
                <input type="file" name="pimage" id="image" requried>

                <input type="submit" value="Add Product" id="submit-btn">
            </form>
        </div>
    </div>

</div>

<?php require 'include/footer.php' ?>   
</body>
</html>