<?php
include ('connection.php');
session_start ();

if (isset ( $_POST ['contact'] )) {
	
		$name=$_POST['name'];
		$msg = $_POST['msg'];
		$email = mysqli_real_escape_string ( $connection, $_POST ['email'] );
		if (! filter_var ( $email, FILTER_VALIDATE_EMAIL )) // Validate email address
		{
			$message = "Invalid email address please type a valid email!!";
		} else {
			
			
			$to = 'snaaz021@gmail.com';
			$subject = "Contact Admin";
			$from = 'Shagufta Naaz <br/> Search Teacher';
			$body = 'Hi, <br/> <br/> <br><br>' . $name . '<br><br>'.$email.' <br><br>'.$msg.' <br/> <br/>--<br>';
			$headers = "From: " . strip_tags ( $from ) . "\r\n";
			$headers .= "Reply-To: " . strip_tags ( $from ) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			mail ( $to, $subject, $body, $headers );
			//header ( 'location:../views/contact_admin.html' );
			echo "msg sent successfully";
	}
}
$connection->close ();
?>