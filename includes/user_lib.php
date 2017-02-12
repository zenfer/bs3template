<?php

require_once 'includes/functions.php';

class user_object {

    public function login($useremail = null, $userpassword = null) {

        if ($useremail == null || $userpassword == null) {
            return false;
        } else {
            $useremail = strtolower($useremail);
            $plain_text_password = $userpassword;
            $user = R::findOne('user','email = ?',[$useremail]);
            if ($user == NULL) {

            } else {
                $new_useremail = $user->email;
                $new_userpassword = $user->password;
                //echo $new_useremail . " - " . $new_userpassword . "<br>";
                //echo crypt($plain_text_password, $new_userpassword);
                //exit;
                $loglogin = R::dispense('loglogin');
                $loglogin->email = $useremail;
                $loglogin->date = date("Y-m-d H:i:s");
                if (($useremail == $new_useremail) && (crypt($plain_text_password, $new_userpassword) == $new_userpassword)) {
                    session_start();
                    $_SESSION["authenticated"] = 'true';
                    $_SESSION["uid"] = $user->id;
                    $loglogin->status = "Success";
                    $id = R::store($loglogin);
                    return true;
                } else {
                    session_start();
                    $_SESSION["authenticated"] = 'false';
                    $loglogin->status = "Failed";
                    $id = R::store($loglogin);
                    return false;
                }

            }
        }
    }

    public function logout() {
        $loglogin = R::dispense('loglogin');
        $user = R::findOne('user', $_SESSION['dashuid']);
        $loglogin->email = $user->email;
        $loglogin->date = date("Y-m-d H:i:s");
        $loglogin->status = "Logout";
        $id = R::store($loglogin);
    }

    public function reset_password($useremail) {
        global $app, $oDB, $oEmail;
        $useremail = strtolower($useremail);
        $r_row = $oDB->select1r("select * from user where email = '$useremail'");
        $username = $rand_char = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 10)), 0, 10);
        $password = crypt($rand_char, '$2a$08$' . substr(hash('whirlpool', microtime()), rand(0, 105), 22));

        //$message = $oEmail->create_email_header($r_row['reviewer_id']);
        $message .= "<br>Please note your email and new password to login are below.<br><br>";
        $message .= "email: $useremail<br>password: $rand_char<br><br>";
        //$message .= $oEmail->create_email_footer($r_row['reviewer_id']);
        //$message .= "Regards,<br>Support Team.<br><br>234 Golf Course Extension Road,<br>Terapalli, Mumbai,<br>INDIA<br><br>";
        //$message .= "http://www.lootapps.com/ohr/";
        $subject = $app['name'] . " - Your activation and account details!";
        $to['name'] = $r_row['user_firstname'];
        $to['email'] = $useremail;
        $from['name'] = $app['email_name'];
        $from['email'] = $app['email_from'];
        //$oEmail->send_with_mandrill($to, $from, $subject, $message);

        $id = R::findOne('user', ' email = ? ', [ '$useremail']);
        if ($id == NULL) {
            echo "id not found in reset-password";
            exit;
        } else {
            $user = R::load('user', $id);
            $user->password = $password;
            R::store($user);
            return true;
        }
    }

    public function register($fn = '', $ln = '', $email = '', $password = '', $plan = 1) {
        if ($fn != '' && $ln != '' && $email != '') {
            $user = R::dispense('user');
            $user->firstname = $fn;
            $user->lastname = $ln;
            $user->email = $email;
            $user->guid = create_guid();
            $user->password = crypt($password, '$2a$08$' . substr(hash('whirlpool', microtime()), rand(0, 105), 22));
            $user->plan = $plan;
            $id = R::store($user);
            if ($id > 0) {
                //$this->reset_password($email);
                //$oEmail->send_using_system('vgupta@picobags.com', 'RSS Mela - Merchant Signup', $email . ' has signed up for merchant account.');
                return $id;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function plan($user_id = 0) {
        if ($user_id == 0 || $user_id == null || $user_id == '') {
            return 0;
        } else {
            global $oDB;
            $result = select1f("user_plan", "select * from users where user_id = $user_id");
            return $result;
        }
    }

}

global $oUser;
$oUser = new user_object;
