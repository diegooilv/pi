<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    private PHPMailer $mail;

    public function __construct()
    {
        $config = require __DIR__ . '/../config/mail.php';

        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        // 2
        $this->mail->SMTPDebug = 0;
        // $this->mail->Debugoutput = 'echo';
        $this->mail->Host = $config['host'];
        $this->mail->Port = $config['port'];
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $config['username'];
        $this->mail->Password = $config['password'];
        $this->mail->CharSet = 'UTF-8';
        $this->mail->isHTML(true);

        $this->mail->setFrom($config['from_email'], $config['from_name']);
    }

    public function send($to, $subject, $body)
    {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($to);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;

            return $this->mail->send();
        } catch (Exception $e) {
            return false;
        }
    }
}