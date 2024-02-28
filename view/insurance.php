<?php
include_once "../config/dbconfig.php";
$title = 'Insurance | '.SITE_NAME;
include "includes/header2.php"; ?>
<div class="hero-banner" style="background: transparent url('assets/img/hd/cute-lady-her.jpg') center center no-repeat; background-size: cover; height: 500px;">  
        <div class="banner-center">
            <h1> Insurance </h1>
            <h3></h3>
            <!--<a class="banner-btn" href="/">Apply Now</a>-->
        </div>
</div>
<section>
    <h3 class="align-center" data-aos="fade-up">Quality insurance without the hassle</h3>
    <p class="align-center" data-aos="fade-up">Our customers are at the heart of what we do, and we know how important it is for you to have peace of mind. We’ve partnered with top insurance providers to offer premium insurance to help protect against any unexpected costs. For quality insurance without the hassle, we’ve got you covered.</p>
    <div class="fcss" data-aos="fade-right">
        <div class="item">
            <h4>Pet insurance</h4>
            <p>Your four-legged friend deserves the same protection as the rest of your family, so we’ve partnered with Everypaw Pet Insurance to offer award-winning cover. Find out more about easy-to-manage insurance for dogs, cats and rabbits with 24/7 access to vets.</p>
            <a href="./login" class="align-center white blue-button">Find out more</a>
        </div>  
        <img src="assets/img/dog-icon.jpg" width="100px" height="100px" alt="Pet insurance">  
    </div>
</section>
<section>
    <div class="fcss" data-aos="fade-right">
        <div class="item">
            <h4>Come and see us in store</h4>
            <p>We’ve always been a dog-friendly bank, so why not bring your pup along and chat to us about your banking and insurance needs. You’ll soon see why we’re rated #1 for store service – we even have dog treats and bandanas to keep the little one happy</p>
        </div>  
        <img src="assets/img/help.jpg" alt="Come and see us in store">  
    </div>
</section>
<section>
    <h2 class="align-center" data-aos="fade-up">What we're all about</h2>
    <p class="align-center" data-aos="fade-up"></p>
    <div class="about-us">
        <div class="items" data-aos="fade-up">
            <div class="left">
                <h4> Small business insurance</h4>
                <p>We’ve partnered with Churchill Expert to offer a variety of policies to our community of small business customers.</p>
                <a href="./online-banking" class="align-center white blue-button">Small business insurance</a>
            </div>
            <img src="assets/img/shop2.jpg" alt="Small business insurance">
        </div>
        <div class="items"  data-aos="fade-up">
            <div class="left">
                <h4>Personal loans</h4>
                <p>We’ve partnered with RateSetter to provide our customers with a personal loan that’s easy to apply for and simple to manage.</p>
                <a href="./login" class="align-center white blue-button">Personal loans</a>
            </div>
            <img src="assets/img/ratesetter.jpg" alt="Personal loans">
        </div>
    </div>
</section>
<?php include "includes/footer.php"; ?>