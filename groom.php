<?php 
    session_start(); 
    require "process/connect_dbshop.php";

    if (!isset($_SESSION['userid'])) {
        header("Location: login.php");
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $pet_id = $_POST['petName'];
        $service = $_POST['service'];
        $time = $_POST['time'];
        $date = $_POST['date'];
        $user_id = $_SESSION['userid'];

        $add_appointment_query = "insert into appointment(customer_id, pet_id, service_id, service, appointment_date, appointment_time, status)
                                  values($user_id, $pet_id, 500, '$service', '$date', '$time', 'pending')";

        if (!$conn->query($add_appointment_query)) {
            echo "Error: ".$conn->error;
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Grooming Services</title>
    <link rel="stylesheet" href="css/services/grooming.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">


    <script src="js/main.js" defer></script>
    <script src="js/services/groomingadd.js" defer></script>
</head>
<body>
    <?php require 'include/header.php' ?>

    <div class="content">
        
        <section class="hero">
            <h1>Premium Pet Grooming Services</h1>
            <p>Expert care for your furry friend</p>
            <button class="cta-btn" id="book-service-btn" onclick="scrolldown()">Book a Grooming Session</button>
        </section>
    
        <section class="services">
            <h2>Our Grooming Services</h2>
            <div class="service-list">
                <div class="service-item">
                    <img src="assets/images/services/bath.jpg">
                    <h3>Bath and Brush</h3>
                    <p>Keep your pet clean and shiny.</p>
                    <span>Rs.1000</span>
                </div>
                <div class="service-item">
                    <img src="assets/images/services/haircut.jpg">
                    <h3>Haircuts and Trims</h3>
                    <p>Custom styles for your pet's look.</p>
                    <span>Rs.2000</span>
                </div>
                <div class="service-item">
                    <img src="assets/images/services/nail.jpg">
                    <h3>Nail Clipping</h3>
                    <p>Safe and gentle nail trimming.</p>
                    <span>Rs.3000</span>
                </div>
                <div class="service-item">
                    <img src="assets/images/services/board.jpg">
                    <h3>Pet Boarding</h3>
                    <p>Safetly you can board your pet.</p>
                    <span>Rs.4500</span>
                </div>
            </div>
        </section>
    
        <section class="booking" id="booking">
            <h2>Book Your Grooming Session</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <!-- <label for="ownerName">Owner's Name:</label>
                <input type="text" id="ownerName" name="ownerName" required> -->
    
                <label for="petName">Pet's Name:</label>
                <!-- <input type="text" id="petName" name="petName" required> -->
                <select name="petName" id="petName" required>
                    <option value="null">Pet Name</option>
                    <?php
                        $userid = $_SESSION['userid'];
                        $get_pets_query = "select name, pet_id from pet_data where owner_id=$userid";
                        $results = $conn->query($get_pets_query);

                        if ($results->num_rows > 0) {
                            while($row = $results->fetch_assoc()) {
                                $pet_name = $row['name'];
                                $pet_id = $row['pet_id'];

                    ?>
                                <option value='<?php echo $pet_id ?>'><?php echo $pet_name ?></option>;

                    <?php
                            }
                        }
                    ?>
                </select>
    
                <label for="service">Select Service:</label>
                <select id="service" name="service" required>
                    <option value="bath">Bath and Brush - Rs.1000</option>
                    <option value="haircut">Haircuts and Trims - Rs.2000</option>
                    <option value="nail-trim">Nail Clipping - Rs.3000</option>
                    <option value="board">Pet Boarding Per Day - Rs.4500</option>
                </select>
    
                <label for="date">Preferred Date:</label>
                <input type="date" id="date" name="date" required>
    
                <label for="time">Preferred Time:</label>
                <input type="time" id="time" name="time" required>
    
                <button type="submit" name="fsub" id="fsub">Submit</button>
            </form>
        </section>

    </div>    

    <?php require 'include/footer.php' ?>

    
</body>
</html>
