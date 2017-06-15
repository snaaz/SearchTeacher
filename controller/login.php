<?php
include ('connection.php');
session_start ();

$email = $_POST ['email'];
$userpass = $_POST ['password'];

$result = mysqli_query ( $connection, "select * FROM `users` WHERE email='$email' limit 1" );

$row = mysqli_fetch_array ( $result );

if ($row['active']==1) 
{
	
	$email_new = explode ( "@", $email );
	$username = $email_new [0];
	$_SESSION ["username"] = $username;
	$_SESSION ["id"] = $row ["id"];
	$_SESSION ["encrypted_id"] = $row ["encrypted_id"];
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
			$_SESSION ['message'] = "Password is not correct.";
			header ( "location:../index.html" );
		}
	}
	
	
}
if($row['active']==0)

{
	$_SESSION ['message'] = "You are not a active user. Sign Up!!";
	header ( "location:../index.html" );
}
if(!$row)

{
	$_SESSION ['message'] = "Email id is not correct.";
	header ( "location:../index.html" );
}
?>