<?php

session_start(); // Start the session


if (!isset($_SESSION['userid'])) {
    die("Error: You must be logged in to access this page."); 
}

require "process/connect_dbshop.php";


$user_id = $_SESSION['userid'];

// Handle delete request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_pet_id'])) {
    $pet_id = $conn->real_escape_string($_POST['delete_pet_id']);
    $delete_query = "DELETE FROM Pet_Data WHERE pet_id='$pet_id' AND owner_id='$user_id'";

   
}

// Fetch the user's pets
$query = "SELECT pet_id, name, pet_image_path FROM Pet_Data WHERE owner_id='$user_id'";
$pname_result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Pets Profile</title>
    <link rel="stylesheet" href="css/P_pet.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="profile_menu.css">
    <link rel="stylesheet" href="css/user_profile/main.css">
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">


    <script src="js/main.js" defer></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome for icons -->
</head>
<body>
   
    <?php require 'include/header.php' ?>

    <div class="grid-container">
        <div class="sidebar">
            <a href="user_profile.php" class="btn active">My Account</a>
            <a href="my_pets.php" class="btn">My Pets</a>
            <a href="my_appointments.php" class="btn">My Appointments</a>
            <a href="my_cart.php" class="btn">My Cart</a>
            <button id="log-out-btn"><a href="process/log_out.php">Log out</a></button>
        </div>
        
        <div class="profile-content">

            <!-- Main Content -->
            <div id="main">
                <h2 class="title-section">My Pets</h2>
                <button class="add-pet-btn" onclick="location.href='pet_registration.php';">Add New Pet</button> <!-- Button to add new pet -->

                <!-- Pet Cards Section -->
                <section class="pet-cards">
                    <?php
                    
                    if (mysqli_num_rows($pname_result) > 0) {
                        // create a card
                        while ($row = mysqli_fetch_assoc($pname_result)) {
                            echo '<div class="pet-card">';
                            echo '<img src="profile_pictures/pets/' . htmlspecialchars($row['pet_image_path']) . '" alt="Pet Image" class="pet-image">'; // Fetch and display pet image
                            echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
                            echo '<form method="POST" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
                            echo '<input type="hidden" name="delete_pet_id" value="' . htmlspecialchars($row['pet_id']) . '">';
                            echo '<button type="submit" class="delete-pet-btn">Delete Pet</button>';
                            echo '</form>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No pets found.</p>';
                    }
                    ?>
                </section>
                </div>
        </div>

      

    </div>

    <script src="scripts.js">
        // ---------------- PET PROFILE-----------------------------------------------------

        // Event listener for the "Add New Pet" button
        document.getElementById('addPetBtn').addEventListener('click', function() {
            alert('Redirecting to add new pet page...'); 
            
        });

    </script> 
    <?php require 'include/footer.php' ?>
</body>
</html>
