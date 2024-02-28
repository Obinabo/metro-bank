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

    include "includes/header-account.php";
    
    if ($status === 'DORMANT') {
        redirect('./login');
    }elseif($status === 'REGISTERED'){
        redirect('./welcome');
    }elseif($status === 'SUSPENDED'){
        redirect('./login');
    }
     
    $q2 = "SELECT * FROM cards WHERE acct_no = ? LIMIT 1";
    $stmt2 = mysqli_prepare ($con, $q2);
    mysqli_stmt_bind_param($stmt2, 'i', $id);
    mysqli_stmt_execute($stmt2);
    $r2 = mysqli_stmt_get_result($stmt2);
    
?>
<div class="top-section">
    <div class="balance">
            <div class="left">
                <p>Account Number</p>
                <p><?php echo $row['acct_no']; ?> </p>
            </div>
            <div class="right">
                <p><span class="bold-amount">Virtual Card</span></p>
            </div> 
    </div>
    
    <div class="card-container">
        <div class="card">
            <div class="content">
                <div class="left" style="align-self: flex-start;">
                    <img src="assets/img/metro.png" alt="card-logo" class="logo">
                </div>
                <div></div>
            </div>
            <div class="content">
                <div class="left" style="align-self: center;">
                    <p class="bold-history" style="color: var(--white-color)">5399 **** **** ****</p>
                </div>
                <div></div>
            </div>
            <div class="content white">
                <div class="left" style="align-self: flex-end;">
                    <p class="white"><?php echo $row['lname'].' '.$row['fname']; ?></p>
                </div>
                <div class="right" style="align-self: flex-end;">
                    <img src="assets/img/mastercard-icon.png" alt="card-icon" class="card-icon">
                </div>
            </div>
        </div>
        <div class="card-details">
        <?php 
        if(mysqli_num_rows($r2) > 0){
            while($row2 = mysqli_fetch_assoc($r2)){
        echo'   <div class="content">
                    <p>Name on card</p>
                    <p class="bold-history">'.$row['lname'].' '.$row['fname'].'</p>
                </div>
                <div class="content">
                    <p>Card number</p>
                    <p class="bold-history">'.$row2['card_no'].'</p>
                </div>
                <div class="content">
                    <p>Expiry</p>
                    <p class="bold-history">'.$row2['card_expiry'].'</p>
                </div><div class="content">
                    <p>CVV</p>
                    <p class="bold-history">'.$row2['card_cvv'].'</p>
                </div>'
            ;}
        }else{
            echo '
            <div class="history">
                <div class="left">
                    <h5>No Available Cards..</h5>
                </div>
            <div>
            ';
        }
        ?>
        </div>
    </div>
 </div>
<?php include "includes/footer-account.php"; ?>