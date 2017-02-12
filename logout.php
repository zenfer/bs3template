<?php
require_once 'includes/functions.php';
$oUser->logout();
session_start();
session_unset();
session_destroy();
Header('Location: index.php');
