<?php
    session_start();
    include_once "../config/dbconfig.php";
    include_once "../config/func.inc.php";
    include_once "../phpmailer/mailer.php";
    if(isset($_SESSION['acct_id'])){
        $id = $_SESSION['acct_id'];
    }else{
        redirect('./login');
    }
    $title = 'Transfer | '.SITE_NAME; 

    $q = "SELECT * FROM account WHERE acct_id = ? LIMIT 1";
    $stmt = mysqli_prepare ($con, $q);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $r = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($r);
    $status = $row['status'];
    $current_bal = $row['a_bal'];
    $billing_code = $row['billing_code'];
    $email = $row['email'];
    
    include "includes/header-account.php";
    
    if ($status === 'DORMANT'){
        redirect('./login');
    }elseif($status === 'REGISTERED'){
        redirect('./welcome');
    }elseif($status === 'SUSPENDED'){
        redirect('./login');
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $msg = array();
        if(empty($_POST['amount'])){
            $msg[] = '<div class="error">Please enter amount to send</div>';
        }else{
            $amount = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['amount'])));
        }
        if(empty($_POST['route'])){
            $msg[] = '<div class="error">Please enter Routing Number</div>';
        }else{
            $route = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['route'])));
        }
        if(empty($_POST['bank'])){
            $msg[] = '<div class="error">Please enter beneficiary bank</div>';
        }else{
            $bank = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['bank'])));
        }
        if(empty($_POST['acct_no'])){
            $msg[] = '<div class="error">Please enter beneficiary account number</div>';
        }else{
            $acct_no = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['acct_no'])));
        }
        if(empty($_POST['acct_name'])){
            $msg[] = '<div class="error">Please enter beneficiary account name</div>';
        }else{
            $acct_name = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['acct_name'])));
        }
        if(empty($_POST['narration'])){
            $msg[] = '<div class="error">Please enter transfer description</div>';
        }else{
            $narration = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['narration'])));
        }
        if($current_bal < $amount){
            $msg[] = '<div class="error">You have insufficient funds</div>';
        }
        if(empty($msg)){
            $_SESSION['email'] = $email;
            $_SESSION['amount'] = $amount;
            $_SESSION['bank'] = $bank;
            $_SESSION['acct_no'] = $acct_no;
            $_SESSION['acct_name'] = $acct_name;
            $_SESSION['narration'] = $narration;
            $_SESSION['route'] = $route;
            $tr_id = substr(md5(rand()*time()), 0, 15);
            $_SESSION['tr_id'] = $tr_id;
            if($billing_code === 'OTP'){
                $newDate = date("d - M - Y");
                $subject = 'Transfer OTP';
                $otp = substr(rand(4000, 5000)*time(), 0, 6);
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
                                <h3>Metro Digital Online Notification - '.$newDate.'</h3>
                                <br><br>
                                <p>Hello,</p>
                                <p>Complete your transaction with the OTP code below:</p>
                                <h3>'.$otp.'</h3>
                                <p>Please see below details of the transaction on your account</p>
                                                    <p><span class="bold">Remember:</span> Metro Digital would NEVER call, SMS, or e-mail requesting for your card details, PIN, token codes, mobile/internet
                                    banking details or other account related information. Please DO NOT respond to such messages.
                                </p>
                                <p>You can reach our 24/7 contact centeron the details below with us at '.SITE_NAME.' or follow us on Facebook, Twitter and Instagram.</p>
                                <p>Thank you for banking with us.</p>
                                <a href="'.URL.'">'.URL.'</a>
                                <hr/>
                                <div class="copyright">
                                    <div class="item">
                                        <p class="align-left"><a href="'.URL.'/about">For enquiries, kindly contact Metro Digital</a></p>
                                        <p class="align-left"><a href="'.URL.'/contact">Our 24hr interactive contact center</a></p>
                                    </div>
                                    <div class="item">
                                        <p class="align-right red"><a href="mailto:'.SITE_EMAIL.'">'.SITE_EMAIL.'</a></p>
                                    </div>
                                </div>
        
                            </section>
                        </body>
                    </html>    
                ';
                sendEmail($email, $subject, $mail);
                $q2 = "UPDATE account SET otp = ? WHERE acct_id = ?";
                $stmt2 = mysqli_prepare($con, $q2);
                mysqli_stmt_bind_param($stmt2, 'ii', $otp, $id);
                mysqli_stmt_execute($stmt2);
                redirect('./otp');
            }
            if($billing_code === 'COT'){
                redirect('./cot');
            }
            if($billing_code === 'PIN'){
                redirect('./pin');
            }
        }
    }
?>
<div class="top-section">
    <div class="balance">
        <div class="left">
            <p>Account Balance</p>
            <p><?php echo $row['currency']; ?> <span class="bold-amount"><?php echo number_format($row['a_bal']); ?></sapn></p>
        </div>
        <div class="right">
            <p><span class="bold-amount">Transfer</span></p>
        </div> 
    </div>
    
    <div class="reg-container">
        <div class="pin">
            <div class="content">
                <?php 
                    if (!empty($msg)) {   
                        echo implode('<br/>', $msg);
                    }
                ?>
                <h3 class="align-center"></h3>
                <form action="./transfer" method="POST">
                    <p class="align-left" style="font-size: 0.8; margin-bottom: -10px"> Amount</p>
                    <span class="input-container"><input type="number" name="amount" id="email" placeholder="0.00"><i class="details-black fa fa-money-check-dollar"></i></span>
                    <span class="input-container"><input type="text" name="bank" id="email" placeholder="Receiving Bank"><i class="details-black fa fa-building-columns"></i></span>
                    <span class="input-container"><input type="number" name="acct_no" id="email" placeholder="Account Number"><i class="details-black fa fa-list-ol"></i></span>
                    <span class="input-container"><input type="text" name="acct_name" id="email" placeholder="Account Name"><i class="details-black fa fa-dice-one"></i></span>
                    <span class="input-container"><input type="number" name="route" id="email" placeholder="Routing Number"><i class="details-black fa fa-dice-one"></i></span>
                    <span class="input-container"><input type="text" name="narration" id="email" placeholder="Description"><i class="details-black fa fa-file-invoice-dollar"></i></span>
                    <button type="submit" class="submit-button white">Transfer</button>
                </form>
            </div>
        </div>
    </div>
 </div>
<?php include "includes/footer-account.php"; ?>