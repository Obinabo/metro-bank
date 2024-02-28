<?php 
session_start();
include_once "../config/dbconfig.php";
include_once "../config/func.inc.php";
include_once "../phpmailer/mailer.php";
include_once "includes/count.inc.php";
    if(!isset($_SESSION['id'])){
        redirect('index.php');
    }

    $title = 'Admin dashboard | '.SITE_NAME;
    include "includes/head.php"; 
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $msg = array();
        $successmsg = '';
        if(empty($_POST['acct_name'])){
            $msg[] = '<div class="error">Please select an account</div>';
        }else{
            $id = mysqli_real_escape_string($con, trim($_POST['acct_name']));
        }
        if(empty($_POST['amount'])){
            $msg[] = '<div class="error">Please enter an amount</div>';
        }else{
            $amount = mysqli_real_escape_string($con, trim($_POST['amount']));
        }
        if(empty($_POST['sender'])){
            $msg[] = '<div class="error">Please enter sender\'s name</div>';
        }else{
            $sender = mysqli_real_escape_string($con, trim($_POST['sender']));
        }
        if(empty($_POST['narration'])){
            $msg[] = '<div class="error">Please enter transaction description</div>';
        }else{
            $narration = mysqli_real_escape_string($con, trim($_POST['narration']));
        }
        if(empty($_POST['date'])){
            $msg[] = '<div class="error">Please enter transaction date</div>';
        }else{
            $date1 = mysqli_real_escape_string($con, trim($_POST['date']));
        }
        if(empty($_POST['time'])){
            $msg[] = '<div class="error">Please enter transaction time</div>';
        }else{
            $time1 = mysqli_real_escape_string($con, trim($_POST['time']));
        }
        $trnx_date = $date1.' '.$time1;
        
        if(isset($_POST['submit']) && empty($msg)){
            $q = "SELECT * FROM account WHERE acct_id = ?";
            $stmt = mysqli_prepare($con, $q);
            mysqli_stmt_bind_param($stmt, 's', $id);
            mysqli_stmt_execute($stmt);
            $r = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($r) > 0){
                $user = mysqli_fetch_assoc($r);
            }
            if($user['a_bal'] < $amount){
                $msg[] = '<div class="error">Insufficient account to debit</div>';
            }else{
                
                $bal = $user['a_bal'] - $amount;
                $current_bal = $user['a_bal'];
                $acct_no = substr(rand(10000, 30000)*time(), 0, 10);
                $status = 'Completed';
                $type = 'Debit';
                $bank = 'Wells Fina***';
                $tr_id = substr(md5(rand()*time()), 0, 15);
                $route = '701132429';
                if(transferFunds($con, $current_bal, $id, $acct_no, $sender, $bank, $amount, $route, $type, $status, $tr_id, $trnx_date) === TRUE){
                    $newDate = date("d - M - Y");
                    $subject = 'Debit Alert ['.SITE_NAME_SHORT.']';
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
                                <h3>'.SITE_TITLE.' Notification - '.$trnx_date.'</h3>
                                <br><br>
                                <p>Dear '.$user['fname'].' '.$user['lname'].'</p>
                                <p>A debit transaction occured with us on your account</p>

                                <p>Please see below details of the transaction on your account</p>
                                <table>
                                    <tr>
                                        <td>Sender Account: </td>
                                        <td>'.$acct_no.'</td>
                                    </tr>
                                    <tr>
                                        <td>Credit/Debit:</td>
                                        <td>'.$type.'</td>
                                    </tr>
                                    <tr>
                                        <td>Date/Time:</td>
                                        <td>'.$trnx_date.'</td>
                                    </tr>
                                    <tr>
                                        <td>Description:</td>
                                        <td>'.$narration.'</td>
                                    </tr>
                                    <tr>
                                        <td>Amount:</td>
                                        <td>'.$amount.'</td>
                                    </tr>
                                    <tr>
                                        <td>Balance:</td>
                                        <td>'.$current_bal.'</td>
                                    </tr>
                                    <tr style="background: var(--red-color); color: var(--white-color)">
                                        <td>Available Balance:</td>
                                        <td>'.$bal.'</td>
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
                    $email = $user['email'];
                    sendEmail($email, $subject, $mail);    
                    $successmsg = '<div class="success"> Account successfully debited</div> <p>Redirecting...</p>';        
                }else{
                    $msg[] = '<div class="error">Debit failed</div>';
                }
            }
        }
    }
?>

<div class="admin-section">
    <div class="balance" style="background: var(--dark-black);">
        <div class="left">
            <p><span class="bold-amount">Debit Account</span></p>
            <p> </p>
        </div>
        <div class="right">
            <p></p>
        </div> 
    </div>
    <p>Select a user account you want to remove money from...</p>
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
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Account To Debit</p>
                    <span class="input-container"><select name="acct_name" id="email" required>
                        <option value="">Choose Account</option>
                        <?php while($row = mysqli_fetch_array($rActive)){?>
                            <option value="<?php echo $row['acct_id']; ?>"><?php echo $row['acct_no'].' - '.$row['lname'].' '.$row['fname']; ?></option>
                        <?php } ?>
                    </select></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Amount</p>
                    <span class="input-container"><input type="number" name="amount" id="email" placeholder="0.00"><i class="details-black fa fa-money-check-dollar"></i></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> From</p>
                    <span class="input-container"><input type="text" name="sender" id="email" placeholder="Enter name of receiver"><i class="details-black fa fa-dice-one"></i></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Description</p>
                    <span class="input-container"><input type="text" name="narration" id="email" placeholder="Eg. Flight Payment"><i class="details-black fa fa-file-invoice-dollar"></i></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Date</p>
                    <span class="input-container"><input type="text" name="date" id="email" placeholder="Eg. 20/02/2024"><i class="details-black fa fa-file-invoice-dollar"></i></span>
                    <p class="align-left" style="font-size: 0.7; margin-bottom: -10px"> Time</p>
                    <span class="input-container"><input type="text" name="time" id="email" placeholder="Eg. 12:32"><i class="details-black fa fa-file-invoice-dollar"></i></span>
                    <button type="submit" name="submit" class="submit-button white">Debit Account</button>
                </form>
            </div>
        </div>
    </div>

</div>


<?php include "includes/foot.php"; ?>
