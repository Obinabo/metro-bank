<?php 
session_start();
include_once "../config/dbconfig.php";
include_once "../config/func.inc.php";
include_once "../phpmailer/mailer.php";
include_once "includes/count.inc.php";
    if(!isset($_SESSION['id'])){
        redirect('index.php');
    }

    $title = 'Admin dashboard | '.SITE_NAME;
    include "includes/head.php"; 
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $msg = array();
        $successmsg = '';
        if(empty($_POST['fname'])){
            $msg[] = '<div class="error">Please enter First name</div>';
        }else{
            $fname = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['fname'])));
        }
        if(empty($_POST['lname'])){
            $msg[] = '<div class="error">Please enter Last name</div>';
        }else{
            $lname = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['lname'])));
        }
        if(empty($_POST['uname'])){
            $msg[] = '<div class="error">Please enter Username</div>';
        }else{
            $uname = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['uname'])));
        }
        if(empty($_POST['upass'])){
            $msg[] = '<div class="error">Please enter Password</div>';
        }else{
            $upass = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['upass'])));
        }
        if(empty($_POST['email'])){
            $msg[] = '<div class="error">Please enter Email Address</div>';
        }else{
            $email = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['email'])));
        }
        if(empty($_POST['phone'])){
            $msg[] = '<div class="error">Please enter Phone Number</div>';
        }else{
            $phone = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['phone'])));
        }
        if(empty($_POST['dob'])){
            $msg[] = '<div class="error">Please enter Date of birth</div>';
        }else{
            $dob = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['dob'])));
        }
        if(empty($_POST['work'])){
            $msg[] = '<div class="error">Please enter Date of birth</div>';
        }else{
            $work = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['work'])));
        }
        if(empty($_POST['addr'])){
            $msg[] = '<div class="error">Please enter Address</div>';
        }else{
            $addr = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['addr'])));
        }
        if(empty($_POST['sex'])){
            $msg[] = '<div class="error">Please choose Sex</div>';
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
            $msg[] = '<div class="error">Please enter Occupation</div>';
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
        if(empty($_POST['status'])){
            $msg[] = '<div class="error">Please select Account status</div>';
        }else{
            $status = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['status'])));
        }
        if(empty($_POST['a_bal'])){
            $msg[] = '<div class="error">Please Enter Amount</div>';
        }else{
            $a_bal = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['a_bal'])));
        }
        if(empty($_POST['cot'])){
            $msg[] = '<div class="error">Please Enter COT</div>';
        }else{
            $cot = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['cot'])));
        }
        $hashedPassword = password_hash($upass, PASSWORD_DEFAULT);
        $pic = 'view/uploads/user.png';
        $regDate = date("d/m/Y h:i:s");
        $pin = 000;
        $billing_code = 'PIN';
        $imf = 000;
        $acct_no = "35".substr(rand(500000, 2000000) * date("Hid"), 0, 8);
        if(isset($_POST['submit']) && empty($msg)){
            if(checkUser($con, $email, $uname) !== TRUE){
                if (createAcct($con, $acct_no, $pic, $uname, $fname, $lname, $hashedPassword, $dob, $email, $phone, $addr, $sex, $marry, $work, $country, $state, $currency, $type, $status, $billing_code, $a_bal, $pin, $imf, $cot, $regDate) === TRUE) {
                    $subject = 'Internet Banking Application';
                    $mail = '
                    <!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset="utf-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <meta http-equiv="x-ua-compatible" content="ie=edge">
                            <style>
                                :root{
                                    --white-color: rgb(255, 255, 255);
                                    --blue-color: rgb(37, 72, 175);
                                    --blue-dim-color: rgb(16, 48, 143);
                                    --red-color: rgb(217, 28, 41);
                                    --red-dim-color: rgb(175, 8, 19);
                                    --bg-grey: rgb(245, 241, 241);
                                    --black-color: rgb(38, 38, 38);
                                    --opacity-black: rgb(26, 25, 25);
                                    --dark-grey: #b6b4b4;
                                }
                                table{ 
                                    border-collapse: separate;
                                    width: 75%;
                                    border-radius: 10px;
                                    border: 1px solid var(--black-color);
                                    margin: 15px auto;
                                    padding: 5px 10px;
                                }
                                tr:nth-of-type(odd){
                                background: var(--dark-grey);
                                }
                                tr:nth-of-type(even){
                                    background: var(--bg-grey);
                                }
                                .bg-red{
                                    background: var(--blue-color)
                                }
                                td{
                                    text-align: left;
                                    padding: 5px;
                                    width: 50%;
                                    font-size: 0.8em
                                }
                                body{     
                                    background-color: var(--bg-grey);
                                    color: var(--black-color);
                                    margin: 0 auto;
                                    padding: 0 ;
                                    width: 100%;
                                    position: relative;
                                }
                                section{
                                    margin:20px auto;
                                    padding: 0 60px;
                                    max-width: 1300px;
                                    position: relative;
                                }
                                hr{
                                    border: none;
                                    height: 10px;
                                    /* margin-top: 15px;  */
                                    border-top: 1px solid var(--red-color);
                                    border-bottom: 1px solid var(--red-color);
                                    margin: 10px auto;
                                }
                                h3{
                                    font-size: 1.5em;
                                    color: var(--black-color);
                                    margin: 5px auto;
                                }
                                p{
                                    font-size: 0.9em;
                                    color: var(--black-color);
                                    margin: 5px auto;
                                    line-height: 180%;
                                    text-align: justify;
                                }
                                a{
                                    color: var(--red-color); 
                                    text-decoration: none; 
                                }
                                a:hover{
                                    color: var(--blue-color); 
                                    text-decoration: none;
                                    font-style: italic; 
                                }
                                .align-center{
                                    text-align: center;
                                }
                                .align-left{
                                    text-align: left;
                                }
                                .align-right{
                                    text-align: right;
                                }
                                .banner{
                                    height: auto;
                                    width: 100%;
                                    margin: 0 auto;
                                    margin-bottom: 15px;
                                }
                                .bold{font-weight: bold;}
                                .red{ color: var(--red-color)}
                                .copyright{
                                    display: flex;
                                    width: 100%;
                                    justify-content: center;
                                    flex-flow: row nowrap;
                                }
                                .copyright .item{
                                    flex: 1;
        
                                }
                                @media(max-width: 500px){
                                p{
                                    font-size: 0.8em;
                                }      
                                section{
                                    margin: 20px auto;
                                    padding: 0 20px;
                                    max-width: 100%;
                                    position: relative;
                                }  
                                table{ 
                                width: 90%
                                }       
                                }
                                @media(prefers-color-scheme: dark){
                                    body{     
                                        background-color: var(--black-color);
                                        color: var(--white-color);
                                    }
                                    h3, p{
                                        color: var(--white-color)
                                    }
                                    table{
                                        border: 1px solid var(--red-color);
                                    }
                                    tr:nth-of-type(odd){
                                        background: var(--opacity-black);
                                    }
                                    tr:nth-of-type(even){
                                        background: var(--black-color);
                                    }
                                }
                            </style>
                        </head>
                        <body>
                            <section>
                                <img src="'.URL.'/assets/img/solo-acct-banner1.png" alt="" class="banner"/>
                                <h3>'.SITE_NAME_SHORT.' Notification - '.$regDate.'</h3>
                                <br><br>
                                
                                <h3> Hello '.$fname.'</h3>
                                <p>Congratulations, Your Application have been recieved and is being checked, you will recieve a reply from our Accounts Department shortly </p>
                            <p>Please Note that your once your Internet Banking is activated and you will need a combination of your Email or Account Number and Password to access your online banking .</p>
                            
                                <p><span class="bold">Remember:</span> '.SITE_NAME_SHORT.' would NEVER call, SMS, or e-mail requesting for your card details, PIN, token codes, mobile/internet
                                    banking details or other account related information. Please DO NOT respond to such messages.
                                </p><br><br>
                                <p>You can reach our 24/7 contact center on the details below with us at '.SITE_NAME.' or follow us on Facebook, Twitter and Instagram.</p>
                                <p>Thank you for banking with us.</p>
                                <a href="'.URL.'">'.URL.'</a>
                                <hr/>
                                <div class="copyright">
                                    <div class="item">
                                        <p class="align-left"><a href="'.URL.'/about">For enquiries, kindly contact '.SITE_NAME_SHORT.'</a></p>
                                        <p class="align-left"><a href="'.URL.'/contact">Our 24hr interactive contact center</a></p>
                                    </div>
                                    <div class="item">
                                        <p class="align-right red"><a href="mailto:'.SITE_EMAIL.'">'.SITE_EMAIL.'</a></p>
                                    </div>
                                </div>
        
                            </section>
                        </body>
                    </html>';
                    sendEmail($email, $subject, $mail);
                    $successmsg = '<div class="success"> Account successfully created</div>';        
                }else{
                    $msg[] = '<div class="error">Unable to process this request at this time..
                    <br>Please try again later</div>';
                }
            }else{
                $msg[] = '<div class="error">Email or username already exists</div>';
            }
        }
    }
