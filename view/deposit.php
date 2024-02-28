<?php
    session_start();
    include_once "../config/dbconfig.php";
    include_once "../config/func.inc.php";
    if(isset($_SESSION['acct_id'])){
        $id = $_SESSION['acct_id'];
    }else{
        redirect('./login');
    }
    $title = 'Cards | '.SITE_NAME; 
    $q = "SELECT * FROM account WHERE acct_id = ? LIMIT 1";
    $stmt = mysqli_prepare ($con, $q);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $r = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($r);
    $status = $row['status'];

    $q2 = "SELECT * FROM transfer WHERE acct_id = ? ORDER BY date ASC LIMIT 5";
    $stmt2 = mysqli_prepare($con, $q2);
    mysqli_stmt_bind_param($stmt2, 'i', $id);
    mysqli_stmt_execute($stmt2);

    $result = mysqli_stmt_get_result($stmt2);

    include "includes/header-account.php";
    
    if ($status === 'DORMANT') {
        redirect('./login');
    }elseif($status === 'REGISTERED'){
        redirect('./welcome');
    }elseif($status === 'SUSPENDED'){
        redirect('./login');
    }
       
?>
<div class="top-section">
    <div class="balance">
            <div class="left">
                <p>Account Number</p>
                <p><?php echo $row['acct_no']; ?> </p>
            </div>
            <div class="right">
                <p><span class="bold-amount">Deposit</span></p>
            </div> 
    </div>
        <p>
            Kindly use the account information below to make deposit...
        </p>
    <div class="card-container">
        <div class="card" style="background: url('assets/img/vaccination-passport.jpg') no-repeat; background-size: cover; flex: 2; height: 300px">
            <!-- <div class="content">
                <div class="left" style="align-self: flex-start;">
                    <img src="assets/img/metro.png" alt="card-logo" class="logo">
                </div>
                <div></div>
            </div>
            <div class="content">
                <div class="left" style="align-self: center;">
                    <p class="bold-history" style="color: var(--white-color)">5399 **** **** 0000</p>
                </div>
                <div></div>
            </div>
            <div class="content white">
                <div class="left" style="align-self: flex-end;">
                    <p class="white">Surname Name</p>
                </div>
                <div class="right" style="align-self: flex-end;">
                    <img src="assets/img/mastercard-icon.png" alt="card-icon" class="card-icon">
                </div>
            </div> -->
        </div>
        
        <div class="card-details">
            <div class="content">
                <p>Bank Name</p>
                <p class="bold-history"><?php echo SITE_NAME_SHORT; ?></p>
            </div>
            <div class="content">
                <p>account Number</p>
                <p class="bold-history"><?php echo $row['acct_no']; ?></p>
            </div>
            <div class="content">
                <p>Swift Code</p>
                <p class="bold-history"><?php echo SWIFT_CODE; ?></p>
            </div><div class="content">
                <p>IBAN</p>
                <p class="bold-history"><?php echo ROUTE; ?></p>
            </div>
        </div>
    </div>
 </div>
<?php include "includes/footer-account.php"; ?>