<?php 
session_start();
include_once "../config/dbconfig.php";
include_once "../config/func.inc.php";
include_once "includes/count.inc.php";
    if(isset($_SESSION['id'])){
    //$id = $_SSESSION['id'];
    }else{
        redirect('index.php');
    }

    $title = 'Admin dashboard | '.SITE_NAME;
    include "includes/head.php"; 
?>

<div class="admin-section">
    <div class="balance" style="background: var(--dark-black);">
            <div class="left">
                <p><span class="bold-amount">Hello, Admin</span></p>
                <p> </p>
            </div>
            <div class="right">
                <p></p>
            </div> 
    </div>
    <!-- <h1>Hello, Admin</h1> -->
    <div class="acct-services">
        <a href="" id="noClick" class="items">
            <p class="numb"><?php echo $accountNumRows; ?></p>
            <p class="align-left">Users</p>
        </a>
        <a href="" id="noClick" class="items">
            <p class="numb"><?php echo $transNumRows; ?></p>
            <p>Transfers</p>
        </a>
        <a href="" id="noClick" class="items">
            <p class="numb"><?php echo $ticketNumRows; ?></p>
            <p>Tickets</p>
        </a>
        <a href="" id="noClick" class="items">
            <p class="numb"><?php echo $statNumRows; ?></p>
            <p>Pending</p>
        </a>
        <a href="" id="noClick" class="items">
            <p class="numb"><?php echo $activeNumRows; ?></p>
            <p>Active</p>
        </a>
        <a href="" id="noClick" class="items">
            <p class="numb"><?php echo $suspNumRows; ?></p>
            <p>Suspended</p>
        </a>
    </div>
</div>

<?php include "includes/foot.php"; ?>