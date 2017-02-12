<?php
$requireSSL = false;
if ($requireSSL && $_SERVER['SERVER_PORT'] != 443) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit();
}
require_once 'includes/layout.php';
require_once 'includes/functions.php';

if (!empty($_POST['fn']) && !empty($_POST['ln']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    $fn = $_POST['fn'];
    $ln = $_POST['ln'];
    $email = strtolower($_POST['email']);
    $password = $_POST['password'];

    if (R::findOne('user','email = ?',[$email]) != NULL) {
        header("location: login.php");
    } else {
        $id = $oUser->register($fn, $ln, $email, $password);
        if ($id > 0) {
            session_start();
            $_SESSION['authenticated'] = true;
            $_SESSION['uid'] = $id;
            $subject = "Thank you for registering.";
            $body = "<br>You are now activated in our system.  Your login id is: <br>$email<br><br> Click to login at:<br>" . $app['url'] . "<br>" . $app['name'];
            // if ($oEmail->system($email, $subject, $body)) {
                //echo "Successfully sent email to $email.";
            // }
            header("Location: index.php");
        } else {
            header("location: login.php");
        }
    }
} else {
    ?>
    <?php 
    site_header(); 
    body_header($class = 'skin-blue bg-gray', $menu = 0)
    ?>
    <div class="row">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b><?php echo $app['name']; ?></b></a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Register to create your new account.</p>
                <form action="" method="post">
                    <?php
                    $oForm->text($element = 'fn', $value = '', $placeholder = '', $label = 'First Name', $class = '');
                    $oForm->text($element = 'ln', $value = '', $placeholder = '', $label = 'Last Name', $class = '');
                    $oForm->text($element = 'email', $value = '', $placeholder = '', $label = 'Email Address *', $class = '');
                    $oForm->password($element = 'password', $value = '', $placeholder = '', $label = 'Password *', $class = '');
                    ?>
                    <button type="submit" class="btn">Submit</button>
                </form>
                <a href="resetpassword.php">Reset Password</a> | <a href="login.php" class="text-center">Login</a>
            </div>
        </div>
    </div>
    <?php 
    body_footer();
    site_footer();
    ?> 
    <?php
}