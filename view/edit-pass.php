<?php
    session_start();
    include_once "../config/dbconfig.php";
    include_once "../config/func.inc.php";
    if(isset($_SESSION['acct_id'])){
        $id = $_SESSION['acct_id'];
    }else{
        redirect('./login');
    }
    $title = 'Settings | '.SITE_NAME; 
    $q = "SELECT * FROM account WHERE acct_id = ? LIMIT 1";
    $stmt = mysqli_prepare ($con, $q);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $r = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($r);
    $status = $row['status'];
    $storedpass = $row['pass'];

    include "includes/header-account.php";
    
    if ($status === 'DORMANT') {
        redirect('./login');
    }elseif($status === 'REGISTERED'){
        redirect('./welcome');
    }elseif($status === 'SUSPENDED'){
        redirect('./login');
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $successmsg = '';
        $successbtn = '';
        $msg = array();
        if(empty($_POST['oldpass'])){
            $msg[] = '<div class="error">Please enter Current password</div>';
        }else{
            $oldpass = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['oldpass'])));
        }
        if(empty($_POST['pass']) || empty($_POST['pass2'])){
            $msg[] = '<div class="error">Please enter new password</div>';
        }elseif($_POST['pass'] != $_POST['pass2']){
            $msg[] = '<div class="error">Entered passwords do not match!</div>';
        }else{
            $newpass = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['pass'])));
        }
        if(!password_verify($oldpass, $storedpass)){
            $msg[] = '<div class="error">Wrong current password! <br/> Please enter current password to proceed</div>';   
        }
        if(empty($msg)){
            $hashedPass = password_hash($newpass, PASSWORD_DEFAULT);
            $q2 = "UPDATE account SET pass = ? WHERE acct_id = ? LIMIT 1";
            $stmt2 = mysqli_prepare ($con, $q2);
            mysqli_stmt_bind_param($stmt2, 'si', $hashedPass, $id);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_store_result($stmt2);
            if(mysqli_stmt_affected_rows($stmt2)){
                $successmsg = '<div class="success">Password changed successfully</div>';
                $successbtn = '<button type="button" onclick="window.location.href = \'./dashboard\';" class="submit-blue2 align-center white" style="background: var(--opacity-black);">Return Home</button>';
            }else{
                $msg[] = '<div class="error">New password cannot be same as the current one</div>';
            }
        }
    }
?>
<div class="top-section">
    <div class="balance">
            <div class="left">
                <!-- <p>Account Number</p>
                <p><//?php echo $row['acct_no']; ?> </p> -->
            </div>
            <div class="right">
                <p><span class="bold-amount">Change Password</span></p>
            </div> 
    </div>
    <!-- <p>Withdraw with the options below</p> -->
    <!-- <div class="card-container" style="position: relative;">
        <div class="card-details">
            <div class="withdraw">
                <div class="left"><i class="fa fa-gear"></i></div>
                <div class="right"><p class="bold-history"><a id="passchange" href="./edit-pass">Change Password</a></p></div>
            </div>
            <div class="withdraw">
                <div class="left"><i class="fa fa-power-off"></i></div>
                <div class="right"><p class="bold-history"><a href="./logout">Logout</a></p></div>
            </div>
        </div>
    </div> -->
    <div class="reg-container" id="container"s>
        <div class="pin">
            <div class="content">
                <?php 
                    if (!empty($msg)) {   
                        echo implode('<br/>', $msg);
                    }
                    if(isset($successmsg)){echo $successmsg;}
                ?>
                <h3 class="align-center"></h3>
                    <form action="./edit-pass" method="POST">
                    <span class="input-container"><input type="text" name="oldpass" id="password" placeholder="Current password"><i class="details-black fa fa-fingerprint"></i></span>
                    <span class="input-container"><input type="text" name="pass" id="password" placeholder="Enter new password"><i class="details-black fa fa-fingerprint"></i></span>
                    <span class="input-container"><input type="text" name="pass2" id="password" placeholder="Confirm new password"><i class="details-black fa fa-fingerprint"></i></span>
                    <button type="submit" class="submit-button white">Change Password</button>
                    <?php if(isset($successbtn)){echo $successbtn;} ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer-account.php"; ?>