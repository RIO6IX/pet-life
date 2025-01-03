<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start the session
session_start();

// Include database connection
require "process/connect_dbshop.php";

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    echo "<script>alert('You need to log in to submit an inquiry.');</script>";
    exit;
}

$user_id = $_SESSION['userid'];
$inquiryAdded = false;
$inquiryUpdated = false;
$inquiryDeleted = false;

// Handle form submission (Create Inquiry)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'add') {
        // Get form data
        $inquiry_type = mysqli_real_escape_string($conn, $_POST['inquiry_type']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        // Insert data into the inquiry table
        $sql = "INSERT INTO inquiry (customer_id, inquiry_type, inquiry_description) VALUES ('$user_id', '$inquiry_type', '$message')";
        if (mysqli_query($conn, $sql)) {
            $inquiryAdded = true;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Handle form update (Edit Inquiry)
    if (isset($_POST['action']) && $_POST['action'] == 'edit') {
        // Get edited data
        $inquiry_id = $_POST['id'];
        $inquiry_type = mysqli_real_escape_string($conn, $_POST['inquiry_type']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        // Update inquiry in the database
        $sql = "UPDATE inquiry SET inquiry_type='$inquiry_type', inquiry_description='$message' WHERE inquiry_id='$inquiry_id' AND customer_id='$user_id'";
        if (mysqli_query($conn, $sql)) {
            $inquiryUpdated = true; // Set flag if updated successfully
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }

    // Handle query deletion (Delete Inquiry)
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        // Get the inquiry ID
        $inquiry_id = $_POST['id'];

        // Delete the inquiry from the database
        $sql = "DELETE FROM inquiry WHERE inquiry_id='$inquiry_id' AND customer_id='$user_id'";
        if (mysqli_query($conn, $sql)) {
            $inquiryDeleted = true; // Set flag if deleted successfully
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }

    // Close the connection
    mysqli_close($conn);
    
    // Redirect to the same page to avoid form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Fetch all existing inquiries for the logged-in user from the database
$inquiries = [];
$sql = "SELECT inquiry_id, inquiry_type, inquiry_description FROM inquiry WHERE customer_id='$user_id'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $inquiries[] = $row; // Add each inquiry to the inquiries array
    }
}

// Close the connection again
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - PetLife Co</title>
    <link rel="stylesheet" href="css/contact_us.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">


    <script src="js/main.js" defer></script>
</head>
<body>

    <?php require 'include/header.php'; ?>

    <div class="content">
        <div class="container">
            <h1>Contact Us</h1>
            <p>Any questions or remarks? Just write us a message!</p>

            <form id="contact-form" method="POST" class="contact-us-form">
                <input type="hidden" name="action" value="add">
                <div class="input-group">
                    <label for="inquiry_type">Inquiry Type</label>
                    <select id="inquiry_type" name="inquiry_type" required>
                        <option value="">Select Inquiry Type</option>
                        <option value="service">Service</option>
                        <option value="vet">Vet</option>
                        <option value="product">Product</option>
                    </select>
                </div>
                <textarea id="message" name="message" placeholder="Type your issues and remarks" required></textarea>
                <button type="submit" class="submit-button">Submit</button>
            </form>

            <div class="query-list">
                <h2>Submitted Queries</h2>
                <ul id="query-items">
                    <?php foreach ($inquiries as $inquiry): ?>
                        <li id="query-<?= $inquiry['inquiry_id'] ?>">
                            <span><strong>Inquiry Type:</strong> <?= htmlspecialchars($inquiry['inquiry_type']) ?></span><br>
                            <span><strong>Message:</strong> <?= htmlspecialchars($inquiry['inquiry_description']) ?></span><br>
                            <button class="edit-button" onclick="editQuery(<?= $inquiry['inquiry_id'] ?>, '<?= htmlspecialchars($inquiry['inquiry_type']) ?>', '<?= htmlspecialchars($inquiry['inquiry_description']) ?>')">Edit</button>
                            <button class="delete-button" onclick="deleteQuery(<?= $inquiry['inquiry_id'] ?>)">Delete</button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <?php if ($inquiryAdded): ?>
        <script>
            alert("Inquiry added successfully!");
        </script>
    <?php endif; ?>

    <?php if ($inquiryUpdated): ?>
        <script>
            alert("Inquiry updated successfully!");
        </script>
    <?php endif; ?>

    <?php if ($inquiryDeleted): ?>
        <script>
            alert("Inquiry deleted successfully!");
        </script>
    <?php endif; ?>

    <script>
        function editQuery(id, inquiryType, message) {
            const form = document.getElementById('contact-form');
            form.action.value = 'edit';
            form.querySelector('#inquiry_type').value = inquiryType;
            form.querySelector('#message').value = message;
            form.insertAdjacentHTML('afterbegin', `<input type="hidden" name="id" value="${id}">`);
        }

        function deleteQuery(id) {
            if (confirm("Are you sure you want to delete this inquiry?")) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.innerHTML = `<input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="${id}">`;
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>

    <?php require 'include/footer.php'; ?>

</body>
</html>
