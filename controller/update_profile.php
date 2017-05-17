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
	$users = mysqli_query ( $connection, "select * FROM `users` WHERE id='" . $id . "'" );
	$row = mysqli_fetch_array ( $users );
	$states = mysqli_query ( $connection, "select * from states order by sname" );
	$user_state = mysqli_query ( $connection, "select * from states where sname='" . $row ["state"] . "'" );
	$state = mysqli_fetch_array ( $user_state );
	$districts = mysqli_query ( $connection, "select * from district where state_id = '" . $state ['id'] . "'" );
	$usersubject_names = mysqli_query ( $connection, "select subject_name from user_subjects where user_id = '" . $id . "'" );
	$subjects = mysqli_query ( $connection, "select * from subjects" );
	$class = mysqli_query ( $connection, "select * from class" );
	$pics = mysqli_query ( $connection, "SELECT * FROM profile_pic where user_id='" . $id . "'" );
	
	$res = array ();
	while ( $sub = mysqli_fetch_array ( $usersubject_names ) ) {
		$res [] = $sub ['subject_name'];
	}
	
	$myString = $row ['teaching_experience'];
	$exp = explode ( '-', $myString );
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
	$subject = $_POST ['sub'];
	$class = $_POST ['class'];
	$id = $_POST ['id'];
	$years = $_POST ['years'];
	$months = $_POST ['months'];
	$experience = $years . '-' . $months;
	
	// echo $subject;
	$string = explode ( ',', $subject );
	$count = count ( $string );
	// echo $string[2];
	
	$users = mysqli_query ( $connection, "select * from users where id != '$id' and (email='$email' or mobile='$mobile')   " );
	$rows = mysqli_num_rows ( $users );
	
	// Get the state name from state id.................//
	
	$states1 = mysqli_query ( $connection, "select * from states where id='$state'" );
	$states_name = mysqli_fetch_array ( $states1 );
	$state_name = $states_name ['sname'];
	
	// Get the district name from district id............//
	
	$district1 = mysqli_query ( $connection, "select * from district where id='$district'" );
	$districts_name = mysqli_fetch_array ( $district1 );
	$district_name = $districts_name ['dname'];
	
	mysqli_autocommit ( $connection, FALSE );
	
	// Validate email and mobile.........//
	
	if ($rows > 0) {
		echo "Email/mobile already exist..";
		$_SESSION ["message"] = "Can't Update Email/mobile already exist..";
		header ( "Location: ../views/update_profile.html?id=" . $id );
	} else {
		
		$user_update = mysqli_query ( $connection, "UPDATE users SET  name ='" . $name . "', email ='" . $email . "', 
			mobile='" . $mobile . "', dob='" . $dob . "',  state='" . $state_name . "',district='" . $district_name . "',city='" . $city . "',
			locality='" . $locality . "',pincode='" . $pincode . "',qualification='" . $qualification . "',yearofpassing='" . $yearofpassing . "',
			university='" . $university . "',class='" . $class . "',teaching_experience='" . $experience . "' WHERE id = '" . $id . "'" );
		
		if (! $user_update) {
			$error1 = mysqli_error ( $connection );
			$error1 = explode ( ";", $error1, 3 );
			$error1 = array_values ( $error1 ) [0];
		}
	}
	$user_subjects = mysqli_query ( $connection, "select * from user_subjects where user_id='" . $id . "'" );
	$user_subject = mysqli_fetch_array ( $user_subjects );
	
	if (! empty ( $subject )) {
		if (count ( $user_subject ) > 0) {
			$delete_subject = mysqli_query ( $connection, "delete from user_subjects where user_id='" . $id . "'" );
		}
		
		for($i = 0; $i < $count; $i ++) {
			$insert_subject = mysqli_query ( $connection, "INSERT INTO user_subjects(subject_name,user_id) 
				VALUES('$string[$i]','$id')" );
		}
		if (! $insert_subject) {
			$error3 = mysqli_error ( $connection );
			$error3 = explode ( ";", $error3, 3 );
			$error3 = array_values ( $error3 ) [0];
		}
	}
	
	$pic_type = array (
			"gif",
			"GIF",
			"JPEG",
			"jpeg",
			"jpg",
			"JPG" 
	);
	if (($_FILES ['file'] ['size'] > 0)) {
		$file_name = rand ( 1000, 100000 ) . "-" . $_FILES ['file'] ['name'];
		$file_loc = $_FILES ['file'] ['tmp_name'];
		$file_type = $_FILES ['file'] ['type'];
		$folder = "../public/photos/";
		
		$file_type1 = substr ( $file_type, 6 );
		// echo $file_type1;
		if (in_array ( $file_type1, $pic_type )) {
			
			move_uploaded_file ( $file_loc, $folder . $file_name );
			$image = mysqli_query ( $connection, "select * FROM `profile_pic` WHERE user_id='" . $id . "'" );
			$img = mysqli_fetch_array ( $image );
			
			if ($img ['id']) {
				$upload = mysqli_query ( $connection, "UPDATE profile_pic set profile_pic='" . $file_name . "',user_id='" . $id . "' WHERE user_id = '" . $id . "'" );
				
				if (! $upload) {
					$error4 = mysqli_error ( $connection );
					$error4 = explode ( ";", $error4, 3 );
					$error4 = array_values ( $error4 ) [0];
				}
			} else {
				
				$upload = mysqli_query ( $connection, "INSERT INTO profile_pic(profile_pic,user_id) VALUES('$file_name','$id')" );
				
				if (! $upload) {
					$error5 = mysqli_error ( $connection );
					$error5 = explode ( ";", $error5, 3 );
					$error5 = array_values ( $error5 ) [0];
				}
			}
		} else {
			$_SESSION ['message'] = "Profile image can't uploaded.Check files";
			 header("location:../views/update_profile.html?id=".$id);
		}
	}
	
	if ($error1 || $error2 || $error3 || $error4 || $error5) {
		
		$_SESSION ['error'] = $error1 . $error2 . $error3 . $error4 . $error5;
		 header("location:../views/update_profile.html?id=".$id);
	} 

	else {
		$msg = "Successfully Updated";
		$email_new = explode ( "@", $email );
		$username = $email_new [0];
		$_SESSION ["username"] = $username;
		$_SESSION ["message"] = "RECORD UPDATED SUCCSESSFULLY";
		mysqli_commit ( $connection );
	 header ( "Location: ../views/update_profile.html?id=".$id );
	}
}


$connection->close ();
?>