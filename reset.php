<?php
$requireSSL = false;
if ($requireSSL && $_SERVER['SERVER_PORT'] != 443) {
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
	exit();
}
require_once 'includes/functions.php';

if (isset($_GET['e']) && isset($_GET['i'])){
	//check if i exists
	$guid = $_GET['i'];
	$user = R::findOne('user','guid = ?', [$guid]);
	if ($user == NULL){
		echo "User not found";
	} else {
		echo 'User Found';
	}
	
}



if (0) {
	if ($oUser->reset($_POST["email"])) {
		header('Location: index.php');
	} else {
        //echo "oUser returned false <br>";
		header('Location: login.php');
	}
} else {
	require_once 'includes/layout.php';
	site_header(); 
	body_header($class= 'skin-blue bg-gray', $menu = 0);
	?>
	<div class="row">
		<div class="login-box">
			<div class="login-logo">
				<a href="<?php echo $app['url']; ?>"><b><?php echo $app['name']; ?></b></a>
			</div><!-- /.login-logo -->
			<div class="login-box-body">
				<p class="login-box-msg">Login in to start your session</p>
				<form action="" method="post">
					<?php
					$oForm->text($element = 'email', $value = '', $placeholder = '', $label = 'Email', $class = '', $required = true);
					$oForm->password($element = 'password', $value = '', $placeholder = '', $label = 'Password', $class = '', $required = true);
					$oForm->submit();
					?>
				</form>
				<a href="resetpassword.php">Reset password</a> | <a href="register.php" class="text-center">Register</a>
			</div>
		</div>
	</div>
	<?php 
	body_footer();
	site_footer();
}