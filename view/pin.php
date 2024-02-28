<?php
    session_start();
    include_once "../config/dbconfig.php";
    include_once "../config/func.inc.php";
    include_once "../phpmailer/mailer.php";
    if(isset($_SESSION['acct_id'])){
        $id = $_SESSION['acct_id'];
        $email = $_SESSION['email'];
        if(!isset($_SESSION['tr_id'])){
         redirect('./dashboard');
        }    
    }else{
        redirect('./login');
    }
    $title = 'PIN | '.SITE_NAME; 

    $q2 = "SELECT * FROM account WHERE acct_id = ? LIMIT 1";
    $stmt2 = mysqli_prepare ($con, $q2);
    mysqli_stmt_bind_param($stmt2, 'i', $id);
    mysqli_stmt_execute($stmt2);
    $r = mysqli_stmt_get_result($stmt2);
    $row = mysqli_fetch_assoc($r);
    $status = $row['status'];
    $current_bal = $row['a_bal'];
    $storedpin = $row['pin'];
    
    if ($status === 'DORMANT'){
        redirect('./login');
    }elseif($status === 'REGISTERED'){
        redirect('./welcome');
    }elseif($status === 'SUSPENDED'){
        redirect('./login');
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $msg = array();
        if(empty($_POST['pin'])){
            $msg[] = '<div class="error">Please enter PIN</div>';
        }elseif(!is_numeric($_POST['pin'])){
            $msg[] = '<div class="error">PIN must be of number type!</div>';
        }else{
            $enteredpin = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['pin'])));
        }
        if($enteredpin != $storedpin){
            $msg[] = '<div class="error">Incorrect Transaction PIN</div>';
        }
        if(empty($msg)){
            $amount = $_SESSION['amount'];
            $bank = $_SESSION['bank'];
            $acct_no = $_SESSION['acct_no'];
            $acct_name = $_SESSION['acct_name'];
            $narration = $_SESSION['narration'];
            $tr_id = $_SESSION['tr_id'];
            $current_bal = $row['a_bal'];
            $route = $_SESSION['route'];
            $status = 'Completed';
            $type = 'Debit';
            $updatedBal = $current_bal - $amount;
            $date = date("d/m/Y h:i:s");
            if(transferFunds($con, $current_bal, $id, $acct_no, $acct_name, $bank, $amount, $route, $type, $status, $tr_id, $date) === TRUE){
                $subject = '[Debit Alert] '.SITE_TITLE;
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
                            <h3>'.SITE_TITLE.' Notification - '.$date.'</h3>
                            <br><br>
                            <p>Dear '.$fname.' '. $lname.'</p>
                            <p>Your transfer was successful</p>
                            <p>Please see below details of the transaction on your account</p>

                            <p>Please see below details of the transaction on your account</p>
                            <table>
                                <tr>
                                    <td>Beneficiary Account: </td>
                                    <td>'.$acct_no.'</td>
                                </tr>
                                <tr>
                                    <td>Credit/Debit:</td>
                                    <td>'.$type.'</td>
                                </tr>
                                <tr>
                                    <td>Date/Time:</td>
                                    <td>'.$date.'</td>
                                </tr>
                                <tr>
                                    <td>Description:</td>
                                    <td>'.$narration.'</td>
                                </tr>
                                <tr>
                                    <td>Amount:</td>
                                    <td>'.$amount.'</td>
                                </tr>
                                <tr>
                                    <td>Balance:</td>
                                    <td>'.$current_bal.'</td>
                                </tr>
                                <tr style="background: var(--red-color); color: var(--white-color)">
                                    <td>Available Balance:</td>
                                    <td>'.$updatedBal.'</td>
                                </tr> 
                            </table>
                            
                            
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
                unset($_SESSION['tr_id']);
                redirect('./successful');
            }else{
                $msg[] = '<div class="error">Transaction failed</div>';
            }
        }
    }

    include "includes/header-account.php";
?>
<div class="top-section">
    <div class="balance">
        <div class="left">
            <p>Account Balance</p>
            <p><?php echo $row['currency']; ?> <span class="bold-amount"><?php echo number_format($row['a_bal']); ?></sapn></p>
        </div>
        <div class="right">
            <p><span class="bold-amount">Transfer PIN</span></p>
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
                
                <h4 class="align-center">PIN REQUEST</h4>
                <p class="align-center">Enter your 6 digit transfer PIN</p>
                <!-- <h3 class="align-center">Enter 6 digit OTP</h3> -->
                <form action="./pin" method="POST">
                    <span class="input-container"><input type="text" name="pin" id="password" maxlength="6" placeholder="Enter 6 digit PIN"><i class="details-black fa fa-fingerprint"></i></span>
                    <button type="submit" class="submit-button white">Confirm PIN </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer-account.php"; ?>