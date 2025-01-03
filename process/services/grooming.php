<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "petcaredb";
    $conn = "";

    $conn = mysqli_connect($db_server,$db_user,$db_pass,$db_name);
?>
<?php

    if($_SERVER['REQUEST_METHOD']=='POST'){
        
        if(isset($_POST['fsub'])){

            if(isset($_POST['ownerName']) && isset($_POST['petName']) && isset($_POST['service']) && isset($_POST['servicedate']) && isset($_POST['servicetime'])){
                $ownername=$_POST['ownerName'];
                $petname=$_POST['petName'];
                $service=$_POST['service'];
                $date=$_POST['servicedate'];
                $time=$_POST['servicetime'];

                $sql = "INSERT INTO grooming(ownername,petname,service,service_date,service_time)
                        VALUES ('$ownername','$petname','$service','$date','$time')";

                mysqli_query($conn,$sql);
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pet Grooming Services</title>
    <link rel="stylesheet" href="Groomin.css">
</head>
<body>
    <header>
        <div class="logo"><a href="http://localhost/index.php">PetGo</a></div>
    </header>
    <script>
        function scrollbar(){
            const bookingSection=document.getElementById('booking');
            bookingSection.scrollIntoView({behavior:'smooth'});
        }

        document.getElementById('fsub').onclick=function(){
    
            var owner=document.getElementById('ownerName').value;
            var pet=document.getElementById('petName').value;
            var serv=document.getElementById('service').value;
            var date = document.getElementById('date').value;
            var time = document.getElementById('time').value;
            
            if(owner=="" || pet=="" || serv=="" || date=="" || time=="" ){
                alert(`please fill the form!!`);
            }
            else{
                alert(`Thank you ${owner} for appointment ${pet} is booked on ${date} ${time} for ${serv}.`)        
            }
}
    </script>
    <section class="hero">
        <h1>Premium Pet Grooming Services</h1>
        <p>Expert care for your furry friend</p>
        <button type="submit" class="cta-btn" id="apill" onclick="scrollbar()" >Book a Grooming Session</button>
    </section>

    <section class="services">
        <h2>Our Grooming Services</h2>
        <div class="service-list">
            <div class="service-item">
                <img src="bath.jpg">
                <h3>Bath and Brush</h3>
                <p>Keep your pet clean and shiny.</p>
                <span>Rs.1000</span>
            </div>
            <div class="service-item">
                <img src="haircut.jpg">
                <h3>Haircuts and Trims</h3>
                <p>Custom styles for your pet's look.</p>
                <span>Rs.2000</span>
            </div>
            <div class="service-item">
                <img src="nail.jpg">
                <h3>Nail Clipping</h3>
                <p>Safe and gentle nail trimming.</p>
                <span>Rs.3000</span>
            </div>
            <div class="service-item">
                <img src="board.jpg">
                <h3>Pet Boarding</h3>
                <p>Safetly you can board your pet.</p>
                <span>Rs.4500</span>
            </div>
        </div>
    </section>

    <section class="booking" id="booking">
        <h2>Book Your Grooming Session</h2>
        <form id="bookingForm" method="post">
            <label for="ownerName">Owner's Name:</label>
            <input type="text" id="ownerName" name="ownerName" required>

            <label for="petName">Pet's Name:</label>
            <input type="text" id="petName" name="petName" required>

            <label for="service">Select Service:</label>
            <select id="service" name="service" required>
                <option value="Bath and Brush - Rs.1000">Bath and Brush - Rs.1000</option>
                <option value="Haircuts and Trims - Rs.2000">Haircuts and Trims - Rs.2000</option>
                <option value="Nail Clipping - Rs.3000">Nail Clipping - Rs.3000</option>
                <option value="Pet Boarding Per Day - Rs.4500">Pet Boarding Per Day - Rs.4500</option>
            </select>

            <label for="date">Preferred Date:</label>
            <input type="date" id="date" name="servicedate" required>

            <label for="time">Preferred Time:</label>
            <input type="time" id="time" name="servicetime" required>

            <button type="submit" name="fsub" id="fsub">Submit</button>
        </form>
    </section>

    <script src="Groominaddd.js"></script>
</body>
</html>
