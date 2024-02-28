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
        if(empty($_POST['status'])){
            $msg[] = '<div class="error">Please select a status for the account</div>';
        }else{
            $status = mysqli_real_escape_string($con, trim($_POST['status']));
        }
        
        if(isset($_POST['submit']) && empty($msg)){
            $q = "UPDATE account SET status = ? WHERE acct_id = ? LIMIT 1";
            $stmt = mysqli_prepare ($con, $q);
            mysqli_stmt_bind_param($stmt, 'si', $status, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_affected_rows($stmt)){
                $successmsg = '<div class="success">New status set for account</div>';
            }else{
                $msg[] = '<div class="error">No change made to account</div>';
            }
        }
    }
?>

<div class="admin-section">
    <div class="balance" style="background: var(--dark-black);">
        <div class="left">
            <p><span class="bold-amount">Change Account Status</span></p>
            <p> </p>
        </div>
        <div class="right">
            <p></p>
        </div> 
    </div>
    <p><span style="color: red; font-weight: bold;">NOTE: </span>Changing status here can only be done to already ACTIVE Or once ACTIVE accounts<br/>
        If you plan to update a newly registered account, <a href="./update">click here</a>
    </p>
    <p>SUSPENDED: This status places an active account under suspension. Owners of these accounts can not log into the system</p>
    <p>CLOSED: This status closes an active account. The account is not deleted but cannot be accessed</p>
    <p>DORMANT: This resets an account. The admin will have to update it from <a href="./update">here</a> for it to be accessible again</p>
    <p> ACTIVE: This status activates an inactive account. This should be applied on accounts that was once ACTIVE but then set to another status</p>
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
                        <?php while($row = mysqli_fetch_array($rAccount)){?>
                            <option value="<?php echo $row['acct_id']; ?>"><?php echo $row['acct_no'].' - '.$row['lname'].' '.$row['fname']; ?></option>
                        <?php } ?>
                    </select></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Default billing system is PIN</p>
                    <span class="input-container"><select name="status" id="email" required>
                        <option value="">Choose Account Status</option>
                        <option value="DORMANT">DORMANT</option>
                        <option value="SUSPENDED">SUSPENDED</option>
                        <option value="CLOSED">CLOSED</option>
                        <option value="ACTIVE">ACTIVE</option>
                    </select></span>
                    <button type="submit" name="submit" class="submit-button white">Set Status</button>
                </form>
            </div>
        </div>
    </div>

</div>


<?php include "includes/foot.php"; ?>
