<?php 
session_start();
include_once "../config/dbconfig.php";
include_once "../config/func.inc.php";
$title = 'Admin | '.SITE_NAME;
include "includes/head.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $msg = array();
    if(empty($_POST['email'])){
        $msg[] = '<div class="error">Please enter admin email</div>';
    }else{
        $email = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['email'])));
        $email = strip_tags($email);
    }    
    if(empty($_POST['password'])){
        $msg[] = '<div class="error">Please enter your Password</div>';
    }else{
        $pass = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['password'])));
        $pass = md5(strip_tags($pass));
    }
    if(empty($msg)){
        $q = "SELECT * FROM admin WHERE email = ? LIMIT 1";
        $stmt = mysqli_prepare ($con, $q);
        if($stmt){
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $r = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($r)){ 
                $pass2 = $row['pass'];
                if ($pass !== $pass2) {  
                    $msg[] = '<div class="error">Incorrect admin password</div>';
                }else{
                    $_SESSION['id'] = $row['id'];
                    redirect('./dashboard');
                }
            }else {
                $msg[] = '<div class="error">Incorrect admin email</div>';
            }
        }
    }
}
?>
<div class="reg-container" style="background: var(--opacity-black) no-repeat; background-size: cover; background-position: center; height: 100%">  
        <div class="login" id="admin-margin">
            <div class="content">
                <?php 
                    if (!empty($msg)) {   
                        echo implode('<br/>', $msg);
                    } 
                ?>
                <h3 class="align-center white">Admin Login </h3>
                <form action="" method="post">
                    <span class="input-container"><input type="text" name="email" id="email" placeholder="Amin Emain"><i class="details fa-regular fa-circle-user"></i></span>
                    <span class="input-container"><input type="password" name="password" id="password" placeholder="Admin Password"><i class="details fa fa-fingerprint"></i><span class="eye" id="eye" onclick="toggleEye()"><i class="fa fa-eye-slash"></i></span></span>
                    <button type="submit" class="submit-button white">Proceed To Admin</button>
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
<?php include "includes/foot.php"; ?>
