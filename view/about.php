<?php
include_once "../config/dbconfig.php";
$title = 'About | '.SITE_NAME;
include "includes/header.php"; ?>
<div class="hero-banner" style="background: transparent url('assets/img/hd/woman-using-smartphone.jpg') center center no-repeat; background-size: cover; height: 500px;">  
        <div class="banner-center">
            <h1> Our brief but brilliant history </h1>
            <h3></h3>
            <!--<a class="banner-btn" href="/">Apply Now</a>-->
        </div>
</div>
<section>
    <h1 class="align-center" data-aos="fade-up">Changing the Britain ways</h1>
    <p class="align-center" data-aos="fade-up">We’ve built a different kind of high street bank. A bank with stores that are open when it suits you, where you can walk in without an appointment and leave with a working account, debit card and all. A bank that tells you exactly what you’re getting, in language that actually makes sense. A bank that puts you first.</p>
    <div class="bank-diff">
        <div class="items" data-aos="fade-up">
            <img src="assets/img/heart.jpg" alt="">
            <h4>A fresh start to banking</h4>
            <p><?php echo SITE_NAME_SHORT ?> first opened its doors in the summer of 2010, the first high street bank to open in the UK in over 100 years. </p>
            <!--<a href="support.html" class="blue-button">Get started</a>-->
        </div>    
        <div class="items" data-aos="fade-up">
            <img src="assets/img/awards_2.jpg" alt="">
            <h4>Bringing personal service back to banking</h4>
            <p>We’re here to help, just walk in at a time that’s right for you – no need to book an appointment. </p>
            <!--<a href="" class="blue-button">Take a look</a>-->
        </div>
        <div class="items" data-aos="fade-up">
            <img src="assets/img/2-people-icon.jpg" alt="">
            <h4>Banking. But better</h4>
            <p>We keep our products simple and we do the same for our rates and charges, so you’ll always know exactly what you’re getting. No more nasty surprises in the small print.</p>
            <!--<a href="" class="blue-button">Find out more</a>-->
        </div>
    </div>
</section>
<div class="slanted">
    <h1 class="align-center">Protecting your money</h1>
    <!--<p>Your eligible deposits with Metro Bank are protected by the FSCS.</p>-->
    <a href="./register" class="red-button align-center">How the FSCS protects you</a>
</div>
<section>
    <h2 class="align-center" data-aos="fade-up">What we're all about</h2>
    <p class="align-center" data-aos="fade-up">We're committed to making a difference and delivering a different type of banking for Britain.</p>
    <div class="about-us">
        <div class="items" data-aos="fade-up">
            <div class="left">
                <h4>Committed to customer service</h4>
                <p>We are committed to providing you with unparalleled levels of service and convenience. This is why our stores are open early 'til late. We offer a super-quick account opening, on the spot card printing as well as a 24/7 London-based contact centre.</p>
            </div>
            <img src="assets/img/mpin_shirt.jpg" alt="Committed to customer service">
        </div>
        <div class="items" data-aos="fade-up">
            <div class="left">
                <h4>Committed to kids</h4>
                <p>Kids matter at <?php echo SITE_NAME_SHORT ?>. Every year we help thousands of children take their first steps with money. We encourage them to save and count their coins using our Magic Money Machines and learn about budgeting with our financial education programme.</p>
            </div>
            <img src="assets/img/balloons-red.jpg" alt="Committed to kids">
        </div>
        <div class="items" data-aos="fade-up">
            <div class="left">
                <h4>Committed to community</h4>
                <p>It's really important to us that we give something back to the communities we serve. Every year we host thousands of charity and business networking events across our stores. We’re proud to partner with a leading charity to help support young people with cancer.</p>
            </div>
            <img src="assets/img/heart_of_community.jpg" alt="Committed to community">
        </div>
        <div class="items" data-aos="fade-up">
            <div class="left">
                <h4>Committed to sustainability</h4>
                <p>Our ambition to be the number one community bank goes hand in hand with acting sustainably and responsibly towards our customers, our colleagues and our environment. We’re working on becoming net zero, and we can help our customers make sustainable choices too.</p>
            </div>
            <img src="assets/img/savings_growth.jpg" alt="Committed to kids">
        </div>
    </div>
</section>
<?php include "includes/footer.php";?>