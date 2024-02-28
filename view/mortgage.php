<?php
include_once "../config/dbconfig.php";
$title = 'Mortgages | '.SITE_NAME;
include "includes/header2.php"; ?>
<div class="hero-banner" style="background: transparent url('assets/img/hd/cheerful-friends-sitting-class.jpg') center center no-repeat; background-size: cover; height: 500px;">  
        <div class="banner-center">
            <h1> Mortgages </h1>
            <h3></h3>
            <!--<a class="banner-btn" href="/">Apply Now</a>-->
        </div>
</div>
<section>
    <h3 class="align-center" data-aos="fade-up">Mortgage as individual as you are</h3>
    <p class="align-center" data-aos="fade-up">Looking for a mortgage? Let our team of experts guide you. They’ll take the time to ask about your individual circumstances and give advice that’s tailored to you.

        Already have a Metro Bank mortgage? Check our latest mortgage rates to see all your rate switching options.
        <br/><br/>
        Having trouble paying your mortgage? Our mortgage payment support page tells you how we can help, and has information about The Mortgage Charter. Please do let us know sooner rather than later if you are struggling.
    </p>
    <div class="about-us">
        <div class="items" data-aos="fade-up">
            <div class="left">
                <h4>Residential mortgages</h4>
                <p>Whether it’s your first time or you’re an old hand, look no further for personalised mortgage advice.</p>
                <a href="./login" class="align-center white blue-button">Residential mortgage range</a>
            </div>
            <img src="assets/img/house-blue.jpg" alt="Residential mortgages">
        </div>
        <div class="items" data-aos="fade-up">
            <div class="left">
                <h4>Buy-to-let mortgages</h4>
                <p>Build up your property portfolio with the help of our dedicated mortgage advisors.</p>
                <a href="./login" class="align-center white blue-button">Buy-to-let mortgage range</a>
            </div>
            <img src="assets/img/houses-1.jpg" alt="Buy-to-let mortgage">
        </div>
    </div>
</section>
<section>
    <div class="fcss" data-aos="fade-up">
        <div class="item">
            <h1 class="align-center">Already have a mortgage with us?</h1>
            <p>Do you need some help with your mortgage? Our friendly team can help you to:</p>
            <ul>
                <li>check your balance</li>
                <li>Update your personal details</li>
                <li>Change your payment date</li>
                <li>Make an overpayment</li>
                <li>Ask for a redemption statement</li>
            </ul>
            <a href="./contact" class="align-center white blue-button">Email us</a>
        </div>  
        <!--<img src="assets/img/benefits_people-icon.jpg" width="100px" height="100px" alt="Benefits_of_Metro">  -->
    </div>
</section>

<?php include "includes/footer.php"; ?>