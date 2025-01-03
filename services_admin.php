<?php
    session_start();
    require 'process/connect_dbshop.php';
?>
<?php
    $ADD=0;
    $servicename="";
    if($_SERVER['REQUEST_METHOD']=='POST'){

        if(isset($_POST['Adding'])){
            $servicename=$_POST['name1'];
            $servicerate=$_POST['rate'];

            if(isset($servicename)){

                $test="SELECT service_type FROM `services`;";
                $resulttest=mysqli_query($conn,$test);
                $num=mysqli_num_rows($resulttest);

                while($num=mysqli_fetch_assoc($resulttest)){

                    if($num['service_type']==$servicename){
                        echo "that service is already exists!!";
                        $ADD=1;
                    }

                }
                if($ADD==0){
                    $sql="INSERT INTO `services`(service_type, service_rate, availability_status) 
                        VALUES('$servicename', $servicerate, 'Y');";

                    $result=mysqli_query($conn,$sql);

                    if($result){
                        echo "successfully added !";
                    }
                }
            }
        }

        $REMOVE=0;
        $exist=0;
        if(isset($_POST['Removing'])){
            $servicename=$_POST['name2'];

            if(isset($servicename)){

                $test="SELECT service_type FROM `services`;";
                $resulttest=mysqli_query($conn,$test);
                $num=mysqli_num_rows($resulttest);

                while($num=mysqli_fetch_assoc($resulttest)){

                    if($num['service_type']!=$servicename){
                        $REMOVE=1;
                    }
                    else{
                        $exist=1;
                        $sql="DELETE FROM `services` WHERE service_type='$servicename';";

                        $result=mysqli_query($conn,$sql);

                        // if($result){
                        //     echo "successfully deleted the record !";
                        // }
                    }

                }
                if($exist==0  && $REMOVE==1){
                    echo "service is not in list to delete !!";
                }
            }
        }
        
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Services</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/profile_menu.css">
    <link rel="stylesheet" href="css/services_admin.css">
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">


    <script src="js/main.js" defer></script>
</head>
<body>
    <?php require 'include/header.php' ?>

    <div class="grid-container">
        <div class="sidebar">
            <a href="dashboard.php" class="btn active">Dashboard</a>
            <a href="users_admin.php" class="btn">Users</a>
            <a href="appointments.php" class="btn">Appointments</a>
            <a href="products.php" class="btn">Products</a>
            <a href="services_admin.php" class="btn">Services</a>
            <a href="admin_inquiry.php" class="btn">Inquiry</a>
            <button id="log-out-btn"><a href="process/log_out.php">Log out</a></button>
        </div>
        
        <div class="profile-content">

            <div class="container">
                <h1>Admin Panel - Pet Care Services</h1>
        
                <section class="services">
                    <form method="post" class="service-form">
                    <img src="assets/images/logo.jpeg" id="service-logo">
                    <h2>Available Services</h2>
                    <button type="submit" name="to-watch">Click To Watch Available Services</button>
                    <button id="non-click" type="submit" name="out-watch">Click To Stop from Watching Available Services</button>
                    <ul id="servicesList">
                        <?php
                        if($_SERVER['REQUEST_METHOD']=='POST'){
        
                            if(isset($_POST['to-watch'])){
        
                                $sql="SELECT service_type FROM `services`;";
        
                                $result=mysqli_query($conn,$sql);
                                $row=mysqli_num_rows($result);
        
                                while($row=mysqli_fetch_assoc($result)){
                                    echo "<li>". $row['service_type'] . "</li> <br>";
                                }
                            }
                            if(isset($_POST['out-watch'])){
                                $_POST['to-watch']=1;
                            }
                        }
                        
                        ?>
                    </ul>
                    </form>
                </section>
        
                <section class="add-service">
                    <h2>Add New Service</h2>
                    <form id="serviceForm" method="post" class="service-form">
                        <input type="text" id="servicename" name="name1" placeholder="Enter Service Name To Add...." required>
                        <input type="number" id="servicerate" name="rate" placeholder="Enter Service Rate To Add...." required>
                        <button type="submit" name="Adding">Add Service</button>
                    </form>
                </section>
                <section class="Remove-service">
                    <h2>Remove Existing Service</h2>
                    <form id="Removing-serviceForm" method="post" class="service-form">
                        <input type="text" id="Removing-servicename" name="name2" placeholder="Enter Service Name To Remove..." required>
                        <button type="submit" name="Removing">Remove Service</button>
                    </form>
                </section>
            </div>
        </div>
    </div>
    <?php require 'include/footer.php' ?>
</body>
</html>
