<?php
//session_start();
include_once '../config/dbconfig.php';
$title = 'Registration Successful | '.SITE_NAME;
include_once "includes/header.php";
?>
<div class="dark-overlay"></div>
<section>
    <div class="reg-success"  data-aos="fade-up">
        <div class="close2"><i class="fa fa-xmark black"></i></div>
        <img src="assets/img/metro-logo-black.png" height="40px" width="120px" alt="logo">
        <h3>Congratulations!</h3>
        <p>We're thrilled to welcome you to where convenience meets security.</p>
        <p>Your application has been submitted successfully, and we're now processing your information.</p>
        <p>Once your account is set up, you'll gain access to a suite of powerful banking features, allowing you to manage your finances effortlessly. Stay tuned for updates.</p>
        <img src="assets/img/undraw_completed_m9ci.svg" height="200px" width="200px" alt="logo">
        <br><br>
        <!-- <a class="red-button white" href="./login.php">continue</a> -->
    </div>
  
    <div class="text-container align-center">
        <h4 style="color: white; font-weight:700; background: #2548af; padding: 10px; text-align: center;">Application Submitted Successfully</h4>
                <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
        <p style="text-align:center;"><strong style="color:green;">Dear <?php echo SITE_NAME_SHORT; ?> Customer,</strong> Please wait till Our Customer Service validates your account,
                                         then you can login to your account.</p>
        <p style="text-align:center;">Please note that this Process may take <strong style="color:green;">1-2 business working days</strong>, once your account is validated, you will be notified through your registered 
                    		  email address</p>
        <p style="text-align:center;">A copy of your <?php echo SITE_NAME_SHORT; ?> registration details has been sent to your email address including the <strong style="color:orange;"><?php echo SITE_NAME_SHORT; ?> 10 Digit Account </strong>
                    		  Number and other vital information</p> 
                    		  
        <p style="text-align:center;">Kindly check your email for further information</p> 
                    		 
        <p>Welcome onboard!!!</p>
        <p><?php echo SITE_NAME; ?></p>
             
        <br>
        <a class="red-button align-center" style="color:white; font-weight:700;" href="./login.php">OKAY</a>
                
    </div>
</section>
<script>
    var successModal = document.querySelector('.reg-success');
    var overlay = document.querySelector('.dark-overlay');
    var closeIcon = document.querySelector('.close2');
    closeIcon.addEventListener("click", function(e){
        e.preventDefault();
        overlay.style.display = "none";
        successModal.style.display = "none";  
    })
</script>
<?php include "includes/footer.php"; ?>