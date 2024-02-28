<?php 

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
   // last request was more than 30 minutes ago
   session_unset();     // unset $_SESSION variable for the run-time 
   session_destroy(); 
   echo "Timeout";	// destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

function redirect($url){
 if(headers_sent()){
    echo '<script>window.location.href="'.$url.'";</script>';
    exit();
 }else{
    header("location: $url");
 }
 exit();
}

function createAcct($con, $acct_no, $pic, $uname, $fname, $lname, $pass, $dob, $email, $phone, $addr, $sex, $marry, $work, $country, $state, $currency, $type, $status, $billing_code, $a_bal, $pin, $imf, $cot, $regDate) {
   //$acct_no = "35" . substr(rand(500000, 2000000) * date("Y"), 0, 8);
   $q = "INSERT INTO account (acct_no, pic, uname, fname, lname, pass, dob, email, phone, addr, sex, marry, work, country, state, currency, type, status, billing_code, a_bal, pin, imf, cot, date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";
   $r = mysqli_prepare($con, $q);
   mysqli_stmt_bind_param($r, 'sssssssssssssssssssiiiis', $acct_no, $pic, $uname, $fname, $lname, $pass, $dob, $email, $phone, $addr, $sex, $marry, $work, $country, $state, $currency, $type, $status, $billing_code, $a_bal, $pin, $imf, $cot, $regDate);
   mysqli_stmt_execute($r);

   if(mysqli_stmt_affected_rows($r) == 1){
      return TRUE;
   }else{
      return FALSE;
   }  
}

function createCard($con, $acct_id, $card_no, $expiry, $cvv){
   $q = "INSERT INTO cards (acct_no, card_no, card_expiry, card_cvv) VALUES(?,?,?,?)";
   $stmt = mysqli_prepare($con, $q);
   mysqli_stmt_bind_param($stmt, 'isss', $acct_id, $card_no, $expiry, $cvv);
   mysqli_stmt_execute($stmt);
}

function createTicket($con, $id, $uname, $subject, $body, $date){
   $q = "INSERT INTO ticket (acct_id, uname, subject, body, date) VALUES (?,?,?,?,?)";
   $stmt = mysqli_prepare ($con, $q);
   mysqli_stmt_bind_param($stmt, 'issss', $id, $uname, $subject, $body, $date);
   mysqli_stmt_execute($stmt);
   mysqli_stmt_store_result($stmt);
   if(mysqli_stmt_affected_rows($stmt) == 1){
      return TRUE;
   }else{
      return FALSE;
   } 
}

function transferFunds($con, $currentBal, $id, $acct_no, $acct_name, $bank, $amount, $route, $type, $status, $trx_id, $date){
   $q = "INSERT INTO transfer (acct_id, acct_number, acct_name, bank, amount, rout_no, type, status, trx_id, date) VALUES(?,?,?,?,?,?,?,?,?,?) ";
   $stmt = mysqli_prepare($con, $q);
   mysqli_stmt_bind_param($stmt, 'isssssssss', $id, $acct_no, $acct_name, $bank, $amount, $route, $type, $status, $trx_id, $date);
   mysqli_stmt_execute($stmt);

   $a_bal = $currentBal - $amount;
   if(mysqli_stmt_affected_rows($stmt) == 1){
      $q2 = "UPDATE account SET a_bal = ? WHERE acct_id = ?";
      $stmt2 = mysqli_prepare($con, $q2);
      mysqli_stmt_bind_param($stmt2, 'ii', $a_bal, $id);
      mysqli_stmt_execute($stmt2);
   }
   if(mysqli_stmt_affected_rows($stmt2) == 1){
      return TRUE;
   }else{
      return FALSE;
   }  
}

function creditFunds($con, $currentBal, $id, $acct_no, $acct_name, $bank, $amount, $route, $type, $status, $trx_id, $date){
   $q = "INSERT INTO transfer (acct_id, acct_number, acct_name, bank, amount, rout_no, type, status, trx_id, date) VALUES(?,?,?,?,?,?,?,?,?,?) ";
   $stmt = mysqli_prepare($con, $q);
   mysqli_stmt_bind_param($stmt, 'isssssssss', $id, $acct_no, $acct_name, $bank, $amount, $route, $type, $status, $trx_id, $date);
   mysqli_stmt_execute($stmt);

   $a_bal = $currentBal + $amount;
   if(mysqli_stmt_affected_rows($stmt) == 1){
      $q2 = "UPDATE account SET a_bal = ? WHERE acct_id = ?";
      $stmt2 = mysqli_prepare($con, $q2);
      mysqli_stmt_bind_param($stmt2, 'ii', $a_bal, $id);
      mysqli_stmt_execute($stmt2);
   }
   if(mysqli_stmt_affected_rows($stmt2) == 1){
      return TRUE;
   }else{
      return FALSE;
   }  
}
function checkUser($con, $email, $uname) {
   $q = "SELECT * FROM account WHERE email = ? OR uname = ?";
   $stmt = mysqli_prepare($con, $q);
   mysqli_stmt_bind_param($stmt, 'ss', $email, $uname);
   mysqli_stmt_execute($stmt);
   mysqli_stmt_store_result($stmt);
   if(mysqli_stmt_num_rows($stmt) > 0){
      mysqli_stmt_free_result($stmt);
       return TRUE;
   } else {
      mysqli_stmt_free_result($stmt);
      return FALSE;
   }
}
function uploadImage($con, $id, $path, $temp, $ext){
   $newPath = $path.substr(md5(time()), 0, 10).'.'.$ext;
   $actualPath= 'view/'.$newPath;
   if(move_uploaded_file($temp, $newPath)){
      $q = "UPDATE account SET pic = ? WHERE acct_id = ?";
      $stmt = mysqli_prepare($con, $q);
      mysqli_stmt_bind_param($stmt, 'si', $actualPath, $id);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      if(mysqli_stmt_affected_rows($stmt) == 1){
         mysqli_stmt_free_result($stmt);
         return TRUE;
      }else{
         mysqli_stmt_free_result($stmt);
         return FALSE;
      }
   }
}
?>