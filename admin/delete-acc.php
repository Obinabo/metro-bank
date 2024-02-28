<?php 
session_start();
include_once "../config/dbconfig.php";
include_once "../config/func.inc.php";
include_once "../phpmailer/mailer.php";
include_once "includes/count.inc.php";
    if(!isset($_SESSION['id'])){
        redirect('index.php');
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else if (isset($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        echo '<div class="error">You have accessed this page in error!</div>';
        redirect("index.php");
    }

    $title = 'Admin dashboard | '.SITE_NAME;
    include "includes/head.php"; 

    $q = "SELECT * FROM account WHERE acct_id = ?";
    $stmt = mysqli_prepare($con, $q);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $r = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($r) > 0){
        $row = mysqli_fetch_assoc($r);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $successmsg = '';
        if(isset($_POST['submit']) && $_POST['submit'] == 'delete'){
            $q2 = "DELETE FROM account WHERE acct_id = ?";
                $stmt2 = mysqli_prepare($con, $q2);
                mysqli_stmt_bind_param($stmt2, 'i', $id);
                mysqli_stmt_execute($stmt2);
            if(mysqli_stmt_affected_rows($stmt) == 1){
                $successmsg = '<div class="success"> Account successfully Deleted</div> <p>Redirecting...</p>';   
                header("refresh:3; url=./update");         
            }else{
                $msg[] = '<div class="error">No changes made</div>';
            }
        }elseif(isset($_POST['submit']) && $_POST['submit'] == 'cancel'){
            redirect('./update');
        }
    }
?>

<div class="admin-section">
    <div class="balance" style="background: var(--dark-black);">
        <div class="left">
            <p><span class="bold-amount">Delete Account</span></p>
            <p> </p>
        </div>
        <div class="right">
            <p></p>
        </div> 
    </div>
    <p>Clicking on DELETE will automatically remove this account from the database...</p>
    <div class="reg-container">
        <div class="pin">
            <div class="content">
                <?php 
                    if (!empty($msg)) {   
                        echo implode('<br/>', $msg);
                    }
                    if(isset($successmsg)){echo $successmsg;}
                echo '<p>Account Name: '.$row['fname'].' '.$row['lname'].' </p>
                <p>Account No: '.$row['acct_no']. '</p>';
                ?>
                <h3 class="align-center"></h3>
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id;?>" />
                    <button type="submit" name="submit" value="delete" class="submit-button white">Delete</button>
                    <button type="submit" name="submit" value="cancel" class="submit-button white" style="background-color: transparent; color: var(--dark-black)">cancel</button>
                </form>
            </div>
        </div>
    </div>

</div>


<?php include "includes/foot.php"; ?>
