<?php 
include_once "../config/dbconfig.php";
$title = 'Bank Accounts | '.SITE_NAME;
include "includes/header2.php"; ?>
<div class="hero-banner" style="background: transparent url('assets/img/hd/african-american-person1.jpg') center center no-repeat; background-size: cover; height: 500px;">  
        <div class="banner-center">
            <h1> Bank Accounts </h1>
            <h3></h3>
            <!--<a class="banner-btn" href="/">Apply Now</a>-->
        </div>
</div>
<section>
    <h2 class="align-center" data-aos="fade-right">Choose the account that's right for you</h2>
    <p class="align-center" data-aos="fade-right">Get your <?php echo SITE_NAME_SHORT ?> account up and running in a single day. Pop into one of our stores any day of the week and walk out with a working bank card.
        <br/><br/>    
        Can’t make it in? Jump online and have your card posted to you within a few days
    </p>
    <div class="bank-accounts">
        <div class="item" data-aos="fade-up">
            <h4>Current Account</h4>
            <p>Save time with our same-day account opening either in store or online. We can even switch all your accounts and direct debits from your old bank within 7 working days.</p>
            <a href="./online-banking" class="blue-button">Current account</a>
        </div>  
        <div class="item2 align-center"  data-aos="fade-up">
            <h4>Cash Account</h4>
            <p>Get the flexibility of a card for payments while keeping things simple with our basic bank account.</p>
            <a href="./online-banking" class="blue-button">Cash account</a>
        </div> 
    </div>
    <div class="bank-accounts">
        <div class="item"  data-aos="fade-up">
            <h4>Open your account online</h4>
            <p>You can join the revolution from anywhere in the UK with your email address, mobile number, a photo ID, device with a camera that is at least 4 megapixels and 3 years of address history.
                <br/>
                You must be a US, UK, EU or Swiss national.</p>
            <!--<a href="online-banking.php" class="blue-button">Current account</a>-->
        </div>  
        <div class="item2 align-center"  data-aos="fade-up">
            <h4>resume opening your Current Account</h4>
            <p>Already started an online application for a <?php echo SITE_NAME_SHORT ?> Current Account?</p>
            <!--<a href="online-banking.php" class="blue-button">Cash account</a>-->
        </div> 
    </div>
    <div class="fcss" data-aos="fade-up">
        <div class="item">
            <h4>Come and see us today</h4>
            <p>Our stores are open early 'til late, meaning you can pop in when it suits you. We’re working hard to keep our store hours running smoothly, but some have temporarily changed due to covid-related colleague absences. For our current hours, <a href="contact.php">click here.</a></p>
        </div>  
    </div>
</section>
<div class="slanted">
    <h1 class="align-center">Switching to us is simple</h1>
    <!--<p>Start feeling the Metro digital difference right away. All we need are the details of your old account, including the account number, sort code, card number and the date you want the switch to take place – 7 working days in the future or later.</p>-->
    <a href="contact.php" class="red-button align-center">Contact us</a>
</div>
<section>
<div class="fcss" data-aos="fade-up">
        <div class="item">
            <h4>Award winning products and services</h4>
            <p>We’ve won a lot of awards for our customer service, and we’re one of the most trusted banks on the high street.</p>
        </div>  
    </div>
</section>
<?php include "includes/footer.php"; ?>