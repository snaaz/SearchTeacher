<?php 
include ('connection.php');
session_start ();



if (isset($_POST['rate']) && !empty($_POST['rate'])) {
	
	
	$teacher_id= $_POST['id'];
	$id= $_SESSION['id'];
	$rate = $connection->real_escape_string($_POST['rate']);
	// check if user has already rated
	$sql = "SELECT `id` FROM `rating` WHERE `user_id`='" . $id . "' and teacher_id='" . $teacher_id . "' ";
	$result = $connection->query($sql);
	$row = $result->fetch_assoc();
	echo $result->num_rows;
	if ($result->num_rows > 0) {
	 $sql ="update rating set rate='".$rate."' where user_id='" . $id . "' and teacher_id='" . $teacher_id . "'"  ;
	 if (mysqli_query($connection, $sql)) {
	 	echo "update";
	 }
	} else {

		$sql = "INSERT INTO `rating` ( `rate`, `user_id`,`teacher_id`) VALUES ('" . $rate . "', '" . $id . "','".$teacher_id."'); ";
		if (mysqli_query($connection, $sql)) {
			echo "insert";
		}
	
	}
}
$connection->close();
?>