<?php
include ('connection.php');
session_start ();

$email = $_POST ['email'];
$userpass = $_POST ['password'];

$result = mysqli_query ( $connection, "select * FROM `users` WHERE email='$email' and active=1 limit 1" );

$row = mysqli_fetch_array ( $result );

if ($row) 
{
	
	$email_new = explode ( "@", $email );
	$username = $email_new [0];
	$_SESSION ["username"] = $username;
	$_SESSION ["id"] = $row ["id"];
	$_SESSION ["usertype"] = $row['usertype'];
	
	
	$hash = hash_equals ( $row ['password'], crypt ( $userpass, $row ['password'] ) );
	if ($hash) 
	{
	
		header ( "Location: ../views/dashboard.html" );
	} 

	else 
	{
		if (! $hash) 
		{
			$_SESSION ['message'] = "Wrong Email or Password";
			header ( "location:../index.html" );
		}
	}
	
	
} 

else 
{
	$_SESSION ['message'] = "You are not a active user. Sign Up!!";
	header ( "location:../index.html" );
}
?>