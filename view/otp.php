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
    $title = 'OTP | '.SITE_NAME; 

    $q2 = "SELECT * FROM account WHERE acct_id = ? LIMIT 1";
    $stmt2 = mysqli_prepare ($con, $q2);
    mysqli_stmt_bind_param($stmt2, 'i', $id);
    mysqli_stmt_execute($stmt2);
    $r = mysqli_stmt_get_result($stmt2);
    $row = mysqli_fetch_assoc($r);
    $status = $row['status'];
    $current_bal = $row['a_bal'];
    $storedotp = $row['otp'];
    $billing_code = $row['billing_code'];
    
    if ($status === 'DORMANT'){
        redirect('./login');
    }elseif($status === 'REGISTERED'){
        redirect('./welcome');
    }elseif($status === 'SUSPENDED'){
        redirect('./login');
    }

    if($billing_code === 'COT'){
        redirect('./cot');
    }
    if($billing_code === 'PIN'){
        redirect('./pin');
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $msg = array();
        $successMsg = '';
        if(empty($_POST['otp'])){
            $msg[] = '<div class="error">Please enter OTP</div>';
        }elseif(!is_numeric($_POST['otp'])){
            $msg[] = '<div class="error">OTP must be of number type!</div>';
        }else{
            $enteredotp = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['otp'])));
        }
        if($enteredotp != $storedotp){
            $msg[] = '<div class="error">Incorrect OTP</div>';
        }
        if(empty($msg)){
      
            $successMsg = '<div class="success">OTP Accepted</div> <p>Redirecting...</p>';
            header("refresh:3; url=./pin");
            // }else{
            //     $msg[] = '<div class="error">Transaction failed</div>';
            // }
        }
    }

    include "includes/header-account.php";
?>
<div class="top-section">
    <div class="card-container" style="position: relative;">
        <div class="card-details">
            <div class="withdraw">
                <!-- <div class="left"><i class="fa fa-arrows-up-to-line"></i></div> -->
                <div class="left"><p class="bold-history center">OTP Transaction Authorization</div>
            </div>
            <div class="withdraw">
            <div class="left"><p>By requiring the OTP code sent to your registered email address, we verify that you are the legitimate owner of the account, reducing the risk of unauthorized access or fraudulent activities.</div>
            </div>
        </div>
    </div>
    <div class="reg-container">

        <div class="pin">
            <div class="content">
                <?php 
                    if (!empty($msg)) {   
                        echo implode('<br/>', $msg);
                    }
                    if(isset($successMsg)){
                        echo $successMsg;
                    }
                ?>
                <h4 class="align-center">EMAIL OTP REQUEST</h4>
                <p class="align-center">A confirmation OTP has been sent to your Email</p>
                <!-- <h3 class="align-center">Enter 6 digit OTP</h3> -->
                <form action="./otp" method="POST">
                    <span class="input-container"><input type="text" name="otp" id="password" maxlength="6" placeholder="Enter 6 digit OTP"><i class="details-black fa fa-fingerprint"></i></span>
                    <button type="submit" class="submit-button white">Confirm OTP</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer-account.php"; ?>