<?php
include ('connection.php');
session_start ();


if (isset ( $_POST ['submit'] )) {
	$email = $_POST ['email'];
	$password = $_POST ['password'];
	$mobile = $_POST ['mobile'];
	$usertype = $_POST ['select'];
	$error = "";
	$cost = 10;
	$salt = strtr ( base64_encode ( mcrypt_create_iv ( 16, MCRYPT_DEV_URANDOM ) ), '+', '.' );
	$salt = sprintf ( "$2a$%02d$", $cost ) . $salt;
	$hash = crypt ( $password, $salt );
	
	$insert = "INSERT INTO users(email,password,mobile,usertype)
        values('$email','$hash','$mobile')";
	
	if ($connection->query ( $insert ) === TRUE) {
		echo "Sign up successfully please login";
		
		$_SESSION ["message"] = "Sign up successfully please login";
		
		
			header ( 'Location:../index.html' );
		
	} 
	else {
		echo "Error: " . $sql . "<br>" . $connection->error;
		$_SESSION ['error'] = "Error: " . $sql . "<br>" . $connection->error;
		header ( 'Location: ../index.html' );
	}
}
$connection->close ();
?>