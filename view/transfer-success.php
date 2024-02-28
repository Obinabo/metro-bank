<?php
    session_start();
    include_once "../config/dbconfig.php";
    include_once "../config/func.inc.php";
    if(isset($_SESSION['acct_id'])){
        $id = $_SESSION['acct_id'];
        if(!isset($_SESSION['tr_id'])){
            redirect('./dashboard');
        } 
    }else{
        redirect('./login');
    }
    $title = 'Successful | '.SITE_NAME; 

    $q = "SELECT * FROM account WHERE acct_id = ? LIMIT 1";
    $stmt = mysqli_prepare ($con, $q);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $r = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($r);
    $status = $row['status'];
    $current_bal = $row['a_bal'];

    if ($status === 'DORMANT'){
        redirect('./login');
    }elseif($status === 'REGISTERED'){
        redirect('./welcome');
    }elseif($status === 'SUSPENDED'){
        redirect('./login');
    }

  include "includes/header-account.php";
?>
<div class="dark-overlay"></div>
<section>
    <div class="reg-success"  data-aos="fade-up">
        <!-- <div class="close2"><i class="fa fa-xmark black"></i></div> -->
        <img src="assets/img/check.png" alt="card-logo" height="60px" width="60px" alt="logo">
        <h5 class="green">Payment Successful</h5><br/>
        <h3><?php echo $row['currency'].$_SESSION['amount']; ?></h3><br/>
        <p>Transaction Reference</p>
        <p class="bold-history"><?php echo $_SESSION['tr_id'];?> </p><br/>
        <p>Beneficiary</p>
        <p class="bold-history"><?php echo $_SESSION['acct_name'];?></p><br/>
        <p>Beneficiary</p>
        <p class="bold-history"><?php echo $_SESSION['acct_name'];?></p><br/>
        <p>Receiving Bank</p>
        <p class="bold-history"><?php echo $_SESSION['bank'];?></p><br/>
        <!-- <img src="assets/img/undraw_completed_m9ci.svg" height="200px" width="200px" alt="logo"> -->
        <br><br>
        <a class="red-button align-center white" href="./dashboard">Done</a>
    </div>
</section>
<?php include "includes/footer-account.php"; ?>