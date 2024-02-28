<?php
session_start();
include_once "../config/dbconfig.php";
include_once "../config/func.inc.php";
$title = 'Login | '.SITE_NAME;
include "includes/header.php"; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $msg = array();
    if(empty($_POST['id'])){
        $msg[] = '<div class="error">Please enter your user ID</div>';
    }else{
        $logid = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['id'])));
        $logid = strip_tags($logid);
    }    
    if(empty($_POST['password'])){
        $msg[] = '<div class="error">Please enter your Password</div>';
    }else{
        $pass = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['password'])));
        $pass = strip_tags($pass);
    }
    if(empty($msg)){
        $q = "SELECT * FROM account WHERE email = ? OR uname = ? OR acct_no = ? LIMIT 1";
        $stmt = mysqli_prepare ($con, $q);
        if($stmt){
            mysqli_stmt_bind_param($stmt, 'sss', $logid, $logid, $logid);
            mysqli_stmt_execute($stmt);
            $r = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($r)){ 
                //$row = mysqli_fetch_assoc($r);
                $pass2 = $row['pass'];
                // echo 'Entered Password: ' . $pass . '<br>';
                // echo 'Database Password: ' . $pass2 . '<br>';
                if (password_verify($pass, $pass2)) {
                    $status = $row['status'];
                    if ($status === 'DORMANT') {
                        $msg[] = '<div class="error">This account isn\'t processed yet..<br> Please wait for approval email</div>';
                    }
                    if ($status === 'REGISTERED') {
                        $_SESSION['acct_id'] = $row['acct_id'];
                        redirect('./welcome');
                    }
                    if ($status === 'ACTIVE') {
                        $_SESSION['acct_id'] = $row['acct_id'];
                        redirect('./dashboard');
                    }
                    if ($status === 'SUSPENDED'){
                        $msg[] = '<div class="error">This account is suspended..<br> Please contact your account officer</div>';
                    }
                    if ($status === 'CLOSED') {
                        $msg[] = '<div class="error">This account is closed..<br> Please contact your account officer</div>';
                    }
                }else{
                    $msg[] = '<div class="error">Incorrect Password</div>';
                }
            }else {
                $msg[] = '<div class="error">Invalid Banking ID</div>';
            }
        }
    }

}

?>
<div class="reg-container" style="background: transparent url('assets/img/hd/person-expressing.jpg') no-repeat; background-size: cover; background-position: center;">
    
    <div class="login">
        <div class="content">
            <?php 
                if (!empty($msg)) {   
                    echo implode('<br/>', $msg);
                } 
            ?>
            <h3 class="align-center white">Welcome to <?php echo SITE_NAME_SHORT;?> Internet Banking </h3>
            <p style="text-align: left; color: var(--white-color)">Sign in with your Internet Banking details. Not registered on Internet Banking? Click on register to get started</p>
            <form action="./login" method="post">
                <span class="input-container"><input type="text" name="id" id="email" placeholder="Email/Username/Acct Number"><i class="details fa-regular fa-circle-user"></i></span>
                <span class="input-container"><input type="password" name="password" id="password" placeholder="Password"><i class="details fa fa-fingerprint"></i><span class="eye" id="eye" onclick="toggleEye()"><i class="fa fa-eye-slash"></i></span></span>
                <p><a class="white align-right" href="./forgot">Forgot Password?</a></p>
                <button type="submit" class="submit-button white">Proceed</button>
                <p class="white" style="text-align: center;">Don't have an account yet?</p>
                <button type="button" onclick="redirectToRegister()" class="submit-blue align-center white">Create an account <i class="fa-solid fa-arrow-right-long"></i></button>
            </form>
        </div>
    </div>
</div>
<script>
    function redirectToRegister() {
        console.log("Button clicked");
        window.location.href = './register';
    }
    function toggleEye(){
        var passInput = document.getElementById('password');
        var eyeIcon = document.getElementById('eye');
        if (passInput.type === 'password') {
            passInput.type = 'text';
            eyeIcon.innerHTML = '<i class="fa fa-eye-slash"></i>';
        } else {
            passInput.type = 'password';
            eyeIcon.innerHTML = '<i class="fa fa-eye"></i>';
        }
    }
</script>
<?php include "includes/footer2.php"; ?>