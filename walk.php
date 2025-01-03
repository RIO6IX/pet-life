<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'process/connect_dbshop.php'; // Ensure this path is correct

// Redirect to login if the user is not authenticated
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

// Fetch pets for the logged-in user
$ownerId = $_SESSION['userid'];
$pets = [];
$query = "SELECT pet_id, name FROM pet_data WHERE owner_id = $ownerId";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $pets[] = $row; // Collect pet data
}

// Handle form submission to fetch walkers
$walkers = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['postalCode'])) {
    $postalCode = intval($_POST['postalCode']);
    $_SESSION['pet_selected'] = $_POST['pet'];
    
    // Query to fetch employees who provide walking services and match the postal code
    $query = "SELECT emp_id, first_name, last_name, 'default.jpg' AS image, 10 AS reviews, 1700 AS rate 
              FROM employee 
              WHERE postal_code = $postalCode AND service_provided = 'walk'";

    $result = $conn->query($query);
    
    while ($row = $result->fetch_assoc()) {
        $walkers[] = $row; // Collect walker data
    }
}

// Handle booking an appointment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bookAppointment'])) {
    $empId = intval($_POST['emp_id']);
    $appointmentDate = $_POST['appointment_date'];
    $appointmentTime = $_POST['appointment_time'];
    $customerId = intval($_SESSION['userid']);
    $postalCode = intval($_POST['postalCode']); // Get postal code from the form
    $serviceId = 501; // Set the service ID to 501
    $serviceFreq = $_POST['service_freq']; // Get service frequency from the form
    $pet_id_s = isset($_POST['pet']) ? $_POST['pet'] : "";

    // Check if service frequency is selected
    if (empty($serviceFreq)) {
        $message = "Please select a service frequency.";
    } else {
        // Insert the appointment into the database
        $query = "INSERT INTO appointment (customer_id, pet_id, service_id, service, appointment_date, appointment_time, postal_code, service_freq, status)
                  VALUES ($customerId,$pet_id_s, $serviceId, 'walk', '$appointmentDate', '$appointmentTime', $postalCode, '$serviceFreq', 'pending')";

        if ($conn->query($query) === TRUE) {
            $message = "Appointment booked successfully!";
        } else {
            $message = "Error booking appointment: " . $conn->error;
        }

        // Redirect to avoid re-submission on refresh
        header("Location: walk.php?message=" . urlencode($message) . "&postalCode=" . urlencode($postalCode));
        exit();
    }
}

// Check for success message
$message = isset($_GET['message']) ? $_GET['message'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dog Walking Booking Page</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/services/dog_walking.css">
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">
    <script src="js/main.js" defer></script>
</head>
<body>
    
    <?php require 'include/header.php'?>

    <div class="content">
        <section class="service-options">
            <div class="frequency">
                <p style="color:whitesmoke;font-size:1.5rem;font-weight:bold">How often do you want the service?</p>
                <select name="service_freq" id="serviceFreq" required>
                    <option value="">Select Frequency</option>
                    <option value="One-time">One-time</option>
                    <option value="Once-a-week">Once-a-week</option>
                </select>
            </div>

            <form method="POST" action="walk.php" id="bookingForm">
                <div class="filters">
                    

                    <select name="pet" id="pet" required>
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
                                <option value='<?php echo $pet_id ?>'><?php echo $pet_name ?></option>

                    <?php
                            }
                        }
                    ?>
                </select>

                    <input type="text" placeholder="Postal Code" class="postal-code" name="postalCode" required>
                    <input type="date" class="date-picker" name="appointment_date" required>
                    <input type="time" class="time-picker" name="appointment_time" required>
                    <button type="submit" class="search-button">Search</button>
                </div>
            </form>
        </section>

        <section class="walker-listings" id="walkerListings">
            <?php if (!empty($walkers)): ?>
                <?php foreach ($walkers as $walker): ?>
                    <div class="walker-card">
                        <!-- <img src="assets/images/<?php echo $walker['image']; ?>" alt="Walker" class="walker-icon"> -->
                        <h3><?php echo htmlspecialchars($walker['first_name']) . ' ' . htmlspecialchars($walker['last_name']); ?></h3>
                        <p> **<?php echo $walker['reviews']; ?> reviews**</p>
                        <p>Rs. <?php echo $walker['rate']; ?>/day</p>
                        <form method="POST" action="walk.php" onsubmit="return confirmBooking(this)">
                            <input type="hidden" name="emp_id" value="<?php echo $walker['emp_id']; ?>">
                            <input type="hidden" name="appointment_date" value="<?php echo $_POST['appointment_date']; ?>">
                            <input type="hidden" name="appointment_time" value="<?php echo $_POST['appointment_time']; ?>">
                            <input type="hidden" name="postalCode" value="<?php echo $_POST['postalCode']; ?>"> <!-- Include postal code -->
                            <input type="hidden" name="service_freq" id="selectedServiceFreq" value=""> <!-- Will hold selected service frequency -->
                            <input type="hidden" name="bookAppointment" value="1">
                            <input type="hidden" name="pet" value="<?php echo $_SESSION['pet_selected'] ?>">
                            <button type="submit" class="book-button" id="bookButton" disabled>Book</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="font-size: 45px ; color: white; "><b>Enter Postal Code ! </b></p>
            <?php endif; ?>
        </section>

        <?php if (!empty($message)): ?>
            <div class="message">
                <p><?php echo htmlspecialchars($message); ?></p>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Enable the Book button only if a service frequency is selected
        const serviceFreqDropdown = document.getElementById('serviceFreq');
        const bookButtons = document.querySelectorAll('.book-button');

        serviceFreqDropdown.addEventListener('change', function() {
            // Enable/disable book buttons based on the selection
            const selectedFreq = this.value;
            bookButtons.forEach(button => {
                button.disabled = !selectedFreq; // Enable button only if a frequency is selected
                document.getElementById('selectedServiceFreq').value = selectedFreq; // Set the hidden input value
            });
        });

        function confirmBooking(form) {
            const selectedFreq = document.getElementById('serviceFreq').value;
            if (!selectedFreq) {
                alert("Please select a service frequency before booking.");
                return false; // Prevent form submission
            }
            return confirm("Are you sure you want to book this appointment?");
        }
    </script>

    <?php require 'include/footer.php' ?>
</body>
</html>



