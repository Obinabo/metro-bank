<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/aos.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.2.0-web/css/all.css">
    <link rel="icon" href="assets/img/metro.png">
    <title><?php echo $title; ?></title>
</head>
<body>
    <div class="header" style="position: relative; background: var(--blue-color);">
            <div class="left">
                <div id="mobile-icon"><i class="fa-solid fa-bars"></i></div>
                <a href="./"><img src="assets/img/metro-logo.png" class="logo" alt="logo"></a>
            </div>
            <div class="center">
                <a href="./bank-accounts">Bank Accounts</a>
                <a href="./savings">Savings</a>
                <a href="./mortgage">Mortgages</a>
                <a href="./insurance">Insurance</a>
                <a href="./private-banking">Private-Banking</a>
            </div>
            <div class="right">
                <a id="hide-mobile" href=""><i class="fa-solid fa-location-dot"></i>Find A Store</a>
                <a id="hide-mobile" href=""><i class="fa-solid fa-regular fa-magnifying-glass"></i> Help</a>
                <?php
                    if(isset($_SESSION['acct_id'])){
                        echo '<a class="red-button" href="./dashboard">Dashboard</a>';
                    }else{
                        echo '<a id="red-button" href="">Login <i class="fa-solid fa-chevron-down"></i></a>';
                    }
                ?>
            </div>
            <div class="reg-tool align-center">
                <a href="./login">Personal banking</a>
                <a href="./online-banking">Apply for online banking</a>
                <a href="./business">Business banking</a>
            </div>
    </div>
    <div class="nav-cont align-center">
        <a href="./business">Bank Accounts</a>
        <a href="./savings">Savings</a>
        <a href="./mortgage">Mortgages</a>
        <a href="./insurance">Insurance</a>
        <a href="./private-banking">Private Banking</a>
        <br/><br/>
        <p><i class="fa-solid fa-location-dot"></i>Address: <?php echo ADDRESS ?></p>
        <p><i class="fa-solid fa-phone"></i>Tel: <?php echo PHONE_NO ?></p>
    </div>