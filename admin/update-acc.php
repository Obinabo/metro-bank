<?php 
session_start();
include_once "../config/dbconfig.php";
include_once "../config/func.inc.php";
include_once "../phpmailer/mailer.php";
include_once "includes/count.inc.php";
    if(!isset($_SESSION['id'])){
        redirect('index.php');
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else if (isset($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        echo '<div class="error">You have accessed this page in error!</div>';
        redirect("index.php");
    }

    $title = 'Admin dashboard | '.SITE_NAME;
    include "includes/head.php"; 

    $q = "SELECT * FROM account WHERE acct_id = ?";
    $stmt = mysqli_prepare($con, $q);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $r = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($r) > 0){
        $row = mysqli_fetch_assoc($r);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $msg = array();
        $successmsg = '';
        if(empty($_POST['uname'])){
            $msg[] = '<div class="error">Please enter Username</div>';
        }else{
            $uname = mysqli_real_escape_string($con, trim($_POST['uname']));
        }
        if(empty($_POST['phone'])){
            $msg[] = '<div class="error">Please enter Phone number/div>';
        }else{
            $phone = mysqli_real_escape_string($con, trim($_POST['phone']));
        }
        if(empty($_POST['type'])){
            $msg[] = '<div class="error">Please enter account type</div>';
        }else{
            $type = mysqli_real_escape_string($con, trim($_POST['type']));
        }
        if(empty($_POST['sex'])){
            $msg[] = '<div class="error">Please enter Sex/Gender</div>';
        }else{
            $sex = mysqli_real_escape_string($con, trim($_POST['sex']));
        }
        if(empty($_POST['a_bal'])){
            $msg[] = '<div class="error">Please enter an amount for this account</div>';
        }else{
            $a_bal = mysqli_real_escape_string($con, trim($_POST['a_bal']));
        }
        if(empty($_POST['cot'])){
            $msg[] = '<div class="error">Please enter COT for this account</div>';
        }else{
            $cot = mysqli_real_escape_string($con, trim($_POST['cot']));
        }
        if(isset($_POST['submit']) && empty($msg)){
            $status = 'REGISTERED';
            $q2 = "UPDATE account SET uname = ?, phone = ?, type = ?, sex = ?, status = ?, a_bal = ?, cot = ? WHERE acct_id = ?";
                $stmt2 = mysqli_prepare($con, $q2);
                mysqli_stmt_bind_param($stmt2, 'sssssiii', $uname, $phone, $type, $sex, $status, $a_bal, $cot, $id);
                mysqli_stmt_execute($stmt2);
            if(mysqli_stmt_affected_rows($stmt) == 1){
                $newDate = date("d - M - Y");
                $subject = 'Bank Account Updated ['.SITE_NAME_SHORT.']';
                $mail = '
                    <!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset="utf-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <meta http-equiv="x-ua-compatible" content="ie=edge">
                            <style>
                                :root{
                                    --white-color: rgb(255, 255, 255);
                                    --blue-color: rgb(37, 72, 175);
                                    --blue-dim-color: rgb(16, 48, 143);
                                    --red-color: rgb(217, 28, 41);
                                    --red-dim-color: rgb(175, 8, 19);
                                    --bg-grey: rgb(245, 241, 241);
                                    --black-color: rgb(38, 38, 38);
                                    --opacity-black: rgb(26, 25, 25);
                                    --dark-grey: #b6b4b4;
                                }
                                table{ 
                                    border-collapse: separate;
                                    width: 75%;
                                    border-radius: 10px;
                                    border: 1px solid var(--black-color);
                                    margin: 15px auto;
                                    padding: 5px 10px;
                                }
                                tr:nth-of-type(odd){
                                background: var(--dark-grey);
                                }
                                tr:nth-of-type(even){
                                    background: var(--bg-grey);
                                }
                                .bg-red{
                                    background: var(--blue-color)
                                }
                                td{
                                    text-align: left;
                                    padding: 5px;
                                    width: 50%;
                                    font-size: 0.8em
                                }
                                body{     
                                    background-color: var(--bg-grey);
                                    color: var(--black-color);
                                    margin: 0 auto;
                                    padding: 0 ;
                                    width: 100%;
                                    position: relative;
                                }
                                section{
                                    margin:20px auto;
                                    padding: 0 60px;
                                    max-width: 1300px;
                                    position: relative;
                                }
                                hr{
                                    border: none;
                                    height: 10px;
                                    /* margin-top: 15px;  */
                                    border-top: 1px solid var(--red-color);
                                    border-bottom: 1px solid var(--red-color);
                                    margin: 10px auto;
                                }
                                h3{
                                    font-size: 1.5em;
                                    color: var(--black-color);
                                    margin: 5px auto;
                                }
                                p{
                                    font-size: 0.9em;
                                    color: var(--black-color);
                                    margin: 5px auto;
                                    line-height: 180%;
                                    text-align: justify;
                                }
                                a{
                                    color: var(--red-color); 
                                    text-decoration: none; 
                                }
                                a:hover{
                                    color: var(--blue-color); 
                                    text-decoration: none;
                                    font-style: italic; 
                                }
                                .align-center{
                                    text-align: center;
                                }
                                .align-left{
                                    text-align: left;
                                }
                                .align-right{
                                    text-align: right;
                                }
                                .banner{
                                    height: auto;
                                    width: 100%;
                                    margin: 0 auto;
                                    margin-bottom: 15px;
                                }
                                .bold{font-weight: bold;}
                                .red{ color: var(--red-color)}
                                .copyright{
                                    display: flex;
                                    width: 100%;
                                    justify-content: center;
                                    flex-flow: row nowrap;
                                }
                                .copyright .item{
                                    flex: 1;
        
                                }
                                @media(max-width: 500px){
                                p{
                                    font-size: 0.8em;
                                }      
                                section{
                                    margin: 20px auto;
                                    padding: 0 20px;
                                    max-width: 100%;
                                    position: relative;
                                }  
                                table{ 
                                width: 90%
                                }       
                                }
                                @media(prefers-color-scheme: dark){
                                    body{     
                                        background-color: var(--black-color);
                                        color: var(--white-color);
                                    }
                                    h3, p{
                                        color: var(--white-color)
                                    }
                                    table{
                                        border: 1px solid var(--red-color);
                                    }
                                    tr:nth-of-type(odd){
                                        background: var(--opacity-black);
                                    }
                                    tr:nth-of-type(even){
                                        background: var(--black-color);
                                    }
                                }
                            </style>
                        </head>
                        <body>
                            <section>
                                <img src="'.URL.'/assets/img/solo-acct-banner1.png" alt="" class="banner"/>
                                <h3>Metro Digital Online Notification - '.$newDate.'</h3>
                                <br><br>
                                <p>Hello,</p>
                                <h3> Hello'.$row['fname'].'</h3>
                                <p>We are delighted to inform you that your account with '.SITE_NAME_SHORT.' has been successfully activated! 🎉. On behalf of the entire team, we extend a warm welcome to you.
                                    <br/>
                                    Your decision to join our banking family is truly appreciated, and we are honored to have you with us. Your account activation marks the beginning of a valuable partnership, and we are committed to providing you with exceptional service and support every step of the way.
                                </p>
                                <p>we strive to make your banking experience seamless and rewarding. Whether you are managing your finances, exploring our range of services, or seeking assistance from our dedicated team, we are here to assist you in achieving your financial goals.<br/>

                                    As you embark on this journey with us, we encourage you to explore the various features and benefits available to you. From online banking convenience to personalized assistance, we are dedicated to meeting your banking needs efficiently and effectively.
                                    
                                    Should you have any questions or require assistance at any point, please do not hesitate to reach out to us. Our team is readily available to address your inquiries and ensure that your banking experience remains smooth and satisfactory.
                                </p>
                                <p>Please see below details of your new account</p>
                            <table>
                                <tr>
                                    <td>Account Name: </td>
                                    <td>'.$row['fname'].' '.$row['lname'].'</td>
                                </tr>
                                <tr>
                                    <td>Account Number:</td>
                                    <td>'.$row['acct_no'].'</td>
                                </tr>
                                <tr>
                                    <td>COT:</td>
                                    <td>'.$row['cot'].'</td>
                                </tr>
                                <tr>
                                    <td>Account Type:</td>
                                    <td>'.$row['type'].'</td>
                                </tr>
                                <tr>
                                    <td>Amount:</td>
                                    <td>'.$row['a_bal'].'</td>
                                </tr>
                                 
                            </table>
                                <p><span class="bold">Remember:</span> Metro Digital would NEVER call, SMS, or e-mail requesting for your card details, PIN, token codes, mobile/internet
                                    banking details or other account related information. Please DO NOT respond to such messages.
                                </p>
                                <p>You can reach our 24/7 contact centeron the details below with us at '.SITE_NAME.' or follow us on Facebook, Twitter and Instagram.</p>
                                <p>Thank you for banking with us.</p>
                                <a href="'.URL.'">'.URL.'</a>
                                <hr/>
                                <div class="copyright">
                                    <div class="item">
                                        <p class="align-left"><a href="'.URL.'/about">For enquiries, kindly contact Metro Digital</a></p>
                                        <p class="align-left"><a href="'.URL.'/contact">Our 24hr interactive contact center</a></p>
                                    </div>
                                    <div class="item">
                                        <p class="align-right red"><a href="mailto:'.SITE_EMAIL.'">'.SITE_EMAIL.'</a></p>
                                    </div>
                                </div>
        
                            </section>
                        </body>
                    </html>    
                ';
                $email = $row['email'];
                sendEmail($email, $subject, $mail);    
                $successmsg = '<div class="success"> Account successfully updated</div> <p>Redirecting...</p>';   
                header("refresh:3; url=./update");         
            }else{
                $msg[] = '<div class="error">No changes made</div>';
            }
        }
    }
?>

<div class="admin-section">
    <div class="balance" style="background: var(--dark-black);">
        <div class="left">
            <p><span class="bold-amount">Update Accounts</span></p>
            <p> </p>
        </div>
        <div class="right">
            <p></p>
        </div> 
    </div>
    <p>Edit user information before submitting<br/> By submitting, you update user's account from DORMANT to ACTIVE</p>
    <div class="reg-container">
        <div class="pin">
            <div class="content">
                <?php 
                    if (!empty($msg)) {   
                        echo implode('<br/>', $msg);
                    }
                    if(isset($successmsg)){echo $successmsg;}
                ?>
                <h3 class="align-center"></h3>
                <form action="" method="POST">
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Account Name</p>
                    <span class="input-container"><input type="text" name="acct_name" id="email" value="<?php echo $row['lname'].' '.$row['fname']; ?>" disabled><i class="details-black fa fa-dice-one"></i></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Account No</p>
                    <span class="input-container"><input type="text" name="acct_no" id="email" value="<?php echo $row['acct_no']; ?>" disabled><i class="details-black fa fa-dice-one"></i></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px">Email</p>
                    <span class="input-container"><input type="text" name="email" id="email" value="<?php echo $row['email']; ?>" disabled><i class="details-black fa fa-dice-one"></i></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Username</p>
                    <span class="input-container"><input type="text" name="uname" id="email" value="<?php echo $row['uname']; ?>"><i class="details-black fa fa-dice-one"></i></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Phone Number</p>
                    <span class="input-container"><input type="text" name="phone" id="email" value="<?php echo $row['phone']; ?>"><i class="details-black fa fa-dice-one"></i></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Account Type</p>
                    <span class="input-container"><input type="text" name="type" id="email" value="<?php echo $row['type']; ?>"><i class="details-black fa fa-dice-one"></i></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Gender</p>
                    <span class="input-container"><input type="text" name="sex" id="email" value="<?php echo $row['sex']; ?>"><i class="details-black fa fa-dice-one"></i></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Total balance</p>
                    <span class="input-container"><input type="number" name="a_bal" id="email" value="<?php echo $row['a_bal']; ?>"><i class="details-black fa fa-dice-one"></i></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> COT [Enter 4 Digit COT]</p>
                    <span class="input-container"><input type="number" name="cot" id="email" value="<?php echo $row['cot']; ?>"><i class="details-black fa fa-dice-one"></i></span>

                    <input type="hidden" name="id" value="<?php echo $id;?>" />
                    <button type="submit" name="submit" class="submit-button white">Update Account</button>
                </form>
            </div>
        </div>
    </div>

</div>


<?php include "includes/foot.php"; ?>
