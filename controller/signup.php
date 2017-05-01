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
	
	$users = mysqli_query ( $connection, "select * from users where email='$email' or mobile='$mobile' " );
	$user = mysqli_fetch_array ( $users );
	
	$email_new = explode ( "@", $email );
	$username = $email_new[0];
	$_SESSION ["username"] = $username;
	//$_SESSION ["id"] = $row["id"];
	
	$rows=mysqli_num_rows($users);


		
	if ($rows> 0) {
		echo "Email/mobile already exist..";
		$_SESSION ["message"] = "Can't Sign Up Email/mobile already exist..";
	   header ( 'Location: ../index.html' );
	
	
	}
		else{
			
		
		$insert = "INSERT INTO users(email,password,mobile,usertype)
        values('$email','$hash','$mobile','$usertype')";
		
		
		
		if ($connection->query ( $insert ) === TRUE) {
			$user = mysqli_query ( $connection, "select * from users where email='$email' limit 1 " );
			$row = mysqli_fetch_array ( $user );
			$_SESSION ["id"] = $row["id"];
			echo "Sign up successfully please login";
			//echo "sesssion";
			//echo $_SESSION ["username"];
			 header ( 'Location: ../views/dashboard.html');
		} 
		else {
			echo "Error: " . $sql . "<br>" . $connection->error;
			$_SESSION ['error'] = "Error: " . $sql . "<br>" . $connection->error;
		header ( 'Location: ../index.html' );
		}
		}

}

$connection->close ();
?>