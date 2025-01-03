<?php
    session_start();


    require 'process/connect_dbshop.php';

    

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}


$user_id = $_SESSION['userid'];

// form is submitted to update the profile
if (isset($_POST['update_profile'])) {
    // Fetch updated data from the form
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    
    // Update user's information 
    $update_query = "UPDATE User_Data SET first_name='$fname', last_name='$lname', email='$email' WHERE user_id='$user_id'";
    mysqli_query($conn, $update_query);
}

// reset the password
if (isset($_POST['reset_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    $query = "SELECT password FROM User_Data WHERE user_id='$user_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row && md5($current_password) === $row['password']) {
        if (!empty($new_password)) {
            $update_password_query = "UPDATE User_Data SET password='" . md5($new_password) . "' WHERE user_id='$user_id'";
            mysqli_query($conn, $update_password_query);
            $message = "Password updated successfully.";
        } else {
            $message = "Enter a new password.";
        }
    } else {
        $message = "Wrong password.";
    }
}

// delete the account
if (isset($_POST['delete_Account'])) {
    $delete_AC = "DELETE FROM User_Data WHERE user_id='$user_id'";
    mysqli_query($conn, $delete_AC);
    session_destroy();
    header("Location: login.php"); // Redirect to the login page
    exit();
}

// Check if the form is submitted to upload a new profile picture
if (isset($_POST['upload_photo'])) {
    $target_dir = "profile_pictures/users/"; // Directory to save uploaded images
    $image_name = basename($_FILES["user_image"]["name"]);
    $target_file = $target_dir . $image_name;
    

    //Credit: https://youtu.be/JaRq73y5MJk?si=UbyQIMNkhNDmeWtL
    // Check if the uploaded file is an image  
    $check = getimagesize($_FILES["user_image"]["tmp_name"]);
    if ($check !== false) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
            // Update the user image path in the database
            $update_image_query = "UPDATE User_Data SET user_image_path='$image_name' WHERE user_id='$user_id'";
            mysqli_query($conn, $update_image_query);
            $message = "Image uploaded successfully.";
        } else {
            $message = "Sorry, there was an error uploading your file.";
        }
    } else {
        $message = "File is not an image.";
    }
}

// Fetch  current profile details
$query = "SELECT first_name, last_name, email, user_image_path FROM User_Data WHERE user_id='$user_id'";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $fname = $row['first_name'];
    $lname = $row['last_name'];
    $email = $row['email'];
    $user_image_path = $row['user_image_path'];
    $_SESSION['profile_picture'] = $user_image_path;
} else {
    die("Error: User not found.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/profile_menu.css">
    <link rel="stylesheet" href="css/user_profile/main.css">
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">


    <link rel="stylesheet" href="css/P_user.css">

    <script src="js/main.js" defer></script>
    <script src="js/side_menubar.js" defer></script>
    <title>My Profile</title>

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
            <h2>User Profile</h2>
            <div style="text-align:center;">
                <img src="profile_pictures/users/<?php echo $user_image_path; ?>" alt="User Profile Picture" style="width: 150px; height: 150px; border-radius: 50%;text">
            </div>
            <form method="post" enctype="multipart/form-data" id="uploadPhotoForm" class="user_form">
                <input type="file" name="user_image" required>
                <button type="submit" name="upload_photo">Change Photo</button>
            </form>

            <!-- Profile update form -->
            <form method="post" id="profileForm" class="user_form">
                <div>
                    <label for="fname"><strong>First Name:</strong></label>
                    <input type="text" id="fname" name="fname" value="<?php echo $fname; ?>" disabled>
                </div>
                <div>
                    <label for="lname"><strong>Last Name:</strong></label>
                    <input type="text" id="lname" name="lname" value="<?php echo $lname; ?>" disabled>
                </div>
                <div>
                    <label for="email"><strong>Email:</strong></label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>" disabled>
                </div>
                <button type="button" id="editProfile" onclick="enableProfileEditing()">Edit</button>
                <button type="submit" name="update_profile" id="saveProfile" style="display:none;">Save Changes</button>
            </form>

            <!-- Password reset form -->
            <form method="post" id="passwordForm" class="user_form">
                <div class="C_pwd">
                    <input type="password" id="current_password" name="current_password" placeholder="Enter current password" style="display:none;">
                </div>
                <div>
                    <label for="new_password"><strong>New Password:</strong></label>
                    <input type="password" id="new_password" name="new_password" disabled>
                    <?php if (isset($message)) echo $message; ?>
                </div>
                <button type="button" id="resetPassword" onclick="enablePasswordReset()">Reset Password</button>
                <button type="submit" name="reset_password" id="savePassword" style="display:none;">Save New Password</button>
            </form>

            <!-- Delete Account Form -->
            <form method="post" id="deleteAccountForm" class="user_form">
                <button type="submit" name="delete_Account" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">Delete Account</button>
            </form>
        </div>
    </div>

    <?php require 'include/footer.php' ?>

    <script>
          // Enable profile form for editing
          function enableProfileEditing() {
            document.getElementById('fname').disabled = false;
            document.getElementById('lname').disabled = false;
            document.getElementById('email').disabled = false;
            document.getElementById('saveProfile').style.display = 'inline';
            document.getElementById('editProfile').style.display = 'none';
        }

        // Enable password reset form
        function enablePasswordReset() {
            document.getElementById('current_password').style.display = 'inline';
            document.getElementById('new_password').disabled = false;
            document.getElementById('savePassword').style.display = 'inline';
            document.getElementById('resetPassword').style.display = 'none';
        }

        // Event listener for file upload form submission
        document.getElementById('uploadPhotoForm').addEventListener('submit', function (event) {
            if (!confirm('Are you sure you want to change your profile photo?')) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>