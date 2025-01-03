<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help (FAQ) - PetLife</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/faq_css.css">
    <link rel="icon" href="assets/images/logo.jpeg" sizes="16x16" type="image/jpeg">


    <script src="js/main.js" defer></script>
</head>
<body>
    
    <?php require 'include/header.php' ?>

    <div class="content">
        <section class="help-header">
            <h1>HELP (FAQ)</h1>
            <p>Do you need help?</p>
            <div class="help-description">
                <p>Greetings from our Help page! If you have any questions or concerns about our online pet care services, we are here to help. Our committed support staff is available to assist you with scheduling a veterinarian visit, navigating our pet store, or comprehending our grooming options. In order to get fast help, you can use our live chat tool to connect with us immediately or look up answers to frequently asked issues in our FAQ section. Please feel free to write us at support@example.com with more complicated questions, and we will respond as soon as we can. Our first focus is the welfare of your pet, and we're dedicated to giving you the finest assistance we can!</p>
            </div>
        </section>

        <section class="FAQ-section">
            <h2>FAQ</h2>
            <div class="FAQ-container">
                <div class="FAQ-item">
                    <button class="FAQ-question">General Questions</button>
                    <div class="FAQ-answer">
                        <p>Welcome to our area dedicated to Frequently Asked Questions (FAQ)! Answers to some of the most frequently asked questions concerning our policies, goods, and services can be found here. This section has all the information you need, whether you're wondering how to sign up, want to learn more about the services we offer, or need assistance navigating the website. Please contact our customer support team if you are unable to find the answer to your query here.</p>
                    </div>
                </div>
                <div class="FAQ-item">
                    <button class="FAQ-question">Order Process</button>
                    <div class="FAQ-answer">
                        <p>Our goal is to make ordering from our pet supply online as easy and seamless as we can. We'll walk you through every step of placing an order in this section, from choosing your products to finishing the checkout procedure. Additionally, you'll find details on order tracking, payment methods, and what to do in the event that something goes wrong. This guide will make sure that your pet medication, toys, and grooming supplies are all purchased smoothly.</p>
                    </div>
                </div>
                <div class="FAQ-item">
                    <button class="FAQ-question">Payment Information</button>
                    <div class="FAQ-answer">
                        <p>For the convenience and peace of mind that comes with buying, we provide a range of safe payment methods. This section contains information on the available payment options, instructions for using gift cards and discount codes, and responses to frequently asked issues regarding payment security. Whether you want to handle your payments using PayPal, credit cards, or other channels, we guarantee a secure and quick processing experience. Our support staff is here to assist you if you have any questions or concerns regarding payments.</p>
                    </div>
                </div>
                <div class="FAQ-item">
                    <button class="FAQ-question">Services Information</button>
                    <div class="FAQ-answer">
                        <p>This section contains all the information you need to know about the services we offer, such as grooming, dog walking, pet training, and pharmacy options. It also explains how to schedule appointments, what to expect during each service, and the policies we have in place to ensure a smooth experience for both you and your pet. If you have any more questions, please don't hesitate to contact our team. We strive to provide a wide range of pet care services to keep your furry friends happy and healthy.</p>
                    </div>
                </div>
                <div class="FAQ-item">
                    <button class="FAQ-question">Account Management</button>
                    <div class="FAQ-answer">
                        <p>Managing your account on our website is simple and secure. In this section, you'll find information on creating an account, updating your personal details, changing your password, and managing your subscriptions or orders. Whether you're a new user or an existing customer looking to make updates, we’re here to guide you through every step of the process. If you encounter any issues, our support team is ready to assist you in keeping your account information up-to-date and secure.</p>
                    </div>
                </div>
            </div>
        </section>
</div>
    <?php require 'include/footer.php' ?>
    <script>
      // FAQ  Script
const faqQuestions = document.querySelectorAll('.FAQ-question');

faqQuestions.forEach(question => {
    question.addEventListener('click', () => {
        const answer = question.nextElementSibling;

        //  display the answer
        if (answer.style.display === 'block') {
            answer.style.display = 'none';
        } else {
            answer.style.display = 'block';
        }
    });
});
    </script>

</body>
</html>
