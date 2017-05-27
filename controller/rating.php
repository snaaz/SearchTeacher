<?php 
include ('connection.php');
session_start ();

$teacher_id=$_GET['id'];
echo $teacher_id;
if (isset($_POST['rate']) && !empty($_POST['rate'])) {
	
	
	$id=$_SESSION['id'];
	echo $_POST['rate'];
	$rate = $connection->real_escape_string($_POST['rate']);
	// check if user has already rated
	$sql = "SELECT `id` FROM `rating` WHERE `user_id`='" . $id . "'";
	$result = $connection->query($sql);
	$row = $result->fetch_assoc();
	if ($result->num_rows > 0) {
		echo $row['id'];
	} else {

		$sql = "INSERT INTO `rating` ( `rate`, `user_id`,`teacher_id`) VALUES ('" . $rate . "', '" . $id . "'); ";
		if (mysqli_query($connection, $sql)) {
			echo "0";
		}
	
	}
}
$connection->close();
?>