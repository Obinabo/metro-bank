<?php
session_start();
include_once "../config/dbconfig.php";
include_once "../config/func.inc.php";
if(isset($_SESSION['acct_id'])){
  $id = $_SESSION['acct_id'];
}else{
  redirect('./login');
}
error_reporting(E_ALL);
$title = 'Welcome | '.SITE_NAME;
include "includes/header.php";

$q = "SELECT * FROM account WHERE acct_id = ? LIMIT 1";
$stmt = mysqli_prepare ($con, $q);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$r = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($r);
$status = $row['status'];

if ($status === 'DORMANT') {
    redirect('./login');
}elseif($status === 'SUSPENDED'){
    redirect('./login');
}
?>
<section>
  <div class="text-container">
    <center><img src="assets/img/undraw_completed_m9ci.svg" height="200px" width="200px" alt="logo" style="margin: 5px auto;"/></center>
    <h3 class="align-center"> Welcome to our secure banking platform</h3>
    <h5 class="align-center">Your gateway to safe and trusted financial transactions</h5>
    <div class="highlights">
      <i class=" fa-solid fa-regular fa-fingerprint"></i>
      <div class="right">
        <h4>Two-Factor Authentication (2FA)</h4>
        <p>Enhance account security by implementing 2FA</p>
      </div>
    </div>
    <div class="highlights">
      <i class=" fa-solid fa-regular fa-bug"></i>
      <div class="right">
        <h4>Encryption</h4>
        <p>End-to-end encryption to safeguard user data during transmission</p>
      </div>
    </div>
    <div class="highlights">
      <i class=" fa-solid fa-regular fa-shield-halved"></i>
      <div class="right">
        <h4>Fraud Monitoring and Detection</h4>
        <p>Protecting accounts from fraudulent transactions</p>
      </div>
    </div>
    <div class="highlights">
      <i class=" fa-solid fa-regular fa-compass"></i>
      <div class="right">
        <h4>Device Recognition</h4>
        <p>Utilize device recognition technology to identify and authorize known devices</p>
      </div>
    </div>
    <div class="highlights">
      <i class=" fa-solid fa-regular fa-umbrella-beach"></i>
      <div class="right">
        <h4>Firewall Protection</h4>
        <p>Employ firewalls to monitor and control incoming and outgoing network traffic</p>
      </div>
    </div>
    <a href="./pin-auth" class="black-button align-center white"style="margin: 5px 0px 5px auto">Continue <i class="fa-solid fa-arrow-right-long"></i></a>
  </div>
</section><br><br><br>

<?php include "includes/footer2.php"; ?>