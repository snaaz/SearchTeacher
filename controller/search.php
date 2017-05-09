<?php
include ('connection.php');

if (isset ( $_GET ['id'] )) {
	$id = $_GET ['id'];
	$users = mysqli_query ( $connection, "select * FROM `users` WHERE usertype= 'teacher'"  );
}

$connection->close ();
?>