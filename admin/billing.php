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
        if(empty($_POST['acct_name'])){
            $msg[] = '<div class="error">Please select an account</div>';
        }else{
            $id = mysqli_real_escape_string($con, trim($_POST['acct_name']));
        }
        if(empty($_POST['billing'])){
            $msg[] = '<div class="error">Please select a billing method</div>';
        }else{
            $billing_code = mysqli_real_escape_string($con, trim($_POST['billing']));
        }
        
        if(isset($_POST['submit']) && empty($msg)){
            $q = "UPDATE account SET billing_code = ? WHERE acct_id = ? LIMIT 1";
            $stmt = mysqli_prepare ($con, $q);
            mysqli_stmt_bind_param($stmt, 'si', $billing_code, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_affected_rows($stmt)){
                $successmsg = '<div class="success">New billing code set for account</div>';
            }else{
                $msg[] = '<div class="error">No change to billing code</div>';
            }
        }
    }
?>

<div class="admin-section">
    <div class="balance" style="background: var(--dark-black);">
        <div class="left">
            <p><span class="bold-amount">Change Billing Code</span></p>
            <p> </p>
        </div>
        <div class="right">
            <p></p>
        </div> 
    </div>
    <p>There are three (3) different billing systems to choose from.
        <br/>These are authentication methods the system uses to verify ownership of accounts before processing a transfer request.
    </p>
    <p>PIN: (Default) <br/>Users are required to enter the 6 digit transfer PINs they entered during account activation</p>
    <p>COT: <br/>Users are prompted to enter unique 4 digit COT tokens peculiar to their account</p>
    <p>OTP:  <br/>Users are sent 6 digit OTP (One Time Tokens) to their registered email addresses to proceed</p>
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
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Account To Debit</p>
                    <span class="input-container"><select name="acct_name" id="email" required>
                        <option value="">Select Account</option>
                        <?php while($row = mysqli_fetch_array($rActive)){?>
                            <option value="<?php echo $row['acct_id']; ?>"><?php echo $row['acct_no'].' - '.$row['lname'].' '.$row['fname']; ?></option>
                        <?php } ?>
                    </select></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Default billing system is PIN</p>
                    <span class="input-container"><select name="billing" id="email" required>
                        <option value="">Choose Billing Code</option>
                        <option value="OTP">OTP REQUEST</option>
                        <option value="PIN">PIN REQUEST</option>
                        <option value="COT">COT REQUEST</option>
                    </select></span>
                    <button type="submit" name="submit" class="submit-button white">Set Billing Code</button>
                </form>
            </div>
        </div>
    </div>

</div>


<?php include "includes/foot.php"; ?>
