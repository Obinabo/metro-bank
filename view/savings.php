<?php
include_once "../config/dbconfig.php";
$title = 'Savings | '.SITE_NAME;
include "includes/header2.php"; ?>
<div class="hero-banner" style="background: transparent url('assets/img/hd/close-up-hand.jpg') center center no-repeat; background-size: cover; height: 500px;">  
        <div class="banner-center">
            <h1> Savings </h1>
            <h3></h3>
            <!--<a class="banner-btn" href="/">Apply Now</a>-->
        </div>
</div>
<section>
    <h2 class="align-center" data-aos="fade-up"> Our savings accounts</h2>
    <p class="align-center" data-aos="fade-up"> Whether it’s your next holiday, your first home or saving for your future, our simple range of savings accounts can help you reach your goals. And with no hidden fees or charges, you’ll reach them even faster.</p>
    <div class="bank-diff">
            <div class="items" data-aos="fade-right">
                <img src="assets/img/savings_pig.jpg" alt="">
                <h4>instant access savings accounts</h4>
                <p>Save what you want, when you want – with instant access to your cash whenever you need.</p>
                <!--<a href="support.html" class="blue-button">Get started</a>-->
            </div>
            <div class="items" data-aos="fade-up">
                <img src="assets/img/purse.jpg" alt="">
                <h4>Instant access cash</h4>
                <p>Tax-free interest and access to your savings whenever. We also accept transfers.</p>
                <!--<a href="" class="blue-button">Take a look</a>-->
            </div>
            <div class="items" data-aos="fade-left">
                <img src="assets/img/savings_growth.jpg" alt="">
                <h4>Young savers account</h4>
                <p>You're never too young to save. Start the good habits now.</p>
                <!--<a href="" class="blue-button">Find out more</a>-->
            </div>
        </div>
</section>
<section>
<h2 class="align-center" data-aos="fade-up"> Fixed term accounts</h2>
<div class="about-us">
        <div class="items" data-aos="fade-up">
            <div class="left">
                <h4>Fixed term savings accounts</h4>
                <p>Guaranteed interest rates – paid monthly or yearly – on fixed terms from 1 year to 3 years</p>
                <a href="./online-banking" class="align-center white blue-button">Fixed savings account</a>
            </div>
            <img src="assets/img/fixed.jpg" alt="fixed">
        </div>
        <div class="items" data-aos="fade-up">
            <div class="left">
                <h4>Fixed rate cash</h4>
                <p>Tax-free interest on lump sums or ISA transfers, for 1, 2, 3 or 5 years.</p>
                <a href="./login" class="align-center white blue-button">Fixed rate</a>
            </div>
            <img src="assets/img/more-money.jpg" alt="fixed">
        </div>
    </div>
</section>
<section>
<h2 class="align-center" data-aos="fade-up"> Want some help with your savings?</h2>
<div class="about-us">
        <div class="items" data-aos="fade-up">
            <div class="left">
                <h4>'I want to understand my savings options'</h4>
                <p>Make you money grow faster whilst making sure you always have enough easily accessible</p>
                <!--<a href="./online-banking" class="align-center white blue-button">Fixed savings account</a>-->
            </div>
            <img src="assets/img/cash.jpg" alt="fixed">
        </div>
        <div class="items" data-aos="fade-up">
            <div class="left">
                <h4>'I want to know more about how to reach my savings goals'</h4>
                <p>Get into the savings habit. Having a plan for your savings can make all the difference. Learn how to set a savings goal and commit to making it happen.</p>
                <!--<a href="./login" class="align-center white blue-button">Fixed rate</a>-->
            </div>
            <img src="assets/img/savings-3.jpg" alt="fixed">
        </div>
    </div>
</section>
<?php include "includes/footer.php"; ?>