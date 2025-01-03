<?php
    session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
}

require "process/connect_dbshop.php";

$user_id = $_SESSION['userid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $pet_id = $_POST['pet'];
    $checkin_date = $_POST['checkin_date'];
    $checkout_date = $_POST['checkout_date'];
    $hostel_type = $_POST['hostelOption'];

    
    if (empty($hostel_type)) {
        echo "<script>alert('Error: Please select a hostel option.');</script>";
    } else {

        
        $query = "INSERT INTO Appointment(customer_id, pet_id, service_id, service, checkin_date, checkout_date, hostel_type, status)
                  VALUES ($user_id, $pet_id, 502, 'Pet hostel', '$checkin_date', '$checkout_date', '$hostel_type', 'pending')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Booking successful!');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
}

// Fetch user's pets
$query = "SELECT pet_id, name FROM Pet_Data WHERE owner_id='$user_id'";
$pets_result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Pet Hostel</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/services/hostel.css">
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">


    <script src="js/main.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome for icons -->

    <style>
        .content {
            height: 100vh;
        }
    </style>
</head>

<body>
   
    <?php require 'include/header.php' ?>

    <!-- Main Content -->
    <div class="content">
        <!-- Image Section -->
        <section class="image-section">
            <img src="http://www.psyeta.org/wp-content/uploads/2022/02/AdobeStock_481854656-1-scaled.jpeg" alt="Pet Hostel Image" class="hostel-img">
        </section>

        <!-- Booking Form -->
        <section class="booking-form">
            <form id="bookingForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <select name="pet" id="pet-select" required>
                    <option value="">Select Pet</option>
                    <?php
                    // Dynamically populate pet options from the database
                    if (mysqli_num_rows($pets_result) > 0) {
                        while ($row = mysqli_fetch_assoc($pets_result)) {
                            echo "<option value='" . $row['pet_id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>No pets found. Please add a pet first.</option>";
                    }
                    ?>
                </select>

                <label for="checkin_date">Check-in Date</label>
                <input type="date" id="checkin_date" name="checkin_date" required>

                <label for="checkout_date">Check-out Date</label>
                <input type="date" id="checkout_date" name="checkout_date" required>

                <!-- Hidden input to store selected hostel option -->
                <input type="hidden" name="hostelOption" id="hostelOption">

                <button class="book-btn" id="bookBtn" type="submit" onclick="validateHostelOption(event)">Book Now</button>
            </form>
        </section>

        <!-- Hostel Options Cards -->
        <section class="hostel-options">
            <div class="hostel-card" id="standardCard" onclick="selectHostel('Standard')">
                <img src="https://image.cnbcfm.com/api/v1/image/104661266-pet-hotels-2.jpg?v=1503071272" alt="Standard Hostel Image" class="hostel-image">
                <h3>Standard</h3>
                <p>Basic pet hostel with all essential services.</p>
            </div>
            <div class="hostel-card" id="kittyHouseCard" onclick="selectHostel('Kitty House')">
                <img src="https://luxurylaunches.com/wp-content/uploads/2017/07/Cover-Image-1170x651.jpg" alt="Kitty House Image" class="hostel-image">
                <h3>Kitty House</h3>
                <p>Premium hostel for your feline friends.</p>
            </div>
        </section>

       
    </div>

<!-- 
        //---------------------------------    Book Pet Hostel ------------------------------------------------------ -->
<script>
function selectHostel(hostel) {
    // Set the hidden input value to the selected hostel type
    document.getElementById('hostelOption').value = hostel;

    // Remove 'selected' class from all cards
    const cards = document.querySelectorAll('.hostel-card');
    cards.forEach(card => card.classList.remove('selected'));

    // Add 'selected' class to card
    if (hostel === 'Standard') {
        document.getElementById('standardCard').classList.add('selected');
    } else if (hostel === 'Kitty House') {
        document.getElementById('kittyHouseCard').classList.add('selected');
    }
}

function validateHostelOption(event) {
    // Prevent form submission if no hostel option is selected
    const hostelOption = document.getElementById('hostelOption').value;
    if (!hostelOption) {
        alert("Please select a hostel option.");
        event.preventDefault();
    }
}
    </script>

    <?php require 'include/footer.php' ?>
</body>

</html>



