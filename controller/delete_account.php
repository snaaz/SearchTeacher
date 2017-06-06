<?php
include 'connection.php';
session_start();


if(isset($_GET['user'])){
$id= $_GET['user'];

//...........De activate user acoount..........

$deactive = mysqli_query($connection, "update users set active=0 where encrypted_id= '".$id."'");


if($deactive){
	
session_unset();
unset($_SESSION ["username"]);
unset($_SESSION ["id"]);
unset($_SESSION['encrypted_id']);
unset($_SESSION['message']);
unset($_SESSION['error']);
$_SESSION = array();
session_destroy();
header("Location:../index.html");
}
}
exit();
$connection -> close()
?>