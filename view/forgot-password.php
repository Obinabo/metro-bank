<?php
$successMsg = '';
include_once "../config/dbconfig.php";
include_once "../config/func.inc.php";
$title = 'Forgot Password | '.SITE_NAME;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $msg = array();
    if(!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $email = mysqli_real_escape_string($con, trim($_POST['email']));
    }else{
        $msg[] = '<div class="error"> Please enter your email</div>';
    }
    if(empty($msg)){
        $q = "SELECT * FROM account where email = ?";
        $stmt = mysqli_prepare($con, $q);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $r = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($r)){ 
            $db_email = $row['email'];
            $fname = $row['fname'];
            $unique_string = md5(uniqid(rand(), true));
            $forgot_link = URL.'/view/forgot.php?x='.urlencode($db_email).'&y='.$unique_string;
            $subject = '['.SITE_NAME_SHORT.'] Password Recovery';
            $mail = '
            <html>
                <head>
                    <meta charset="utf-8">
                
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="x-ua-compatible" content="ie=edge">
                    <style>
                        html {background-color: rgb(206, 202, 202);}
                        body{font-family: Arial, Helvetica, sans-serif; font-size: 1em; background-color: rgb(252, 252, 252); line-height: 1.5; margin: 0 auto 0 auto; width: 100%;}
                        .header{background-color: rgb(37, 72, 175); padding-top: 20px; padding: 20px; text-align:center; display:flex;}
                        .container{padding: 10px; border-color: rgb(8, 102, 165); width: 100%; align-items: center;}
                        .footer{background-color: rgb(217, 28, 41); margin: 30px auto 0px auto; padding: 5px; -moz-box-align: center; -webkit-box-align: center; color: rgb(243, 146, 0); }
                        p {text-align: center; font-size: 1em}
                        h1{font-size: 2em; color: rgb(37, 72, 175); font-weight: bolder;}
                        h2{font-size: 1.5em; color: rgb(37, 72, 175); font-weight: bolder;}
                        .footer>.list{text-align: center; font-size: 0.7em; margin-top: 20px; padding: 20px; border-top: 1px solid rgb(201, 199, 199);}
                        .box1{margin-right: 20%;}
                        .box{width: 100%; flex-direction: column;}
                        #logo{width: 30%;}
                        a{color: #fff; text-decoration: none;}
                        a:visited{color:rgb(243, 146, 0);}
                        a:active{color:rgb(243, 146, 0)}
                        a:hover{color: #f39200;}
                        .button{
                            padding: 10px;
                            background-color: rgb(37, 72, 175);
                            color:rgb(255, 255, 255);
                            width:fit-content;
                            margin: 20px auto;
                            transition: 1s;
                            border-radius: 20px;
                        }
                        .button:hover{
                            background-color: rgb(16, 48, 143);
                            margin: 20px auto;
                        
                        }
                        img{padding: 10px; box-shadow: -5px 5px 10px rgba(71, 71, 71, 0); margin: 5px;}
                        .text-black{color: rgb(27, 27, 27)}
                        .text-white{color: rgb(253, 252, 252)}
                        .text-bold{font-weight: bold;}
                    .footer>p{font-size: 0.8em;}
                        .welcome{padding: auto; margin: auto; box-shadow: -5px 5px 10px rgba(71, 71, 71, 0); width: 80%;}
                    </style>
                </head>
                <body>
                    <header>
                        <div class="header">
                            <div class="box"><a href="'.URL.'">Home</a></div>
                            <!--<div class="box"> <a href="https://melksreality.com/invoice">Home</a></div>
                            <div class="box"><a href="https://melksreality.com/invoice/?a=about">About</a></div>
                            <div class="box"><a href="https://melksreality.com/invoice/?a=login">Login</a></div>
                            <div class="box"><a href="https://melksreality.com/invoice/?a=signup">Sign Up</a></div>
                            <div class="box"><a href="https://melksreality.com/invoice/?a=account">Dashboard</a></div>-->
                        </div>
                    </header>
                    <center>
                        <div id="logo"><a href="'.URL.'"><img src="'.URL.'/assets/img/metro-logo-black.png" width="120px" height="40px" alt="logo" /></a></div>          
                        <h1>Hello'.$fname.'</h1>
                        <p>Please click the button below to reset your banking password</p>
                        <a class="button" href="'.$forgot_link.'"></a>
                        <p>Or</p>
                        <p>Copy and paste the below link into your browser address bar</p>
                        <a href=""></a>
                        </div>
                    </center>
                    <footer>
                        <div class="footer text-white">
                            <p class="text-bold">Address: '.ADDRESS.'.</p>
                            <!--<p class="text-bold">Phone: </p>-->
                            <p class="text-bold">Support Email:'.SITE_EMAIL.'</p>

                            <p>Kind Regards, '.SITE_TITLE.'</p>
                            <div class="list ">
                                <p>'.SITE_TITLE.' Copyriight &#169; 2023</p>
                            </div>
                        </div>
                    </footer>
                </body>
            </html>
            ';
            include 'mail.php';
            sendEmail($db_email, $subject, $mail);
            $successMsg = '<div class="success"> 
            <div class="close"><i class="fa fa-solid fa-xmark"></i></div><br/>Check your email for password reset link</div>';  
        }else{
            $msg[] = '<div class="error"> 
            <div class="close2">x</div><br/>No such email exists on our servers</div>';
        }
    }

}
include 'includes/header.php';
?>
<body>
    <div class="reg-container">
        <div class="login">
        <div class="content">
        <h1 class="white align-center">Password Recovery</h1>
                <p class="white" style="text-align: center;"> Enter your banking email</p>
                <?php
            if (!empty($msg)) {
                echo  implode('<br>', $msg);
            }else{
                echo $successMsg;
            }
            ?>
                
                <form action="forgot" method="post">
                    <span class="input-container"><input type="text" name="email" id="email" placeholder="Email"><i class="details fa-regular fa-circle-user"></i></span>
                    <button type="submit" class="submit-button white">Recover Password</button>
                </form>    
        </div>
        </div>
    </div>
    <script>
        var status = document.querySelector('.success');
        var close = document.querySelector('.success > .close');
        status.style.display = 'block';
        close.addEventListener('click', function(){
            console.log('Button Clicked');
            status.style.display = 'none';
        })
    </script>
    <?php include 'includes/footer.php';?>