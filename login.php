
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetLife Co - Login</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login/Lstyles.css">
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">

</head>
<body>
    <!-- <?php require 'include/header.php' ?> -->

    <div class="content">

        <div class="login-container">
            <div class="login-box">
                <h1>Log in</h1>
                <div class="err-msg" style="color:red;"></div>
                <form action="process/validate_login.php" method="POST">
                    <select name="user_type">
                        <option value="customer">Customer</option>
                        <option value="employee">Employee</option>
                    </select>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    <label for="password">Password</label>
                    <div class="password-box">
                        <input type="password" id="password" name="password" required>
                        <span class="show-password" onclick="togglePassword()"></span>
                    </div>
    
                    <a href="#" class="forgot-password">Forgot your password?</a>
    
                    <button type="submit">Log in</button>
                </form>
                
                <div class="or-divider">
                    <span>or</span>
                </div>
        
                <p>Don't have an account yet? <a href="user_registration.php">Sign up here</a></p>
            </div>
        </div>
    </div>

    <!-- <footer>
        <div class="footer-content">
            <span class="footer-logo">🐾 PetLife Co Pvt Ltd</span>
            <span class="copyright">Copyright ©2024</span>
            <a href="#">Contact us</a>
            <a href="#">About us</a>
        </div>
    </footer> -->

    <?php require 'include/footer.php' ?>

    <script src="js/main.js"></script>
    <!-- <script src="js/login/login.js"></script> -->

</body>
</html>

