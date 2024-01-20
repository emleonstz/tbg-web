<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
$email = (isset($_GET['mail'])) ? $_GET['mail'] : "";

function sendEmail($name, $email, $subject, $message){
    
    $name = $name;
    $email = $email;
    require 'vendor/autoload.php';	

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';

    $receiver = 'test@gmail.com';
 
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.tbg.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'reset@tbg.com';                     //SMTP username
    $mail->Password   = 'abcd23fsfh';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->From = 'noreply@tbglivery.online';
    $mail->setFrom('noreply@tbglivery.online', 'TBG livery');
    $mail->addAddress($email, $name);     //Add a recipient

    //Content
    $mail->isHTML(true); 
   
                               //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;

    $p = $mail->send();
    
    if (!$p) {
        throw new Exception('Unable to send email: ' . $mail->ErrorInfo);
    }
}
?>
