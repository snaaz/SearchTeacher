<?php
include ('connection.php');

$record_available = false;

if (isset ( $_GET ['search-key'] )) {
	$key = $_GET ['search-key'];
	$id = $_SESSION ['id'];
	
	// Details of Login user........//
	$user = mysqli_query ( $connection, "select * FROM `users` WHERE id= '" . $id . "'" );
	$row = mysqli_fetch_array ( $user );
	
	// search teacher and student details......//
	if ($row ['usertype'] == 'student') {
		$search_users = mysqli_query ( $connection, "select users.name,users.locality,users.city,users.pincode,users.class,user_subjects.subject_name
                                                      from users inner join user_subjects on users.id=user_subjects.user_id
                                                     where users.usertype='teacher' and
(user_subjects.subject_name like '%" . $key . "%' or users.locality like '%" . $key . "%' or 
				users.city like '%" . $key . "%' or users.class like '%" . $key . "%')" );
	} else {
		$search_users = mysqli_query ( $connection, "select users.name,users.locality,users.city,users.class,user_subjects.subject_name
                                                      from users inner join user_subjects on users.id=user_subjects.user_id
                                                     where users.usertype='teacher' and
(user_subjects.subject_name like '%" . $key . "%' or users.locality like '%" . $key . "%' 
				or users.city like '%" . $key . "%' or users.class like '%" . $key . "%')" );
	}
	
	if (mysqli_num_rows ( $search_users ) > 0) {
		$record_available = true;
	} 

	else {
		$_SESSION ["message"] = "No Such Records Found";
	}
}

$connection->close ();
?>