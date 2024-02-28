<?php
include_once "../config/dbconfig.php";
$title = 'Business Online Banking |'.SITE_NAME;
include "includes/header.php"; ?>

   <div class="hero-banner" style="background: transparent url('assets/img/hd/young-co-worker.jpg') center center no-repeat; background-size: cover; height: 500px;">  
        <div class="banner-center">
            <h1> Welcome to Business Online Banking </h1>
            <!--<h3>Our convenient, secure business online banking is there for you 24/7, wherever you are</h3>-->
            <!--<a class="banner-btn" href="/">Apply Now</a>-->
        </div>
    </div>
    <section>
        <h4 class="align-center" data-aos="fade-up">Our new online banking is coming soon..</h4>
        <p class="align-center" data-aos="fade-up">We’re always looking to improve your Online Banking experience – so we’re making some changes to make it simple and easier to use.</p>
        <p class="align-center" data-aos="fade-up">We’re rolling out these changes over the next few months and you don’t need to take any action. </p>
        <div class="service">
            <div class="items" data-aos="fade-right">
                <img src="assets/img/hd/two-female-friends.jpg" alt="">
                <h4>Business online banking</h4>
                <p>All the essentials of personal banking, ready for business.<br/>
                We may send you a one-time passcode when you make payments and changes to your account. Please make sure we have the right mobile number for you in the 'personal details' section of your Online Banking. If you want to change your mobile phone number which is registered with us, call us or visit a store.
                   </p>
                <!--<a href="support.html" class="blue-button">Come and see us</a>-->
            </div>
            
            <div class="items" data-aos="fade-left">
                <img src="assets/img/hd/businesswoman-working.jpg" alt="">
                <h4>Commercial online plus and Commercial online banking</h4>
                <p>Flexible user roles and more ways to pay for businesses with large or complex finance teams.
                    <br/>
                    You’ll need to either download the <?php echo SITE_NAME_SHORT ?> Authenticator app from the Apple App Store or Android Google Play, or use a  security device to log in, approve payments and make account changes.</p>
                
                <!--<a href="" class="blue-button">Explore our app</a>-->
            </div>
        </div>
    </section>

    <section>  
        <div class="fcss" data-aos="fade-up">
            <div class="item">
                <h4>Bacs payments</h4>
                <p>Make and manage payments from anywhere with Bacs-approved, BACSTEL-IP, cloud-based software, used to securely manage your Bacs direct credits and direct debits.</p>
            </div>  
            <!--<img src="assets/img/benefits_people-icon.jpg" width="100px" height="100px" alt="Benefits_of_Metro">  -->
        </div>
    </section>
    <section>
    <div class="fcss" data-aos="fade-up">
        <div class="item align-center">
            <h4>Need to register?</h4>
            <p>You'll need to sign up for these services before you can log in to  for the first time. To do this, get in touch with your Relationship Manager.</p>
        </div>  
        <!--<img src="assets/img/benefits_people-icon.jpg" width="100px" height="100px" alt="Benefits_of_Metro">  -->
    </div>
    </section>

<?php include "includes/footer.php"; ?>