<?php
include ('connection.php');
session_start ();

if (isset ( $_POST ['reset_password'] )) {
	$new_password = $_POST ['new_password'];
	$confirm_password = $_POST ['confirm_password'];
	$old_password = $_POST['old_password'];
	$id = $_POST ['id'];
	
	$cost = 10;
	$salt = strtr ( base64_encode ( mcrypt_create_iv ( 16, MCRYPT_DEV_URANDOM ) ), '+', '.' );
	$salt = sprintf ( "$2a$%02d$", $cost ) . $salt;
	$hash = crypt ( $confirm_password, $salt );
	if ($new_password == $confirm_password) {
		$reset = mysqli_query ( $connection, "UPDATE users SET  password ='" . $hash . "' WHERE id = '" . $id . "'" );
		if ($reset) {
			$msg = "Successfully Updated!!";
			echo $msg;
			$_SESSION ["message"] = "PASSWORD CHANGED SUECCSESSFULLY";
			header ( "Location:../views/reset_password.html" );
		} else {
			echo "Error: " . $updated . "<br>" . $connection->error;
			$_SESSION ['error'] = "Error: " . $updated . "<br>" . $connection->error;
			header ( 'Location:../views/reset_password.html' );
		}
	} else {
		header ( 'Location:../views/reset_password.html' );
		echo "confirm password must be same";
		$_SESSION ["message"] = "confirm password must be same";
	}
}

$connection->close ();
?>