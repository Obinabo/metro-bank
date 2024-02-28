<?php
    session_start();
    include_once "../config/dbconfig.php";
    include_once "../config/func.inc.php";
    if(isset($_SESSION['acct_id'])){
        $id = $_SESSION['acct_id'];
    }else{
        redirect('./login');
    }
    $title = 'Dashboard | '.SITE_NAME; 
    $q = "SELECT * FROM account WHERE acct_id = ? LIMIT 1";
    $stmt = mysqli_prepare ($con, $q);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $r = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($r);
    $status = $row['status'];

    $q2 = "SELECT * FROM transfer WHERE acct_id = ? ORDER BY date DESC LIMIT 2";
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
            <a href="./deposit"><i class="fa-solid fa-circle-plus"></i>Add Money</a>
        </div>
        <div class="right">
            <p><?php echo $row['currency']; ?> <span class="bold-amount"><?php echo number_format($row['a_bal']); ?></sapn></p>
            <a href="./transfer"><i class="fa-solid fa-circle-arrow-right"></i>Send Money</a>
        </div>
    </div>
    <div class="acct-details">
        <div class="item">
            <h4>Bank</h4>
            <p><?php echo SITE_NAME_SHORT;?></p>
        </div>
        <div class="item">
            <h4>Acct.Name</h4>
            <p><?php echo $row['fname'].' '.$row['lname'];?></p>
        </div>
        <div class="item">
            <h4>Acct.Number</h4>
            <p><?php echo $row['acct_no'];?></p>
        </div>
    </div>
    <p class="align-left">Services</p>
    <div class="acct-services">
        <a href="./loans" class="items">
            <i class="fa-solid fa-wallet"></i>
            <p class="align-left">Loans</p>
        </a>
        <a href="./transfer" class="items">
            <i class="fa-solid fa-money-bills"></i>
            <p>Wire</p>
        </a>
        <a href="./save-more" class="items">
            <i class="fa-solid fa-vault"></i>
            <p>Savings</p>
        </a>
        <a href="./withdraw" class="items">
            <i class="fa-solid fa-arrows-down-to-line"></i>
            <p>Withdraw</p>
        </a>
        <a href="./create-ticket" class="items">
            <i class="fa-solid fa-envelopes-bulk"></i>
            <p>support</p>
        </a>
        <a href="./history" class="items">
            <i class="fa-solid fa-square-caret-down"></i>
            <p>History</p>
        </a>
    </div>
    <p class="align-left">Recent Transactions</p>
    <?php
        if(mysqli_num_rows($result) >= 1){
            while($history = mysqli_fetch_array($result)){
                echo '<div class="history">
                    <div class="left">
                        <p> '.$history['date'].' </p>
                        <p class="bold-history">'.$history['acct_name'].' </p>
                    </div>
                    <div class="right">
                        <p>'.$history['type'].'</p>
                        <p class="bold-history">'.$history['amount'].'</p>
                    </div>
                </div>
                ';
            }
            echo ' <a class="align-right" href="./history">See more</a>';
        }else{
            echo '
            <div class="history">
                <div class="left">
                    <h4>No Available Transactions..</h4>
                </div>
            <div>
            ';
        }
    ?>
</div>
<section>
    
</section>

<?php include "includes/footer-account.php"; ?>