?>

<div class="admin-section">
    <div class="balance" style="background: var(--dark-black);">
        <div class="left">
            <p><span class="bold-amount">Add Account</span></p>
            <p> </p>
        </div>
        <div class="right">
            <p></p>
        </div> 
    </div>
    <p>Here, you can create a new bank account via the admin dashboard</p>
    <div class="reg-container">
        <div class="pin">
            <div class="content">
                <?php 
                    if (!empty($msg)) {   
                        echo implode('<br/>', $msg);
                    }
                    if(isset($successmsg)){echo $successmsg;}
                ?>
                <h3 class="align-center"></h3>
                <form action="" method="POST">
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> First Name</p>
                    <span class="input-container"><input type="text" name="fname" placeholder="Eg. John"></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Last Name</p>
                    <span class="input-container"><input type="text" name="lname" placeholder="Eg. Doe"></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Username</p>
                    <span class="input-container"><input type="text" name="uname" placeholder="Eg. John005"></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Email</p>
                    <span class="input-container"><input type="email" name="email" placeholder="Eg. johndoe@mail.com"></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Password</p>
                    <span class="input-container"><input type="text" name="upass" placeholder="Eg. John123456"></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Phone Number</p>
                    <input type="phone" name="phone" placeholder="Eg. +1(000)444-5555" required>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px">Dirth of Birth</p>
                    <input data-format="dd/mm/yyyy" name="dob" type="text" placeholder="Eg. dd/mm/yyyy"required />
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px">Occupation</p>
                    <input type="text" name="work" placeholder="Eg. Doctor" required>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px">Address</p>
                    <input type="text" name="addr" placeholder="Eg. Hilton Drive California" required>
                    <select id="countrySelect" name="country"><option value="">Select country</option></select>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px">State</p>
                    <input type="text" name="state" placeholder="Eg. Delaware" required>
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
                    <select name="status" required>
                        <option value="">Account Status</option>
                        <option value="REGISTERED">Active</option>
                    </select>                             
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px">Account Balance</p>
                    <input type="number" name="a_bal" placeholder="Eg. 0.00" required>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px">Account COT</p>
                    <input type="number" name="cot" placeholder="4 Digit eg. 1234" required>
                    <button type="submit" name="submit" class="submit-button white">Create Account</button>
                </form>
            </div>
        </div>
    </div>

</div>


<?php include "includes/foot.php"; ?>
