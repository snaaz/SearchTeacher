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
	
	
	$encrypt=$email.$mobile;

//	$encrypted_id1 = hash("SHA256", $encrypt);

	//$encrypted_id = md5 ( 1290 * 3 + $encrypt );
	$encrypted_id = hash("md5", $encrypt);
	
	
//	mysqli_autocommit ( $connection, FALSE );
	
	$users = mysqli_query ( $connection, "select * from users where email='$email' or mobile='$mobile' " );
	$user = mysqli_fetch_array ( $users );
	
	$email_new = explode ( "@", $email );
	$username = $email_new [0];
	$_SESSION ["username"] = $username;
	$_SESSION ["usertype"] = $usertype;
	// $_SESSION ["id"] = $row["id"];
	
	$no_of_users = mysqli_num_rows ( $users );
	
	if ($no_of_users > 0) {

	
		if ($user ['active']==0) {
			$update = mysqli_query ( $connection, "update users set active=1 where email='$email' or mobile='$mobile' " );
			$select = mysqli_query($connection, "select * from users where email= '$email' and active= 1");
			$row = mysqli_fetch_array ( $select );
			$id = $row ['id'];
			$encrypted_id=$row['encrypted_id'];
			$_SESSION['encrypted_id']=$row ["encrypted_id"];
			$_SESSION ["id"] = $row ["id"];
			header ( "location:../views/profile.html?user=" .$encrypted_id );
			
			
		} else {
			
			echo "Email/mobile already exist. Please Login";
			$_SESSION ["message"] = "Can't Sign Up Email/mobile already exist. Please Login";
			header ( 'Location: ../index.html' );
		}
	} else {
		
		$insert = "INSERT INTO users(encrypted_id,email,password,mobile,usertype)
        values('$encrypted_id','$email','$hash','$mobile','$usertype')";
		
		if ($connection->query ( $insert ) === TRUE) {
			$user = mysqli_query ( $connection, "select * from users where email='$email' limit 1 " );
			$row = mysqli_fetch_array ( $user );
			$_SESSION ["id"] = $row ["id"];
			$id = $row ['id'];
			$encrypted_id=$row['encrypted_id'];
			$_SESSION['encrypted_id']=$row ["encrypted_id"];
			//echo $_SESSION['encrypted_id'];
			echo "Sign up successfully please login";
			header ( "location:../views/profile.html?user=".$encrypted_id );
		} else {
			echo "Error: " . $sql . "<br>" . $connection->error;
			$_SESSION ['error'] = "Error: " . $sql . "<br>" . $connection->error;
			header ( 'Location: ../index.html' );
		}
	}
}

$connection->close ();
?>