<?php
require_once 'phpmailer/phpmailer/PHPMailerAutoload.php';

class MailClient{
    private $email_host = "server07.hostingraja.in";
    private $email_uname = "rarora@chalkuchkartehai.in";
    private $email_pwd = "infy@New9";
    private $email_port = 465;
    private $email_secure = "ssl";
    public function sendemail($to=NULL,$subject=NULL,$message=NULL)
    {
        $success = FALSE;
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = $this->email_secure; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = $this->email_host;
        $mail->Port = $this->email_port; // or 587
        $mail->IsHTML(true);
        $mail->Username = $this->email_uname;
        $mail->Password = $this->email_pwd;
        $mail->SetFrom($this->email_uname);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AddAddress($to);
        if(!$mail->Send()) {
           echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $success = TRUE;
        }  
        return $success;
    }

}
class MailClientFactory{
    public static function getMailClient(){
        return new MailClient();
    }
}

?>