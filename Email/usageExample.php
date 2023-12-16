<?php

use PHPMailer\PHPMailer\PHPMailer;
use PhpMailer\PhpMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Email/Exception.php';
require 'Email/PHPMailer.php';
require 'Email/SMTP.php';

$mail = new PHPMailer;

// Connection settingai
$mail->isSMTP();
$mail->Host = 'smtp-mail.outlook.com';
$mail->SMTPAuth = true;
$mail->Username = 'vartvald2023@outlook.com';
$mail->Password = 'xwe449#123!@';
$mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

// Siuntejas
$mail->setFrom('vartvald2023@outlook.com', 'vartvald2023');

// Gavejas, pakeist i darbuotoju e-mail
$mail->addAddress('example@gmail.com');


// Antraste
$mail->isHTML(true);
$mail->Subject = 'Email from localhost';

// Zinute
$bodyContent = '<h1>test mail </h1>';
$mail->Body = $bodyContent;

// Print status
if ($mail->send()) {
    echo 'Message sent';
} else {
    echo 'Message sending failed ' . $mail->ErrorInfo;
}
