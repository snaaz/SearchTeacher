<?php
include ('connection.php');

if (isset ($_GET ['user'] )) {
	$encrypted_id = $_GET ['user'];
	$user = mysqli_query ( $connection, "select * FROM `users` WHERE encrypted_id='" . $encrypted_id . "'" );
	$row=mysqli_fetch_array($user);
	$pics = mysqli_query ( $connection, "SELECT * FROM profile_pic where user_id='" . $row['id'] . "'" );
	$subject_teaches = mysqli_query ( $connection, "select subject_name from user_subjects where user_id = '" . $row['id'] . "'" );
	$myString = $row ['teaching_experience'];
	$exp = explode ( '-', $myString );

}
$connection->close ();
?>