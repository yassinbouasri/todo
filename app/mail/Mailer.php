<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {

    /**
     * @throws Exception
     */
    public function sendEmail(string $to, string $subject, string $message): void
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        //$mail->SMTPDebug = 1; // SMTP debugging messages
        $mail->CharSet = 'UTF-8';
        $mail->Host = 'smtp-relay.brevo.com';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Username = '7e4394002@smtp-brevo.com';
        $mail->Password = 'y2TCKYx0gn51Nkh4';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom('yassinbouasri@gmail.com', 'Todo - Tasks Manager');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        //$mail->AltBody = $message;
        try {
            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

    }
}