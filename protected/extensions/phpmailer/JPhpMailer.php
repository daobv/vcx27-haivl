<?php

/**
 * JPhpMailer class file.
 *
 * @version alpha 2 (2010-6-3 16:42)
 * @author jerry2801 <jerry2801@gmail.com>
 * @required PHPMailer v5.1
 *
 * A typical usage of JPhpMailer is as follows:
 * <pre>
 * Yii::import('ext.phpmailer.JPhpMailer');
 * $mail=new JPhpMailer;
 * $mail->IsSMTP();
 * $mail->Host='smpt.163.com';
 * $mail->SMTPAuth=true;
 * $mail->Username='yourname@yourdomain';
 * $mail->Password='yourpassword';
 * $mail->SetFrom('name@yourdomain.com','First Last');
 * $mail->Subject='PHPMailer Test Subject via smtp, basic with authentication';
 * $mail->AltBody='To view the message, please use an HTML compatible email viewer!';
 * $mail->MsgHTML('<h1>JUST A TEST!</h1>');
 * $mail->AddAddress('whoto@otherdomain.com','John Doe');
 * $mail->Send();
 * </pre>
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'class.phpmailer.php';

class JPhpMailer extends PHPMailer {

    public function sendMailSmtp($from, $to, $namefrom, $nameto, $subject, $content, $type = 0, $addreplyto = '', $reply_name = '') {
        $this->IsSMTP();
		$this->SMTPSecure = 'ssl'; 
        $this->Host = 'smtp.gmail.com';
        $this->Port = 465;
        $this->SMTPAuth = true;
        $this->Username = 'sender@dos.vn';
        $this->Password = 'fdbhbibbonploilc';
        $this->Subject = $subject;
        $this->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        $this->MsgHTML($content);
        $this->AddAddress($to, $nameto);
        if ($type == 1) {
            $this->AddReplyTo($addreplyto, $reply_name);
        }else{
            $this->SetFrom($from, $namefrom);
        }
        //$this->AddBCC($address);
        $this->Send();
    }

}