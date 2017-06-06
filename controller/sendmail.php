<?php
header( "Content-type: application/json" );
include ('connection.php');

if (isset ( $_POST ['message'] )) {
		
			 $message=$_POST['message'];
			 $encrypted_id=$_POST['id'];
			 
			 $query = "SELECT email FROM users where encrypted_id='" . $encrypted_id . "'";
			 $result = mysqli_query ( $connection, $query );
			 $Results = mysqli_fetch_array ( $result );
			
			
			 $to = $Results['email'];
			 $subject = "Required";
			 $from = 'Shagufta Naaz/Search Teacher';
			 $body = $message;
			 $headers = "From: " . strip_tags ( $from ) . "\r\n";
			 $headers .= "Reply-To: " . strip_tags ( $from ) . "\r\n";
			 $headers .= "MIME-Version: 1.0\r\n";
			 $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			 mail ( $to, $subject, $body, $headers );
			 $sent= "mail send successfully";
			echo json_encode($sent);
	}


?>