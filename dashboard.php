<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/profile_menu.css">
    <link rel="stylesheet" href="css/admin_panel/dashboard.css">
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">

    <script src="js/main.js" defer></script>
    <title>Dashboard</title>
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
            <div class="dash-grid-container">
                <div class="grid-item-1 item">
                    <h1>Today</h1>
                    <div class="data">
                        <div id="bar">
                            <div id="work-progress"></div>
                        </div>
                        <div class="text">
                            <h3>Currently working</h3>
                            <p>2</p>
                            <h3>Total finished</h3>
                            <p>8</p>
                            <h3>Total work for today</h3>
                            <p>10</p>
                        </div>
                    </div>
            </div>

            <div class="grid-item-2 item">
                <h1>Revenue</h1>
                <canvas id="revenue-chart" width="500" height="400"></canvas>
                <h2>Today</h2>
                <h1>Rs. 15000.00</h1>
                <h2>Last week</h2>
                <h1>Rs. 85000.00</h1>

            </div>
            <div class="grid-item-3 item">
                <h1>Appointments</h1>
                <div class="data">
                    <div id="bar">
                        <div id="app-progress"></div>
                    </div>
                    <div class="text">
                        <h3>Currently working</h3>
                        <p>2</p>
                        <h3>Total finished</h3>
                        <p>8</p>
                        <h3>Total work for today</h3>
                        <p>10</p>
                    </div>
                </div>
            </div>
        </div>
    <?php if ($_SESSION['role'] == "manager") {
    ?>
        <a href="process/generate_report.php"><button id="gen-report-btn">Generate Report</button></a>
    <?php
    } ?>
</div>

<script>
    // Credit: https://youtu.be/n8uCt1TSGKE
    const lineData = [100, 200, 150, 50, 250, 350, 180]
    
    const canvas = document.getElementById("revenue-chart")
    const context = canvas.getContext("2d")

    const canvasWidth = canvas.width
    const canvasHeight = canvas.height
    const chartHeight = canvasHeight - 50
    const maxDataValue = Math.max(...lineData)
    const barWidth = 50;
    const barGap = 20;
    const scaleFactor = chartHeight / maxDataValue

    function drawLineChart() {
        context.clearRect(0, 0, canvasWidth, canvasHeight)
        context.beginPath()
        context.moveTo(50, canvasHeight - lineData[0] * scaleFactor - 30)

        lineData.forEach((value, index) => {
            const x = index * (barWidth + barGap) + 50
            const y = canvasHeight - value * scaleFactor - 30
            context.lineTo(x, y)
        })

        context.strokeStyle = "green"
        context.lineWidth = 2
        context.stroke()
    }

    function drawProgressBar(id, available, finished) {
        const percentage = (finished / available) * 100
        console.log(percentage)
        const progress = document.getElementById(id)
        progress.style.height = percentage + "%" 
    }

    drawLineChart()
    drawProgressBar("work-progress", 10, 8)
    drawProgressBar("app-progress", 10, 3)
</script>
        </div>
    </div>
</div>

    <?php require 'include/footer.php' ?>
</body>
</html>