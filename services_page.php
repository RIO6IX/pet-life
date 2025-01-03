<?php
    session_start();
    require 'process/connect_dbshop.php';
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">


    <script src="js/main.js" defer></script>
    <title>Services</title>

    <style>
        .content {
            height: 100vh;
        }

        h1 {
            font-size: 3rem;
            margin: 10px 10px;
        }
        .service-card {
            border: 1px solid gray;
            border-radius: 10px;
            width: 300px;
            height: 430px;
            margin: 40px;
            background-color: #F5F5F5;
            display: inline-block;
            transition: 0.5s ease;
        }

        .service-card:hover {
            scale: 1.05;
            box-shadow: 0px 10px 10px rgba(0,0,0,0.4);
        }

        .img-container img {
            width: 280px;
            height: 250px;
            margin: 10px 10px;
            border-radius: 10px;
            border: 1px solid black;
        }

        .service-info{
            padding: 0 25px;
            font-size: 1.5rem;
            color: black;
        }

        .book {
            background-color: #507687;
            width: 100%;
            text-align: center;
            font-size: 2rem;
            height: 50px;
            border-radius: 0 0 10px 10px;
            color: white;
            font-weight: bold;
            padding-top: 15px;
        }

        .service-card-link {
            text-decoration: none;
        }

    </style>
</head>
<body>
    <?php require 'include/header.php' ?>
    <div class="content">
        <h1>Services</h1>

        <?php
            $query = "select * from services";
            $results = $conn->query($query);

            if ($results->num_rows > 0) {
                while($row = $results->fetch_assoc()) {
                    $service_type = $row['service_type'];
                    $title = "";

                    switch($service_type) {
                        case 'groom': $title = "Grooming Session"; break;
                        case 'walk': $title = "Pet Walking"; break;
                        case 'hostel': $title = "Pet Hostel"; break;
                        case 'vet': $title = "Veterinary Care"; break;
                    }
        ?>
                    <a href="<?php echo $service_type ?>.php" class="service-card-link">
                        <div class="service-card">
                            <div class="img-container">
                                <img src="assets/images/services/<?php echo $service_type ?>.jpg" alt="">
                            </div>
                            <div class="service-info">
                                <h3><?php echo $title ?></h3>
                            </div>
                            <div class="book">Book Now</div>
                        </div>
                    </a>
        <?php
                }
            } else {
                echo "No services";
            }
        ?>

        
    </div>
    <?php require 'include/footer.php' ?>
</body>
</html>