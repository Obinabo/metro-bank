<?php 
include_once "../config/dbconfig.php";
$title = 'Online Banking | '.SITE_NAME;
include "includes/header.php"; ?>
<section>
        <h1>Register and Reset your Credentials for Internet Banking</h1>
        <p>You can register for internet banking and manage your account from anywhere you have an internet connection. </p>
        <br/>
        <h3>What You Need To Begin..</h3>
        <div class="bank-diff">
            <div class="items" data-aos="fade-right">
                <img src="assets/img/number_1_blue_circle.jpg" alt="">
                <h4>Start your application</h4>
                <p>Apply for an online banking here or in store.<br/> Fill out the forms and submit.</p>
                <!--<a href="support.html" class="blue-button">Get started</a>-->
            </div>
            <div class="items" data-aos="fade-up">
                <img src="assets/img/number_2_blue_circle.jpg" alt="">
                <h4>Wait for approval</h4>
                <p>Wait for our admins to process and open up your account.<br/> You'll be notified by mail</p>
                <!--<a href="" class="blue-button">Take a look</a>-->
            </div>
            <div class="items" data-aos="fade-left">
                <img src="assets/img/number_2_blue_circle.jpg" alt="">
                <h4>Start your internet banking</h4>
                <p>Once you're notified by mail that your account has been created, you'll be provided with credentials for your internet banking.</p>
                <!--<a href="" class="blue-button">Find out more</a>-->
            </div>
        </div>
        
</section>
<div class="slanted">
    <h1 class="align-center">Ready to join the people-people bank?</h1>
    <a href="./register" class="red-button align-center">Register for internet</a>
</div>
<section>
    <div class="fcss" data-aos="fade-up">
        <div class="item">
            <ul>
                <li>Experience store service that’s been rated #1 ten times in a row</li>
                <li>Speak to our friendly colleagues in store, seven days a week</li>
                <li>Get your card printed on the spot in store</li>
                <li>Stay in control with notifications from our five-star-rated App2</li>
            </ul>
        </div>  
        <img src="assets/img/benefits_people-icon.jpg" width="100px" height="100px" alt="Benefits_of_Metro">  
    </div>
</section>
<?php include "includes/footer.php";
?>