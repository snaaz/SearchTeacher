<?php
include 'connection.php';
session_start();

$id= $_SESSION['id'];

//...........De activate user acoount..........

$deactive = mysqli_query($connection, "update users set active=0 where id= '".$id."'");
$row = mysqli_fetch_array($deactive);

if($row){
	
session_unset();
unset($_SESSION ["username"]);
unset($_SESSION ["id"]);
unset($_SESSION['message']);
unset($_SESSION['error']);
$_SESSION = array();
session_destroy();
header("Location:../index.html");
}
exit();
$connection -> close()
?>