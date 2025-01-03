<?php
    session_start();
    require 'process/connect_dbshop.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone_number = $_POST['pnumber'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $street = $_POST['street'];
        $city = $_POST['city'];
        $postal_code = $_POST['postal_code'];
        $service_provided = $_POST['service-provided'];
        $role = $_POST['role'];
        
        $check_user_query = "select emp_id from employee where email='$email'";
        $results = $conn->query($check_user_query);

        $error_message = "";

        if ($results->num_rows > 0) {
            $error_message = "Account already exists. Try login.";
        } else {
            $add_user_query = "insert into employee(first_name, last_name, city, street, postal_code, email, password, service_provided, role) 
                               values('$fname', '$lname', '$city', '$street', '$postal_code', '$email', '$password', '$service_provided','$role')";

            $conn->query($add_user_query);

            // credit: https://stackoverflow.com/questions/3422168/safest-way-to-get-last-record-id-from-a-table
            $get_prev_id = "select max(emp_id) from employee";
            //--------------------------------------------------------------------------------------------------
            $prev_id = $conn->query($get_prev_id);

            if ($prev_id->num_rows > 0) {
                $row = $prev_id->fetch_assoc();
                $id = $row['max(emp_id)'];
                $add_phone_num = "insert into employee_phone(emp_id, phone_num) values($id, '$phone_number')";

                $conn->query($add_phone_num);
            }

            header("Location: users_admin.php");
            exit;

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">

    <title>Sign Up</title>

    <style>

        body {
            height: 100vh;
        }

        #reg-form {
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
        }

        #reg-form > input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            font-size:1.5rem;
            padding: 5px;
        }

        #reg-form select {
            font-size: 1.5rem;
            padding: 5px;
        }

        textarea {
            height: 50px;
            resize: none;
            font-size: 1.5rem;
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

        #submit-btn:disabled {
            background-color: gray;
        }

        #password-status {
            font-size: 20px;
        }

    </style>
</head>
<body>

    <?php require 'include/header.php' ?>

    <div class="content">

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" id="reg-form">
            <label for="role">Role</label>
            <select name="role" id="role" required>
                <option value="staff">Staff</option>
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
            </select><br>

            <label for="service-provided">Service Provided</label>
            <input type="text" name="service-provided" id="service-provided" required><br>

            <label for="fname">First Name</label>
            <input type="text" name="fname" id="fname" required><br>

            <label for="fname">Last Name</label>
            <input type="text" name="lname" id="lname" required><br>

            <label for="fname">Phone Number</label>
            <input type="text" name="pnumber" id="pnumber" pattern="[0][7][0-9]{8}" required><br>

            <label for="fname">Email</label>
            <input type="email" name="email" id="email" required><br>

            <label for="fname">Password</label>
            <input type="password" name="password" id="password" required><br>
           
            <div>
            <label for="cpassword">Confirm Password</label><span id="password-status"></span>
            <input type="password" name="c-password" id="c-password" onkeyup="checkPassword(this.value)" required>
            </div>
            <br>

            <label for="address">Address</label>
            <input type="text" name="street" id="street" placeholder="Street" required><br>
            <input type="text" name="city" id="city" placeholder="City" required><br>
            <input type="text" name="postal_code" id="postal_code" placeholder="Postal Code" required><br>
            
            <br><br>
            <div>
                <input type="checkbox" name="terms" id="terms"> 
                Agree to Terms and Conditions
            </div>


            <button type="submit" id="submit-btn">Add Account</button>
        </form>
    </div>

    <script>

        let submit_button = document.getElementById("submit-btn")
        let accept_terms = document.getElementById("terms")
        submit_button.disabled = true
        var password_match = false

        accept_terms.addEventListener('click', function() {
            if (accept_terms.checked && password_match) {
                submit_button.disabled = false
            } else {
                submit_button.disabled = true
            }
        })


        function checkPassword(cpassword) {
            const password = document.getElementById("password").value;
            const status = document.getElementById("password-status");
            
            if (cpassword == "") {
                status.innerText = "";
            }else if (password == cpassword) {
                status.innerText = "✅"
                password_match = true
            } else {
                status.innerText = "❌"
            }
            console.log(password)
            console.log(cpassword)
        }

        // function test() {
        //     document.getElementById("fname").value = "test";
        //     document.getElementById("lname").value = "test";
        //     document.getElementById("pnumber").value = "0707181470";
        //     document.getElementById("email").value = "test1234@gmail.com";
        //     document.getElementById("password").value = "test1234";
        //     document.getElementById("c-password").value = "test1234";
        //     document.getElementById("street").value = "test";
        //     document.getElementById("city").value = "test";
        //     document.getElementById("postal_code").value = "12345";
        // }

        // test();
    </script>
    <?php require 'include/footer.php' ?>
</body>
</html>