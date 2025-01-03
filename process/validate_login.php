<?php
    session_start();
    require 'connect_dbshop.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = htmlspecialchars($_POST['email']);
        $password = md5($_POST['password']);
        $user_type = htmlspecialchars($_POST['user_type']);
        $query = "";

        if ($user_type == "customer") {
            $query = "select * from user_data where email='$email'";
            $_SESSION['profile_path'] = "user_profile.php";

        } else if ($user_type == "employee") {
            $query = "select * from employee where email='$email'";
            $_SESSION['profile_path'] = "dashboard.php";

        }

        $results = $conn->query($query);

        if ($results->num_rows > 0) {
            $row = $results->fetch_assoc();
            $stored_password = $row['password'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['user_type'] = $user_type;

            if ($stored_password === $password) {
                $_SESSION['loggedin'] = true;
                if ($user_type == 'customer') {
                    $_SESSION['userid'] = $row['user_id'];
                    $_SESSION['profile_picture'] = $row['user_image_path'];
                    header("Location: ../index.php");
                    exit;
                } else if ($user_type == 'employee') {
                    $_SESSION['userid'] = $row['emp_id'];
                    $_SESSION['profile_picture'] = "employee.jpg";
                    header("Location: ../dashboard.php");
                    exit;
                }

                // $_SESSION['role'] = $row['role'];

                
                // header("Location: ../index.php");
                // exit;
            } else {
                echo "Password Incorrect";
            }

        } else {
            echo "User not found";
        }

        $conn->close();
    }
?>