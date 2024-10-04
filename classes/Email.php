<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    protected $email;
    protected $nombre;
    protected $token;


    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('valu18carvajal@gmail.com', 'uptask.com');
        $mail->addAddress($this->email, 'uptask.com');
        $mail->Subject = 'Confirma tu Cuenta';

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $contenido = "<!DOCTYPE html>
                <html style='font-family: Open Sans, sans-serif; margin: 0;'>
                <head>
                    <meta charset='UTF-8'>
                </head>
                <body style='margin: 0; padding: 0;'>
                <div style='background: linear-gradient(to right, #0891B2, #2563EB, #4338CA, #7C3AED, #F59E0B, #DB2777);
                width: 100%;
                height: 100px;
                display: flex;
                justify-content: center;
                align-items: center;'>  
                    <h1 style='color: white; margin-top: 30px; width: 100%; text-align: center;'>UpTask</h1>
                </div>
                <p><strong>Hola " . $this->nombre . "</strong>. Has creado tu cuenta en UpTask, solo debes continuar presionando el siguiente enlace:</p>
                <div style='display: flex; justify-content: center;'>
                <a href='". $_ENV['APP_URL'] . "/confirmar?token=" . $this->token . "'
                    style='background-color: #4338CA; padding: 10px; text-decoration: none; color: white; margin: 10px auto 0 auto; border-radius:5px;'>Confirmar Cuenta</a>
                </div>
                <p style='margin-top: 100px;'>Si tú no solicitaste esta cuenta, puedes ignorar el mensaje</p>
                </body>
            </html>";
        $mail->Body = $contenido;

        //Enviar el Email
        $mail->send();

    }

    public function enviarInstrucciones()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('valu18carvajal@gmail.com', 'uptask.com');
        $mail->addAddress($this->email, 'uptask.com');
        $mail->Subject = 'Reestablece tu contraseña de UpTask';

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        


        

        $contenido = "<!DOCTYPE html>
                <html style='font-family: Open Sans, sans-serif; margin: 0;'>
                <head>
                    <meta charset='UTF-8'>
                </head>
                <body style='margin: 0; padding: 0;'>
                <div style='background: linear-gradient(to right, #0891B2, #2563EB, #4338CA, #7C3AED, #F59E0B, #DB2777);
                width: 100%;
                height: 100px;
                display: flex;
                justify-content: center;
                align-items: center;'>  
                    <h1 style='color: white; margin-top: 30px; width: 100%; text-align: center;'>UpTask</h1>
                </div>
                <p><strong>Hola " . $this->nombre . "</strong>. Parece que has olvidado tu contraseña, 
                sigue el siguiente enlace para crear una nueva contraseña:</p>
                <div style='display: flex; justify-content: center;'>
                <a href='". $_ENV['APP_URL'] ."/reestablecer?token=" . $this->token . "'
                    style='background-color: #4338CA; padding: 10px; text-decoration: none; color: white; margin: 10px auto 0 auto; border-radius:5px;'>Confirmar Cuenta</a>
                </div>
                <p style='margin-top: 100px;'>Si tú no lo has solicitado, puedes ignorar el mensaje</p>
                </body>
            </html>";
        $mail->Body = $contenido;

        //Enviar el Email
        $mail->send();

    }
}
