<?php
session_start();
include_once "../config/dbconfig.php";
include_once "../config/func.inc.php";
if(isset($_SESSION['acct_id'])){
    $_SESSION = array(); 
    session_destroy();
    redirect('./login');
}else{
    redirect('./login');
}

?>