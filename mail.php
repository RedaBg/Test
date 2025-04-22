<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$action = intval($_GET['action']);
$username = ($_GET['user']);
$email = ($_GET['mail']);

if($action == 1) {
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                   
            $mail->SMTPAuth   = true;                                  
            $mail->Username   = 'service2ticketing@gmail.com';         
            $mail->Password   = 'ugyf gygb fyxv hmlb';                
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
            $mail->Port       = 465;                                   

            // Recipients
            $mail->setFrom('service2ticketing@gmail.com', 'Ticketing');
            $mail->addAddress('narthexgives2@gmail.com');    
            $mail->addAddress('loanbrunet13@gmail.com');    
            $mail->addAddress($email); 

            // Content
            $mail->isHTML(true);                                 
            $mail->Subject = ucfirst($username). ', votre ticket a ete pris en compte';

            // HTML Email Body
            $mail->Body = '<html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #ecf0f1;
                        color: #333;
                        margin: 0;
                        padding: 0;
                    }
                    .email-container {
                        max-width: 600px;
                        margin: 20px auto;
                        background: #ffffff;
                        border: 1px solid #dddddd;
                        border-radius: 8px;
                        overflow: hidden;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    }
                    .email-header {
                        background: #1abc9c;
                        color: #ffffff;
                        padding: 20px;
                        text-align: center;
                    }
                    .email-header h1 {
                        margin: 0;
                        font-size: 24px;
                    }
                    .email-body {
                        padding: 20px;
                        line-height: 1.6;
                        color: #000000;
                    }
                    .email-footer {
                        background: #1abc9c;
                        text-align: center;
                        padding: 10px;
                        font-size: 12px;
                        color: #ffffff;
                    }
                    .button {
                        display: inline-block;
                        padding: 10px 20px;
                        margin-top: 10px;
                        color: #ffffff;
                        background-color: #1abc9c;
                        text-decoration: none;
                        border-radius: 5px;
                    }
                    .button:hover {
                        background-color: #16a085;
                    }
                </style>
            </head>
            <body>
                <div class="email-container">
                    <div class="email-header">
                        <h1>Confirmation de votre ticket</h1>
                    </div>
                    <div class="email-body">
                        <p>Bonjour, ' .$username. '</p>
                        <p>Votre ticket a bien été pris en compte. Nous vous remercions pour votre confiance.</p>
                        <p>Nous reviendrons vers vous dans les plus brefs délais avec une solution adaptée à votre demande.</p>
                        <p>Cordialement,<br>L\'équipe Ticketing</p>
                        <a href="http://localhost/Projet%20Narelloche/Membres/membre.php" class="button">Voir mon ticket</a>
                    </div>
                    <div class="email-footer">
                        <p>&copy; 2025 Ticketing Service. Tous droits réservés.</p>
                    </div>
                </div>
            </body>
        </html>';

            $mail->AltBody = "Bonjour,\n\nVotre ticket a bien été pris en compte. Nous vous remercions pour votre confiance.\n\nNous reviendrons vers vous dans les plus brefs délais avec une solution adaptée à votre demande.\n\nCordialement,\nL'équipe Ticketing\n\nhttps://www.votre-service-ticketing.com";

            $mail->send();
            header('Location: Membres/membre.php');
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }



if($action == 2) {

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                   
            $mail->SMTPAuth   = true;                                  
            $mail->Username   = 'service2ticketing@gmail.com';         
            $mail->Password   = 'ugyf gygb fyxv hmlb';                
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
            $mail->Port       = 465;                                   

            // Recipients
            $mail->setFrom('service2ticketing@gmail.com', 'Ticketing');
            $mail->addAddress('narthexgives2@gmail.com');    
            $mail->addAddress('loanbrunet13@gmail.com');    

            // Content
            $mail->isHTML(true);                                 
            $mail->Subject = ucfirst($username). ', votre compte a bien ete cree';

            // HTML Email Body
            $mail->Body = '<html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #ecf0f1;
                        color: #333;
                        margin: 0;
                        padding: 0;
                    }
                    .email-container {
                        max-width: 600px;
                        margin: 20px auto;
                        background: #ffffff;
                        border: 1px solid #dddddd;
                        border-radius: 8px;
                        overflow: hidden;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    }
                    .email-header {
                        background: #1abc9c;
                        color: #ffffff;
                        padding: 20px;
                        text-align: center;
                    }
                    .email-header h1 {
                        margin: 0;
                        font-size: 24px;
                    }
                    .email-body {
                        padding: 20px;
                        line-height: 1.6;
                        color: #000000;
                    }
                    .email-footer {
                        background: #1abc9c;
                        text-align: center;
                        padding: 10px;
                        font-size: 12px;
                        color: #ffffff;
                    }
                    .button {
                        display: inline-block;
                        padding: 10px 20px;
                        margin-top: 10px;
                        color: #ffffff;
                        background-color: #1abc9c;
                        text-decoration: none;
                        border-radius: 5px;
                    }
                    .button:hover {
                        background-color: #16a085;
                    }
                </style>
            </head>
            <body>
                <div class="email-container">
                    <div class="email-header">
                        <h1>Confirmation de la création de votre compte</h1>
                    </div>
                    <div class="email-body">
                        <p>Bonjour, ' .$username. '</p>
                        <p>Votre compte a bien été crée. Nous vous remercions pour votre confiance.</p>
                        <p>Cordialement,<br>L\'équipe Ticketing</p>
                        <a href="http://localhost/Projet%20Narelloche/login.php" class="button">Consulter le site</a>
                    </div>
                    <div class="email-footer">
                        <p>&copy; 2025 Ticketing Service. Tous droits réservés.</p>
                    </div>
                </div>
            </body>
        </html>';

            $mail->AltBody = "Bonjour,\n\nVotre ticket a bien été pris en compte. Nous vous remercions pour votre confiance.\n\nNous reviendrons vers vous dans les plus brefs délais avec une solution adaptée à votre demande.\n\nCordialement,\nL'équipe Ticketing\n\nhttps://www.votre-service-ticketing.com";

            $mail->send();
            header('Location: login.php');
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }