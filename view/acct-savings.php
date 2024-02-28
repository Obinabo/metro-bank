<?php
    session_start();
    include_once "../config/dbconfig.php";
    include_once "../config/func.inc.php";
    if(isset($_SESSION['acct_id'])){
        $id = $_SESSION['acct_id'];
    }else{
        redirect('./login');
    }
    $title = 'Savings | '.SITE_NAME; 
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
                <p>Account Balance</p>
                <p><span class="bold-amount"><?php echo $row['a_bal']; ?></span></p>
            </div>
            <div class="right">
                <p><span class="bold-amount">Savings</span></p>
            </div> 
    </div>
        <p>
            Save daily, weekly, or monthly towards your goal and earn returns that you can withdraw at any time
        </p>
    <div class="card-container">
        <div class="card" style="background: url('assets/img/vault.jpg') no-repeat; background-size: cover; flex: 2; height: 300px">
         
        </div>
        
        <div class="card-details" style="align-self: stretch;">
        <div class="withdraw">
                <div class="left"><p class="bold-history">Coming soon</p></div>
            </div>
            <div class="withdraw">
                <!-- <div class="left"><i class="fa fa-money-check-dollar"></i></div> -->
                <div class="right"><p>We are trying very hard to complete it as soon as possible, but you can always use our other cool features.</p></div>
            </div>
        </div>
    </div>
 </div>
<?php include "includes/footer-account.php"; ?>