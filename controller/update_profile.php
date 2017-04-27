<?php
include ('connection.php');
session_start ();
$error1 = null;
$error2 = null;
$error3 = null;
$error4 = null;
$error5 = null;

if (isset ( $_GET ['id'] )) {
	$id = $_GET ['id'];
	$users = mysqli_query ( $connection, "select * FROM `users` WHERE id='" . $id . "' " );
	$states = mysqli_query ( $connection, "select * from states" );
	$districts = mysqli_query ( $connection, "select * from district" );
	$user_subjects = mysqli_query ( $connection, "select * from user_subjects where user_id = '" . $id . "'" );
	$subjects = mysqli_query ( $connection, "select * from subjects" );
	$class = mysqli_query ( $connection, "select * from class" );
	$pics = mysqli_query ( $connection, "SELECT * FROM profile_pic where user_id='" . $id . "'" );
}

if (isset ( $_POST ['update'] )) {
	$name = $_POST ['name'];
	$email = $_POST ['email'];
	$mobile = $_POST ['mobile'];
	$dob = $_POST ['dob'];
	$state = $_POST ['state'];
	$district = $_POST ['district'];
	$city = $_POST ['city'];
	$locality = $_POST ['locality'];
	$pincode = $_POST ['pincode'];
	$qualification = $_POST ['qualification'];
	$yearofpassing = $_POST ['year-of-passing'];
	$university = $_POST ['university'];
	$subject = $_POST ['subject'];
	$class = $_POST ['class'];
	$id = $_POST ['id'];
	
	$user_update = mysqli_query ( $connection, "UPDATE users SET  name ='" . $name . "', email ='" . $email . "', 
			mobile='" . $mobile . "', dob='" . $dob . "',  state='" . $state . "',district='" . $district . "',city='" . $city . "',
			locality='" . $locality . "',pincode='" . $pincode . "',qualification='" . $qualification . "',yearofpassing='" . $yearofpassing . "',
			university='" . $university . "',class='" . $class . "' WHERE id = '" . $id . "'" );
	
	if (! $user_update) {
		$error1 = mysqli_error ( $connection );
		$error1 = explode ( ";", $error1, 3 );
		$error1 = array_values ( $error1 ) [0];
	}
	
	$user_subjects = mysqli_query ( $connection, "select * from user_subjects where user_id='" . $id . "'" );
	$user_subject = mysqli_fetch_array ( $user_subjects );
	
	if ($user_subject ['id']) {
		
		$update_subject = mysqli_query ( $connection, "UPDATE user_subjects set subject_name='" . $subject . "'
		 WHERE user_id='" . $id . "'" );
		
		if (! $update_subject) {
			$error2 = mysqli_error ( $connection );
			$error2 = explode ( ";", $error2, 3 );
			$error2 = array_values ( $error2 ) [0];
		}
	} else {
		$insert_subject = mysqli_query ( $connection, "INSERT INTO user_subjects(subject_name,user_id) 
				VALUES('$subject','$id')" );
		if (! $insert_subject) {
			$error3 = mysqli_error ( $connection );
			$error3 = explode ( ";", $error3, 3 );
			$error3 = array_values ( $error3 ) [0];
		}
	}
	
	if ($_FILES ['file'] ['size'] > 0) {
		$file_name = rand ( 1000, 100000 ) . "-" . $_FILES ['file'] ['name'];
		$file_loc = $_FILES ['file'] ['tmp_name'];
		$file_type = $_FILES ['file'] ['type'];
		$folder = "../public/photos/";
		echo $file_name;
		echo $file_loc;
		echo $folder;
		
		move_uploaded_file ( $file_loc, $folder . $file_name );
		$image = mysqli_query ( $connection, "select * FROM `profile_pic` WHERE user_id='" . $id . "'" );
		$img = mysqli_fetch_array ( $image );
		
		echo $img ['id'];
		if ($img ['id']) {
			$upload = mysqli_query ( $connection, "UPDATE profile_pic set profile_pic='" . $file_name . "',user_id='" . $id . "' WHERE user_id = '" . $id . "'" );
			echo "kk";
			if (! $upload) {
				$error4 = mysqli_error ( $connection );
				$error4 = explode ( ";", $error4, 3 );
				$error4 = array_values ( $error4 ) [0];
			}
		} else {
			
			$upload = mysqli_query ( $connection, "INSERT INTO profile_pic(profile_pic,user_id) VALUES('$file_name','$id')" );
			echo "jj";
			if (! $upload) {
				$error5 = mysqli_error ( $connection );
				$error5 = explode ( ";", $error5, 3 );
				$error5 = array_values ( $error5 ) [0];
			}
		}
	}
	
	if ($error1 || $error2 || $error3) {
		
		$_SESSION ['error'] = $error1 . $error2 . $error3;
		// header("location:../views/update_profile.html");
	} 

	else {
		$msg = "Successfully Updated";
		$result = mysqli_query ( $connection, "select * FROM `users` WHERE email='$email' limit 1" );
		
		$row = mysqli_fetch_array ( $result );
		$email_new = explode ( "@", $email );
		$username = $email_new [0];
		$_SESSION ["username"] = $username;
		$_SESSION ["message"] = "RECORD UPDATED SUCCSESSFULLY";
		// header ( "location:../views/dashboard.html" );
	}
}
$connection->close ();
?>