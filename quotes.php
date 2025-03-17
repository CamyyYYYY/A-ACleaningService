<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';        
        $mail->SMTPAuth   = true;
        $mail->Username   = 'allencamrin@gmail.com';   
        $mail->Password   = 'tatm cama jhhf jadq';    
        $mail->SMTPSecure = 'tls';                 
        $mail->Port       = 587;

  
        $mail->setFrom($email, $name);              
        $mail->addAddress('allencamrin@gmail.com');  

       
        $mail->isHTML(true);
        $mail->Subject = "Inquiry: " . $subject;
        $mail->Body    = "
            <h3>You have a new inquiry from $name</h3>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        $mail->send();
        echo "<p style='text-center; font-size: 24px; font-weight: bold;'>Thanks for your inquiry! We'll reach back with a quote as soon as possible.</p>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
?>
