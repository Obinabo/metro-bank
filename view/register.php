<?php
require_once "../config/dbconfig.php";
include_once "../config/func.inc.php";
include_once "../phpmailer/mailer.php";
$title = 'Online Application | '.SITE_NAME;

include "includes/header.php"; 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $msg = array();
    if(empty($_POST['fname'])){
        $msg[] = '<div class="error">Please enter your First name</div>';
    }else{
        $fname = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['fname'])));
    }
    if(empty($_POST['lname'])){
        $msg[] = '<div class="error">Please enter your Last name</div>';
    }else{
        $lname = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['lname'])));
    }
    if(empty($_POST['uname'])){
        $msg[] = '<div class="error">Please enter your Username</div>';
    }else{
        $uname = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['uname'])));
    }
    if(empty($_POST['upass']) || empty($_POST['upass2'])){
        $msg[] = '<div class="error">Please enter your Password</div>';
    }elseif($_POST['upass'] != $_POST['upass2']){
        $msg[] = '<div class="error">Entered Passwords does not match</div>';
    }else{
        $upass = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['upass'])));
    }
    if(empty($_POST['email'])){
        $msg[] = '<div class="error">Please enter your Email Address</div>';
    }else{
        $email = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['email'])));
    }
    if(empty($_POST['phone'])){
        $msg[] = '<div class="error">Please enter your Phone Number</div>';
    }else{
        $phone = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['phone'])));
    }
    if(empty($_POST['dob'])){
        $msg[] = '<div class="error">Please enter your Date of birth</div>';
    }else{
        $dob = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['dob'])));
    }
    if(empty($_POST['work'])){
        $msg[] = '<div class="error">Please enter your Date of birth</div>';
    }else{
        $work = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['work'])));
    }
    if(empty($_POST['addr'])){
        $msg[] = '<div class="error">Please enter your Address</div>';
    }else{
        $addr = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['addr'])));
    }
    if(empty($_POST['sex'])){
        $msg[] = '<div class="error">Please choose your Sex</div>';
    }else{
        $sex = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['sex'])));
    }
    if(empty($_POST['marry'])){
        $msg[] = '<div class="error">Please choose Relationaship status</div>';
    }else{
        $marry = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['marry'])));
    }
    if(empty($_POST['currency'])){
        $msg[] = '<div class="error">Please select currency</div>';
    }else{
        $currency = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['currency'])));
    }
    if(empty($_POST['work'])){
        $msg[] = '<div class="error">Please enter your Occupation</div>';
    }else{
        $work = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['work'])));
    }
    if(empty($_POST['country'])){
        $msg[] = '<div class="error">Please select Country</div>';
    }else{
        $country = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['country'])));
    }
    if(empty($_POST['state'])){
        $msg[] = '<div class="error">Please select State</div>';
    }else{
        $state = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['state'])));
    }
    if(empty($_POST['type'])){
        $msg[] = '<div class="error">Please select Account type</div>';
    }else{
        $type = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['type'])));
    }
    $hashedPassword = password_hash($upass, PASSWORD_DEFAULT);
    $pic = 'view/uploads/user.png';
    $regDate = date("d/m/Y h:i:s");
    $pin = 000;
    $billing_code = 'PIN';
    $a_bal = 0;
    $status = "DORMANT";
    $imf = 000;
    $cot = 000;
    $acct_no = "35".substr(rand(500000, 2000000) * date("Hid"), 0, 8);
    //$acct_no = "35".substr(uniqid(), 0, 9);
    if(empty($msg)){
        if(checkUser($con, $email, $uname) !== TRUE){
            if (createAcct($con, $acct_no, $pic, $uname, $fname, $lname, $hashedPassword, $dob, $email, $phone, $addr, $sex, $marry, $work, $country, $state, $currency, $type, $status, $billing_code, $a_bal, $pin, $imf, $cot, $regDate) === TRUE) {
                $subject = 'Internet Banking Application';
                $mail = '
                <html>
                    <head>
                        <meta charset="utf-8">
                    
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta http-equiv="x-ua-compatible" content="ie=edge">
                        <style>
                            html {background-color: rgb(206, 202, 202);}
                            body{font-family: Arial, Helvetica, sans-serif; font-size: 1em; background-color: rgb(252, 252, 252); line-height: 1.5; margin: 0 auto 0 auto; width: 100%;}
                            .header{background-color: rgb(37, 72, 175); padding-top: 20px; padding: 20px; text-align:center; display:flex;}
                            .container{padding: 10px; border-color: rgb(8, 102, 165); width: 100%; align-items: center;}
                            .footer{background-color: rgb(217, 28, 41); margin: 30px auto 0px auto; padding: 5px; -moz-box-align: center; -webkit-box-align: center; color: rgb(243, 146, 0); }
                            p {text-align: center; font-size: 1em}
                            h1{font-size: 2em; color: rgb(37, 72, 175); font-weight: bolder;}
                            h2{font-size: 1.5em; color: rgb(37, 72, 175); font-weight: bolder;}
                            .footer>.list{text-align: center; font-size: 0.7em; margin-top: 20px; padding: 20px; border-top: 1px solid rgb(201, 199, 199);}
                            .box1{margin-right: 20%;}
                            .box{width: 100%; flex-direction: column;}
                            #logo{width: 30%;}
                            a{color: #fff; text-decoration: none;}
                            a:visited{color:rgb(243, 146, 0);}
                            a:active{color:rgb(243, 146, 0)}
                            a:hover{color: #f39200;}
                            .button{
                                padding: 10px;
                                background-color: rgb(37, 72, 175);
                                color:rgb(255, 255, 255);
                                width:fit-content;
                                margin: 20px auto;
                                transition: 1s;
                                border-radius: 20px;
                            }
                            .button:hover{
                                background-color: rgb(16, 48, 143);
                                margin: 20px auto;
                            
                            }
                            img{padding: 10px; box-shadow: -5px 5px 10px rgba(71, 71, 71, 0); margin: 5px;}
                            .text-black{color: rgb(27, 27, 27)}
                            .text-white{color: rgb(253, 252, 252)}
                            .text-bold{font-weight: bold;}
                        .footer>p{font-size: 0.8em;}
                            .welcome{padding: auto; margin: auto; box-shadow: -5px 5px 10px rgba(71, 71, 71, 0); width: 80%;}
                        </style>
                    </head>
                    <body>
                        <header>
                            <div class="header">
                                <div class="box"><a href="'.URL.'">Home</a></div>
                                <!--<div class="box"> <a href="https://melksreality.com/invoice">Home</a></div>
                                <div class="box"><a href="https://melksreality.com/invoice/?a=about">About</a></div>
                                <div class="box"><a href="https://melksreality.com/invoice/?a=login">Login</a></div>
                                <div class="box"><a href="https://melksreality.com/invoice/?a=signup">Sign Up</a></div>
                                <div class="box"><a href="https://melksreality.com/invoice/?a=account">Dashboard</a></div>-->
                            </div>
                        </header>
                        <center>
                            <div id="logo"><a href="'.URL.'"><img src="'.URL.'/assets/img/metro-logo-black.png" width="120px" height="40px" alt="logo" /></a></div>          
                            <h1>Hello'.$fname.'</h1>
                            <p>Congratulations,Your Application have been recieved and is being checked, you will recieve a reply from our Accounts Department shortly </p>
                            <p>Please Note that your once your Internet Banking is activated and you will need a combination of your Email or Account Number and Password to access your online banking .</p>

                            </div>
                        </center>
                        <footer>
                            <div class="footer text-white">
                                <p class="text-bold">Address: '.ADDRESS.'.</p>
                                <!--<p class="text-bold">Phone: </p>-->
                                <p class="text-bold">Support Email:'.SITE_EMAIL.'</p>

                                <p>Kind Regards, '.SITE_TITLE.'</p>
                                <div class="list ">
                                    <p>'.SITE_TITLE.' Copyriight &#169; 2023</p>
                                </div>
                            </div>
                        </footer>
                    </body>
                </html>';
                sendEmail($email, $subject, $mail);
                redirect('./application-success');
            }else{
                $msg[] = '<div class="error">Unable to process this request at this time..
                <br>Please try again later</div>';
            }
        }else{
            $msg[] = '<div class="error">Email or username already exists</div>';
        }
               
    }
}   
 class Walter{
     public $name;
     public function deal($e){
         echo 'constructor called with parameter '.$e;
     }
 }
 $user = new Walter;
// $user->name = 'My Job <br/>';
// $user->deal('Wally<br/>');
// $acc = "35".substr(rand(500000, 2000000) * date("Y"), 0, 8);
// echo $acc;
// $cMonth = date('m');
// $currentYear = date("Y");
// $newDate = date("y", strtotime($currentYear. '+3 years'));
// $expiry = $cMonth.'/'.$newDate;
// echo '<br>'.$expiry.'<br>';
// $rand = "5399 ".sprintf("%04d %04d %04d", rand(0000,9999), rand(0000,9999), rand(0000,9999));
// echo $rand;
// $tr_id = strtoupper(substr(md5(rand(400, 500)*time()), 0, 15));
// $otp = substr(rand(4000, 5000)*time(), 0, 6);
// echo $tr_id.'<br>';
// echo $otp;
// $current_file = explode('.', basename($_SERVER['SCRIPT_NAME']));
// $ext = end($current_file);
// echo $ext;
// echo '<br>'.date("d - M - Y");

?>

<div class="reg-container" style="background: var(--blue-color) no-repeat; background-size: cover; background-position: center;">
    <div class="register">
        <div class="content">
            <h1 class="align-center">Application form</h1>
            <?php if(!empty($msg)){
                foreach($msg as $newMsg){echo $newMsg;}
            } ?>
            <form action="" enctype="multipart/form-data" method="POST" id="regForm">
                <input type="text" name="fname" placeholder="First Name" required >
                <input type="text" name="lname" placeholder="Last Name" required>
                <input type="text" name="uname" placeholder="Username" required>
                <input type="password" name="upass" placeholder="Password" required>
                <input type="password" name="upass2" placeholder="Confrim  Password" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="phone" name="phone" placeholder="Phone Number" required>
                <input data-format="dd/mm/yyyy" name="dob" type="text" placeholder="Date of Birth dd/mm/yyyy"required />
                <input type="text" name="work" placeholder="Occupation" required>
                <input type="text" name="addr" placeholder="Address" required>
                <select id="countrySelect" name="country"><option value="">Select country</option></select>
                <input type="text" name="state" placeholder="State" required>
                <select name="sex" required>
                            <option value="">Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                <select name="marry" required>
                    <option value="">Marital Status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Widowed">Widowed</option>
                    <option value="Divorced">Divorced</option>
                </select>
                <select name="currency" required>
                    <option value="">Currency</option>
                    <option value="USD $">Dollar</option>
                    <option value="GBP £">Pound</option>
                    <option value="EUR €">Euro</option>
                </select>
                <select name="type" required>
                  <option value="">Account Type</option>
                  <option value="Savings">Savings</option>
                  <option value="Current">Current</option>
                  <option value="Checking">Checking</option>
                  <option value="Fixed Deposit">Fixed Deposit</option>
                  <option value="NON-Resident">Non-Resident</option>
                  <option value="Online Banking">Online Banking</option>
                  <option value="Joint Account">Joint Account</option>
                  <option value="Domicilliary Account">Domicilliary Account</option>                                
                </select>
                <p id="errorMsg" style="color: var(--red-color)";></p>
                <div class="check-cont"><input type="checkbox" id="check"><p>By clicking the button below, I agree with your <a href="./terms-conditions">terms and conditions.</a></p></div>
                <button type="submit" id="submitButton" class="submit-button white" disabled onclick="validateForm()" name="create">Apply now</button>
                <p style="text-align: center; color: var(--black-color);">Already have an account?</p>
                <button type="button" onclick="redirectToLogin()" class="submit-blue2 align-center white">Proceed to Banking <i class="fa-solid fa-arrow-right-long"></i></button>
            </form>
        </div>
        <div class="details">
            <h1 class="align-center white">Welcome to Internet Banking on <?php echo SITE_NAME ?></h1>
        </div>
    </div>
</div>
<script>
    function redirectToLogin() {
        console.log("Button clicked");
        window.location.href = './login';
    }
    function validateForm(){
        var checkbox = document.getElementById('check');
        var errorMsg = document.getElementById('errorMsg');
        if(!checkbox.checked){
            errorMsg.innerText = "Please agree to our terms and conditions.";
        }else{
            errorMsg.innerText = "";
            document.getElementById('regForm').submit();
        }
    }
</script>
<?php include "includes/footer2.php"; ?>