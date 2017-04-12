<?php
session_start();
session_unset();
unset($_SESSION['user']['email']);
unset($_SESSION['message']);
unset($_SESSION['error']);
$_SESSION = array();
session_destroy();
header("Location:../index.html");
exit();
?>