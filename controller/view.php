<?php
include ('connection.php');

if (isset ( $_GET ['id'] )) {
	$id = $_GET ['id'];
	$user = mysqli_query ( $connection, "select * FROM `users` WHERE id='" . $id . "'" );
	$row=mysqli_fetch_array($user);
	$pics = mysqli_query ( $connection, "SELECT * FROM profile_pic where user_id='" . $id . "'" );
	$subject_teaches = mysqli_query ( $connection, "select subject_name from user_subjects where user_id = '" . $id . "'" );
	$myString = $row ['teaching_experience'];
	$exp = explode ( '-', $myString );

}
$connection->close ();
?>