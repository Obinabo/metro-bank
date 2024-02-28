<?php
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';
use phpmailer\phpmailer\PHPMailer;

function sendEmail($recipient, $subject, $body) {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'cp1.sitejungle.net';
    $mail->SMTPAuth = true;
    $mail->Username = 'support@metrodigitalonline.com';
    $mail->Password = 'Metrodigital2023';
    $mail->SMTPSecure = '';
    $mail->Port = 587;
    
    // Set email content and recipient(s)
    $mail->setFrom('support@metrodigitalonline.com', 'Metro Digital');
    $mail->addAddress($recipient);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->Send();
}
?>