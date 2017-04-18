<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "search_teacher";

$connection = new mysqli ( $servername, $username, $password, $dbname );
if ($connection->connect_error) {
	die ( "connection failed" . $connection->connect_error );
}

//$uresr=mysqli_query($connection,"select * FROM `users` WHERE 1");


?>