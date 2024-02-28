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
    
?>
<div class="top-section">
    <div class="balance">
            <div class="left">
                <!-- <p>Account Number</p>
                <p><//?php echo $row['acct_no']; ?> </p> -->
            </div>
            <div class="right">
                <p><span class="bold-amount">Settings</span></p>
            </div> 
    </div>
    <!-- <p>Withdraw with the options below</p> -->
    <div class="card-container">
        <div class="card-details">
            <div class="withdraw">
                <div class="left"><i class="fa fa-gear"></i></div>
                <div class="right"><p class="bold-history"><a href="./edit-pass">Change Password</a></p></div>
            </div>
            <div class="withdraw">
                <div class="left"><i class="fa fa-power-off"></i></div>
                <div class="right"><p class="bold-history"><a href="./logout">Logout</a></p></div>
            </div>
        </div>
    </div>
 
<?php include "includes/footer-account.php"; ?>