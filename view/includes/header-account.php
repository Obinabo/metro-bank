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
    <div class="account-head">
            <div class="left">
                <a href="./"><img src="assets/img/metro-logo.png" class="logo" alt="logo"></a>
            </div>
            <div class="right">
                <p>Hello, <?php echo $row['fname']; ?></p>
                <img src="<?php echo $row['pic'];?>" id="user-icon"  alt="user pic"/>    
            </div> 
    </div>
    <div class="user-nav align-center">
    <div class="close2" id="close-nav"><i class="fa fa-xmark black"></i></div>
        <img src="<?php echo $row['pic'];?>" id="user-icon"  alt="user pic"/>
        <div class="list">
            <div class="key">Name</div>
            <div class="value"><?php echo $row['fname'].' '.$row['lname'];?></div>
        </div>
        <div class="list">
            <div class="key">Username</div>
            <div class="value"><?php echo $row['uname'];?></div>
        </div>
        <div class="list">
            <div class="key">Gender</div>
            <div class="value"><?php echo $row['sex'];?></div>
        </div>
        <div class="list">
            <div class="key">Occupation</div>
            <div class="value"><?php echo $row['work'];?></div>
        </div>
        <p class="white">Contact Information</p>
        <div class="list">
            <div class="key">Email</div>
            <div class="value"><?php echo $row['email'];?></div>
        </div>
        <div class="list">
            <div class="key">Phone</div>
            <div class="value"><?php echo $row['phone'];?></div>
        </div>
        <div class="list">
            <div class="key">Email</div>
            <div class="value"><?php echo $row['addr'];?></div>
        </div>
    </div>
