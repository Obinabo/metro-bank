<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/aos.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.2.0-web/css/all.css">
    <link rel="icon" href="../assets/img/metro.png">
    <title><?php echo $title; ?></title>
</head>
<body>
    <div class="header" style="position: fixed; background: var(--dark-black);">
            <div class="left">
                <?php
                    if(isset($_SESSION['id'])){
                        echo '<div id="mobile-icon"><i class="fa-solid fa-bars"></i></div>';
                    }else{
                        echo '';
                    }
                ?>
                <a href="./"><img src="../assets/img/metro-logo.png" class="logo" alt="logo"></a>
            </div>
            
            <div class="right">
                <?php
                    if(isset($_SESSION['id'])){
                        echo '<a id="red-button" href="./dashboard">Admin <i class="fa-solid fa-user"></i></a>';
                    }else{
                        echo '';
                    }
                ?>
            </div>
            <div class="reg-tool align-center">
                <!-- <a href="./login">Personal banking</a>
                <a href="./online-banking">Apply for online banking</a> -->
                <a href="./logout"><i class="fa fa-power-off"></i> Logout</a>
            </div>
    </div>
    <?php
        if(isset($_SESSION['id'])){
            echo '<div class="admin-cont align-left">
            <a href="./dashboard">Home</a>
            <a href="./users">View Users</a>
            <a href="./update">Pending Accounts</a>
            <a href="./transfers">All Transfers</a>
            <a href="./credit">Credit User</a>
            <a href="./debit">Debit User</a>
            <a href="./billing">Billing Codes</a>
            <a href="./update-status">Update Status</a>
            <a href="./add-account">Add Account</a>
                    <br/><br/>
            <!-- <p><i class="fa-solid fa-location-dot"></i>Address: <?//php echo ADDRESS ?></p>
            <p><i class="fa-solid fa-phone"></i>Tel: <?//php echo PHONE_NO ?></p> -->
            </div>';
        }else{
            echo '';
        }
    ?>
