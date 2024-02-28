<?php
include_once "../config/dbconfig.php";
include_once "../config/func.inc.php";
$title = 'Create New Password | '.SITE_NAME;
include "includes/header.php";
$successMsg = '';
$successButton = '';
?>
<div class="reg-container" style="background: transparent url('assets/img/hd/person-expressing.jpg') no-repeat; background-size: cover; background-position: center;">
    <?php 
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if(isset($_GET['x'], $_GET['y']) && filter_var($_GET['x'], FILTER_VALIDATE_EMAIL) && (strlen($_GET['y'])) == 32 ){
            $email = mysqli_real_escape_string($con, $_GET['x']);
            }else{
            echo '
            <div class="center-to-page">
                <div class="error"><h1 class="white">Invalid Link</h1>
                    <p class="white">Redirecting...</p>
                </div>
            </div>
            ';
            header('refresh:3; url=./login');
            }
            $msg = array();
            if(empty($_POST['password']) || empty($_POST['password2'])){
                $msg[] = '<div class="error">Please select new password for your account</div>';
            }else if(empty($_POST['password']) !== empty($_POST['password2'])){
                $msg[] = '<div class="error">The passwords do not match!</div>';
            }else{
                $pass = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['password'])));
                $pass = strip_tags($pass);
            } 
            $q = "UPDATE account SET pass = ? WHERE email = ?";
            $stmt = mysqli_prepare($con, $q);
            mysqli_stmt_bind_param($stmt, 'ss', $pass, $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_affected_rows($stmt) == 1){
                mysqli_stmt_free_result($stmt);
                $successMsg = '<div class="success">New Password Created</div>';
                $successButton = '<button type="button" onclick="window.location.href = \'./login\';" class="submit-blue2 align-center white" style="background: green;">Return to login</button>';
            }
        }
    ?>
    <div class="login">
        <div class="content">
            <?php 
                if (!empty($msg)) {   
                    echo implode('<br/>', $msg);
                } 
            ?>
            <h3 class="align-center white">Create New Password </h3>
            <!-- <p style="text-align: left; color: var(--white-color)">Sign in with your Internet Banking details. Not registered on Internet Banking? Click on register to get started</p> -->
            <form action="./create-pass" method="post">
                <span class="input-container"><input type="password" name="password" id="password" placeholder="Enter New Password"><i class="details fa fa-fingerprint"></i><span class="eye" id="eye" onclick="toggleEye()"><i class="fa fa-eye-slash"></i></span></span>
                <span class="input-container"><input type="password" name="password" id="password" placeholder="Confirm New Password"><i class="details fa fa-fingerprint"></i></span>
                <!-- <p><a class="white align-right" href="./forgot">Forgot Password?</a></p> -->
                <button type="submit" class="submit-button white">Proceed</button>
                <?php if(isset($successButton)){echo $successButton;}?>
                <!-- <button type="button" onclick="redirectToRegister()" class="submit-blue align-center white">Create an account <i class="fa-solid fa-arrow-right-long"></i></button> -->
            </form>
        </div>
    </div>
</div>
<script>
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