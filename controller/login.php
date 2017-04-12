<?php
include ('connection.php');
session_start ();

$email = $_POST ['email'];
$userpass = $_POST ['password'];

$result = mysqli_query ( $connection, "select * FROM `users` WHERE email='$email' limit 1" );

$row = mysqli_fetch_array ( $result );

$email_new = explode ( "@", $email );
$username = $email_new [0];
$_SESSION ["username"] = $username;
$_SESSION ['user'] = $row;

$hash = hash_equals ( $row ['password'], crypt ( $userpass, $row ['password'] ) );
if ($hash) {
	echo "logged in  ";
	header ( "Location: ../views/dashboard.html" );
} 

else {
	if (! $hash) {
		$_SESSION ['message'] = "Wrong Email or Password";
		header ( "location:../index.html" );
	}
}
?>