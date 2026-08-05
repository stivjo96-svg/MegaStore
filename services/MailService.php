<?php

require_once __DIR__ . '/../vendor/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../vendor/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../vendor/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService
{

    public function enviarFactura($correo,$nombre,$pdf,$codigoPedido)
    {

        $config = require __DIR__ . '/../config/mail.php';

        $mail = new PHPMailer(true);

        try{

            $mail->isSMTP();

            $mail->Host = $config['host'];

            $mail->SMTPAuth = true;

            $mail->Username = $config['username'];

            $mail->Password = $config['password'];

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            $mail->Port = $config['port'];

            $mail->CharSet = 'UTF-8';

            $mail->setFrom(
                $config['from_email'],
                $config['from_name']
            );

            $mail->addAddress($correo,$nombre);

            $mail->Subject = "Factura de compra - MegaFerre";

            $mail->Body =

"Hola $nombre,

Muchas gracias por comprar en MegaFerre.

Su pedido:

$codigoPedido

ha sido registrado correctamente.

Adjuntamos su factura en formato PDF.

Gracias por confiar en nosotros.

Equipo MegaFerre.";

            $mail->addAttachment($pdf);

            $mail->send();

            return true;

        }catch(Exception $e){

            return false;

        }

    }

}