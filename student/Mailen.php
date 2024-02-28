<?php
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

function mailen($mailTo, $ontvangerNaam, $onderwerp, $bericht) {
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPAutoTLS = false;
    $mail->SMTPSecure =
    $mail->Host = 'mail.48891.hbcdeveloper.nl';
    $mail->Port = 587;

    $mail ->Username = 'd48891';
    $mail ->Password = 'cphXJQmGz2FKn7';

    $mail ->isHTML();

    $mail->setFrom("d48891@48891.hbcdeveloper.nl", "Karsten");
    $mail->Subject = $onderwerp;
    $mail->CharSet ='UTF-8';

    $bericht = "<body style=\"font-family: Verdana, Verdana, Geneva, sans-serif; 
                    font-size: 14px; color: #000;\">" . $bericht . "</body>";
    $mail -> addAddress($mailTo, $ontvangerNaam);
    $mail -> Body = $bericht;

    if ($mail->Send()) {
        echo "<script>alert('Mail is verstuurd');</script>";
    }
    else {
        echo 'Mailer Error: '.$mail->ErrorInfo;
        echo "<script>alert('Mail kon niet verstuurden worden...');</script>";
    }
}