<?php
include ('connection.php');
session_start ();



if (isset ( $_POST ['reset_password'] )) {
	$new_password = $_POST ['new_password'];
	$confirm_password = $_POST ['confirm_password'];
	$id = $_POST ['encrypt'];

	$cost = 10;
	$salt = strtr ( base64_encode ( mcrypt_create_iv ( 16, MCRYPT_DEV_URANDOM ) ), '+', '.' );
	$salt = sprintf ( "$2a$%02d$", $cost ) . $salt;
	$hash = crypt ( $confirm_password, $salt );
	
		if ($new_password == $confirm_password) {
			$reset = mysqli_query ( $connection, "UPDATE users SET  password ='" . $hash . "' WHERE encrypt_id = '" . $id . "'" );
		$reset2 = mysqli_query ( $connection, "update users set encrypt_id=null" );
		if ($reset) {
			echo $msg = "Successfully Updated!!";
			$_SESSION ["message"] = "PASSWORD CHANGE SUECCSESSFULLY";
		//	header ( 'Location:../controller/views/reset_password-1.html?encrypt=' . $id . '&action=reset' );
		    header('location:../index.html');
		} 

		else {
			echo "Error: " . $reset . "<br>" . $connection->error;
			$_SESSION ['error'] = "Error: " . $reset . "<br>" . $connection->error;
			header ( 'Location:../controller/views/reset_password-1.html?encrypt=' . $id . '&action=reset' );
		}
	} 	
	else {
		header ( 'Location:http://localhost.myapps/SearchTeacher/views/reset_password-1.html?encrypt=' . $id . '&action=reset' );
		echo "confirm password must be same";
		$_SESSION ["message"] = "confirm password must be same";
	}
}

?>