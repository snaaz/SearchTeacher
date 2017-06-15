<?php
include ('connection.php');
session_start ();
if (isset($_POST ['send'] )) {	
	$email = mysqli_real_escape_string ( $connection, $_POST ['email'] );
	if (! filter_var ( $email, FILTER_VALIDATE_EMAIL )) // Validate email address
{
		$message = "Invalid email address please type a valid email!!";
		$_SESSION ['message'] = $message;
	} 

	else {
		$query = "SELECT id,name FROM users where email='" . $email . "'";
		$result = mysqli_query ( $connection, $query );
		$Results = mysqli_fetch_array ( $result );
		
		if (count ( $Results ) >= 1) {
			$encrypt = md5 ( 1290 * 3 + $Results ['id'] );
			$sql = mysqli_query ( $connection, "update users set encrypt_id='" . $encrypt . "' where email='" . $email . "'" );
			$message = "Your password reset link send to your e-mail address.";
			$to = $email;
			$subject = "Forget Password";
			$from = 'Shagufta Naaz';
			$body = 'Hi, <br/> <br/>' . $Results ['name'] . ' <br><br>Click here to reset your password http://localhost.myapps/SearchTeacher/views/reset_password-1.html?encrypt=' . $encrypt . '&action=reset   <br/> <br/>--<br>';
			$headers = "From: " . strip_tags ( $from ) . "\r\n";
			$headers .= "Reply-To: " . strip_tags ( $from ) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			mail ( $to, $subject, $body, $headers );
			$_SESSION ['message'] = $message;
			header ( 'location: ../views/forgot_password.html' );
		} else {
			$message = "NO Account Associated With This Email. Please Enter Valid Email.";
			$_SESSION ['message'] = $message;
			header ( 'location: ../views/forgot_password.html' );
		}
	}
}
$connection->close ();
?>