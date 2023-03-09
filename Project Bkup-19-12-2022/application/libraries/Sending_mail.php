<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sending_mail {

    public function mail_push($to,$sbj,$msg){
    	// Load PHPMailer library
        $this->load->library('phpmailer_lib');
        
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.example.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'agrigainssl@gmail.com';
        $mail->Password = 'agrigain123';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        
        $mail->setFrom('agrigainssl@gmail.com', 'CodexWorld');
        $mail->addReplyTo('agrigainssl@gmail.com', 'CodexWorld');
        
        // Add a recipient
        $mail->addAddress('mptpman1988@gmail.com');
        
        // Add cc or bcc 
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
        $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
    }
}