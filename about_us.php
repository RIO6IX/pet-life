<?php
    session_start();
    require 'process/connect_dbshop.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - PetLife Co</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/about_us.css">
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">


    <script src="js/main.js" defer></script>

</head>
<body>

    <?php require "include/header.php" ?>

    <div class="content">
        <section class="about-us-section">
            <h1>ABOUT US</h1>
            <div class="about-us-content">
                <div class="text-content">
                    <p> At Pet Life Co pvt, the goal is to make pet care convenient and comprehensive for all pet owners. On our platform, you will find everything required to keep your pets happy, healthy, and well taken care of, including premium toys.
                        All consumables necessary for professional grooming services; significant steps in
                        Pets can benefit from long-lasting, non-toxic products that are thoughtfully chosen.
                        Our talented groomers pamper pets of every breed or size to make them feel and look at their best..</p>
                    <p>Second, our reliable dog walking services will keep your pets engaged and healthy.
                        energised, with walkers prioritizing enjoyment and safety. Convenience is what our pharmacy delivers.
                        and timeliness in the delivery of health supplies and prescription medication to keep your pet healthy. Our goal at Pet Life Co. Pvt Ltd is to be</p>
                </div>
                <div class="image-placeholder">
                    <img src="assets/images/3781987.jpg" alt="About Us Image">
                </div>
            </div>
        </section>
        <section class="services-section">
            <h2>Services you can get by joining us:</h2>
            <ul>
                <li>Toys & Supplies</li>
                <li>Grooming Services</li>
                <li>Dog Walking</li>
                <li>Pharmacy Services</li>
            </ul>
        </section>

        <section class="partners-section">
            <h2>Our partner companies:</h2>
            <div class="partner-companies">
                <div class="partner">Dog zilla</div>
                <div class="partner">Cat com</div>
                <div class="partner">Bird paradise</div>
                <div class="partner">Zaraa</div>
            </div>
        </section>
</div>

    <?php require 'include/footer.php' ?>

</body>
</html>