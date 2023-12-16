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
$mail->Host = 'smtp-mail.outlook.com'; // Max 300 žinučių per dieną, max 100 skirtingų gavėjų
$mail->SMTPAuth = true;
$mail->Username = 'vartvald2023@outlook.com'; // outlooko username
$mail->Password = 'xwe449#123!@';   // acc pass
$mail->Port = 587;  // šitas visada same
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // outlookui tls

// Siuntėjas
$mail->setFrom('vartvald2023@outlook.com', 'vartvald2023');

// Gavėjas, pakeist į darbuotojų ar savo testinį paštą, bus spam folderi
$mail->addAddress('example@gmail.com');

// Antraštė
$mail->isHTML(true);
$mail->Subject = 'Email from localhost';

// Žinutė
$bodyContent = '<h1>test mail </h1>';
$mail->Body = $bodyContent;

// Print status
if ($mail->send()) {
    echo 'Message sent';
} else {
    echo 'Message sending failed ' . $mail->ErrorInfo;
}
