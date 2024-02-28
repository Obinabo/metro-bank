<?php
    session_start();
    include_once "../config/dbconfig.php";
    include_once "../config/func.inc.php";
    if(isset($_SESSION['acct_id'])){
        $id = $_SESSION['acct_id'];
    }else{
        redirect('./login');
    }
    $title = 'Ticket | '.SITE_NAME; 
    $q = "SELECT * FROM account WHERE acct_id = ? LIMIT 1";
    $stmt = mysqli_prepare ($con, $q);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $r = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($r);
    $status = $row['status'];
    $uname = $row['uname'];

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
        if(empty($_POST['subject']) || empty($_POST['body'])){
            $msg[] = '<div class="error">Please enter required fields</div>';
        }else{
            $subject = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['subject'])));
            $body = mysqli_real_escape_string($con, trim(htmlspecialchars($_POST['body'])));
        }
        if(empty($msg)){
            $date = date("d/m/Y h:i:s");
            if(createTicket($con, $id, $uname, $subject, $body, $date) === TRUE){
                $successmsg = '<div class="success">Ticket created successfully</div>';
                $successbtn = '<button type="button" onclick="window.location.href = \'./dashboard\';" class="submit-blue2 align-center white" style="background: var(--opacity-black);">Return Home</button>';
            }else{
                $msg[] = '<div class="error">Ticket Creation Failed!</div>';
            }
        }
    }
?>
<div class="top-section">
    <div class="balance">
            <div class="left">
                <p>Account Number</p>
                <p><?php echo $row['acct_no']; ?> </p>
            </div>
            <div class="right">
                <p><span class="bold-amount">Support</span></p>
            </div> 
    </div>
    <p>Your account officer typically responds within 3 hours </p>
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
                <form action="./create-ticket" method="POST">
                    <span class="input-container"><input type="text" name="c-care" value="Customer Care" disabled></span>
                    <span class="input-container"><input type="text" name="subject" placeholder="Subject"></span>
                    <span class="input-container"><textarea name="body" placeholder="Enter Message..."></textarea>
                    
                    <button type="submit" class="submit-button white">Create Ticket</button>
                    <?php if(isset($successbtn)){echo $successbtn;} ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer-account.php"; ?>