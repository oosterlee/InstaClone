<?php
include "PHPMailer/PHPMailer.php";
include "PHPMailer/Exception.php";
include "PHPMailer/SMTP.php";
include "PHPMailer/OAuth.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// sendMail("24868@ma-web.nl");
function sendMail($to = "roymcraft@gmail.com", $body = "", $bodyAlt = "", $subj = "") {
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        // echo "sending mail..";

        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'roymcraft@gmail.com';                 // SMTP username
        $mail->Password = base64_decode("Um95T29zdGVybGVlJA==");                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //Recipients
        $mail->setFrom('roymcraft@gmail.com', 'Roy Oosterlee');
        $mail->addAddress($to);
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subj;
        $mail->Body    = $body;
        $mail->AltBody = $bodyAlt;

        $mail->send();
        // echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Please contact the developer.';
        // echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}

?>
