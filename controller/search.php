<?php
include ('connection.php');

// Details of Login user........//
if (isset ( $_SESSION['id'] )) {
	
	$id = $_SESSION ['id'];
	$user = mysqli_query ( $connection, "select * FROM `users` WHERE id= '".$id."'"  );
	$row = mysqli_fetch_array ( $user);
	
	
}



//search teacher and student details......//
if($row['usertype']=='student'){
$search_users = mysqli_query ( $connection, "select * FROM `users` WHERE usertype= 'teacher'"  );

}
else{
	$search_users = mysqli_query ( $connection, "select * FROM `users` WHERE usertype= 'student'"  );
	
}

//$search_users1=mysqli_fetch_array ($search_users);
//$pics = mysqli_query ( $connection, "SELECT * FROM profile_pic where user_id='" . $search_users1['id'] . "'" );
//$pic=mysqli_fetch_array($pics);
//echo mysqli_num_rows($pics);



$connection->close ();
?>