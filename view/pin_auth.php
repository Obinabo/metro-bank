<?php
session_start();
include_once "../config/dbconfig.php";
include_once "../config/func.inc.php";
if(isset($_SESSION['acct_id'])){
    $id = $_SESSION['acct_id'];
}else{
    redirect('./login');
}
$successMsg = '';
$title = 'Forgot Password | '.SITE_NAME;
include 'includes/header.php';
    $q = "SELECT * FROM account WHERE acct_id = ? LIMIT 1";
    $stmt = mysqli_prepare ($con, $q);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $r = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($r)){
        $status = $row['status'];
    }
    if ($status === 'DORMANT') {
        redirect('./login');
    }elseif($status === 'SUSPENDED'){
        redirect('./login');
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $successmsg = '';
        $successbtn = '';
        $msg = array();
        if(empty($_POST['pin']) || empty($_POST['pin2'])){
            $msg[] = '<div class="error">Please enter selected transfer PIN</div>';
        }elseif($_POST['pin'] != $_POST['pin2']){
            $msg[] = '<div class="error">Transfer PINs do not match!</div>';
        }elseif(!is_numeric($_POST['pin'])){
            $msg[] = '<div class="error">Transfer PIN must be of number type!</div>';
        }else{
            $pin = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['pin'])));
        }
        if(empty($msg)){
            $q = "UPDATE account SET pin = ? WHERE acct_id = ? LIMIT 1";
            $stmt = mysqli_prepare ($con, $q);
            mysqli_stmt_bind_param($stmt, 'ii', $pin, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_affected_rows($stmt)){
                mysqli_stmt_free_result($stmt);
                $card_no = "5399 ".sprintf("%04d %04d %04d", rand(0000,9999), rand(0000,9999), rand(0000,9999));
                $cvv = rand(100, 500);
                $cMonth = date('m');
                $currentYear = date("Y");
                $newDate = date("y", strtotime($currentYear. '+3 years'));
                $expiry = $cMonth.'/'.$newDate;
                createCard($con, $id, $card_no, $expiry, $cvv);
                $successmsg = '<div class="success">Transfer PIN created</div>';
                $successbtn = '<button type="button" onclick="window.location.href = \'./profile\';" class="submit-blue2 align-center white" style="background: green;">Continue</button>';
            }else{
                $msg[] = '<div class="error">Pin ALready Exists</div>';
            }
        }
    }
?>

<div class="reg-container">

    <div class="pin">
        <div class="content">
            <?php 
                 if (!empty($msg)) {   
                     echo implode('<br/>', $msg);
                 }
                 if(isset($successmsg)){echo $successmsg;}
            ?>
            <h3 class="align-center">Create 6 digit transfer pin</h3>
            <form action="./pin-auth" method="POST">
                <span class="input-container"><input type="text" name="pin" id="password" maxlength="6" placeholder="Enter 6 Digit Pin"><i class="details-black fa fa-fingerprint"></i></span>
                <span class="input-container"><input type="text" name="pin2" id="password" maxlength="6" placeholder="Confirm 6 Digit Pin"><i class="details-black fa fa-fingerprint"></i></span>
                <button type="submit" class="submit-button white">Create Pin</button>
                <?php if(isset($successbtn)){echo $successbtn;} ?>
            </form>
        </div>
    </div>
</div>
<?php include 'includes/footer2.php';?>