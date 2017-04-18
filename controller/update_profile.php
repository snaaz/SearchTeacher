<?php
include ('db.php');
session_start ();
$error_update = null;
$error_upload = null;
$error_insert = null;

if (isset ( $_GET ['id'] )) {
	$id = $_GET ['id'];
}
$id=$_SESSION['user']['id'];
$result_set=mysqli_query($connection,"SELECT * FROM files where user_id='".$id."' and profile_pic=1");
$states = mysqli_query ( $connection, "select * FROM `states` WHERE 1" );

if (isset ( $_POST ['update'] )) {
	$Fname_save = $_POST ['firstname'];
	$Last_save = $_POST ['lastname'];
	$email_save = $_POST ['email'];
	$Phn_save = $_POST ['phone'];
	$Addr_save = $_POST ['address'];
	$city_save = $_POST ['city'];
	$state_save = $_POST ['state'];
	$id = $_POST ['id'];
	
	$updated = mysqli_query ( $connection, "UPDATE users SET  firstname ='" . $Fname_save . "', lastname ='" . $Last_save . "',
		 email ='" . $email_save . "', phone='" . $Phn_save . "', address='" . $Addr_save . "', city='" . $city_save . "', state='" . $state_save . "' WHERE id = '" . $id . "'" );
	
	if (! $updated) {
		$error_update = mysqli_error ( $connection );
		$error_update = explode ( ";", $error_update, 3 );
		$error_update = array_values ( $error_update ) [0];
	}
	
	if ($_FILES ['file'] ['size'] > 0) {
		$file_name = rand ( 1000, 100000 ) . "-" . $_FILES ['file'] ['name'];
		$file_loc = $_FILES ['file'] ['tmp_name'];
		$file_type = $_FILES ['file'] ['type'];
		$folder = "uploads/";
		$id = $_SESSION ['user'] ['id'];
		
		move_uploaded_file ( $file_loc, $folder . $file_name );
		$image = mysqli_query ( $connection, "select * FROM `files` WHERE user_id='" . $id . "' and profile_pic=1" );
		$img = mysqli_fetch_array ( $image );
		
		if ($img ['id']) {
			$upload = mysqli_query ( $connection, "UPDATE files set file='" . $file_name . "',file_type='" . $file_type . "',user_id='" . $id . "',profile_pic=1 WHERE id = '" . $img ['id'] . "'" );
			if (! $upload) {
				$error_upload = mysqli_error ( $connection );
				$error_upload = explode ( ";", $error_upload, 3 );
				$error_upload = array_values ( $error_upload ) [0];
			}
		} else {
			$upload = mysqli_query ( $connection, "INSERT INTO files(file,file_type,user_id,profile_pic) VALUES('$file_name','$file_type','$id',1)" );
			if (! $upload) {
				$error_insert = mysqli_error ( $connection );
				$error_insert = explode ( ";", $error_insert, 3 );
				$error_insert = array_values ( $error_insert ) [0];
			}
		}
	}
	
	if ($error_update || $error_upload || $error_insert) {
		
		$_SESSION ['error'] = $error_update . $error_upload . $error_insert;
		header ( "Location:profile.html" );
	} 

	else {
		$msg = "Successfully Updated";
		$result = mysqli_query ( $connection, "select * from users where id = '" . $id . "' limit 1" );
		$updated_user = mysqli_fetch_array ( $result );
		$_SESSION ['user'] = $updated_user;
		$_SESSION ["message"] = "RECORD UPDATED SUCCSESSFULLY";
		header ( "Location:profile.html" );
	}
}
$connection->close();
?>