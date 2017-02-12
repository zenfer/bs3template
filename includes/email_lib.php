<?php

//require_once 'includes/db_lib.php';

//$oEmail->system($to = '', $subject = '', $message = '');

class obj_email {


    public function user($to, $sender_id, $subject, $message) {
        global $oDB;
        $user = $oDB->select1r("select * from email_sender where email_sender_id = $sender_id");
        if (count($user) > 0) {
            require_once 'PHPMailer/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = $user['email_sender_host'];
            $mail->SMTPAuth = true;
            $mail->Username = $user['email_sender_name'];
            $mail->Password = $user['email_sender_password'];
            $mail->SMTPSecure = $user['email_sender_smtpsecure'];
            $mail->Port = $user['email_sender_port'];
            $mail->From = $user['email_sender_from_email'];
            $mail->FromName = $user['email_sender_from_name'];
            $mail->addAddress($to['email'], $to['name']);
            $mail->addBCC('vgupta@picobags.com');
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;
            if ($mail->send()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function system($to, $subject, $message) {
        require_once 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'mf5.websitewelcome.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'support@lootapps.com';
        $mail->Password = 'lUEvum6ZqkBY';
//        $mail->Username = 'hi@sellermela.com';
//        $mail->Password = 'H1nduM@n';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->From = 'support@lootapps.com';
        $mail->FromName = $app['name'];
        $mail->addAddress($to);
        //$mail->addBCC('vgupta@picobags.com');

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        if ($mail->send()) {
            sleep(1);
            return true;
        } else {
            return false;
        }
    }

    public function send_using_mailgun($to, $subject, $message) {
        require_once 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.mailgun.org';
        $mail->SMTPAuth = true;
        $mail->Username = 'hi@lootapps.com';
        $mail->Password = 'J7w9hiSnnymE';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->From = 'hi@lootapps.com';
        $mail->FromName = 'Loot Apps';
        $mail->addAddress($to);
        $mail->addBCC('vgupta@picobags.com');

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        if ($mail->send()) {
            sleep(1);
            return true;
        } else {
            return false;
        }
    }

}

global $oEmail;
$oEmail = new obj_email;
