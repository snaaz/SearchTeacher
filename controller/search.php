<?php
include ('connection.php');
$num_rec_per_page=2;
$record_available = false;

if (isset ( $_GET ['search-key'] )) {
	$key = $_GET ['search-key'];
	$id = $_SESSION ['id'];
	
	// Details of Login user........//
	$user = mysqli_query ( $connection, "select * FROM `users` WHERE id= '" . $id . "'" );
	$row = mysqli_fetch_array ( $user );
	
	
	// search teacher and student details......//
	if ($row ['usertype'] == 'student') {
		$search_users = mysqli_query ( $connection, "select users.id,users.encrypted_id,users.name,users.locality,users.city,users.pincode,users.class,user_subjects.subject_name
                                                      from users inner join user_subjects on users.id=user_subjects.user_id
                                                     where users.usertype='teacher' and
(user_subjects.subject_name like '%" . $key . "%' or users.locality like '%" . $key . "%' or 
				users.city like '%" . $key . "%' or users.class like '%" . $key . "%') " );
	} else {
		$search_users = mysqli_query ( $connection, "select users.id,users.encrypted_id,users.name,users.locality,users.city,users.pincode,users.class,user_subjects.subject_name
                                                      from users inner join user_subjects on users.id=user_subjects.user_id
                                                     where users.usertype='student' and
(user_subjects.subject_name like '%" . $key . "%' or users.locality like '%" . $key . "%' 
				or users.city like '%" . $key . "%' or users.class like '%" . $key . "%') " );
	}
	
	$total_records = mysqli_num_rows ( $search_users );
	if ($total_records > 0) {
		$record_available = true;
		$total_pages = ceil($total_records / $num_rec_per_page);
		
	
		//no-of-records per page should be 10....//
		if (isset($_GET["page"]))
		{
			$page  = $_GET["page"];
			//echo $page;
		}
		else
		{
			$page=1;
		}
		$start_from = ($page-1) * $num_rec_per_page;
		//echo $start_from;
		
		if ($row ['usertype'] == 'student') {
			$search_users_perpage = mysqli_query ( $connection, "select users.id,users.encrypted_id,users.name,users.locality,users.city,users.pincode,users.class,user_subjects.subject_name
                                                      from users inner join user_subjects on users.id=user_subjects.user_id
                                                     where users.usertype='teacher' and
(user_subjects.subject_name like '%" . $key . "%' or users.locality like '%" . $key . "%' or
				users.city like '%" . $key . "%' or users.class like '%" . $key . "%')  LIMIT $start_from, $num_rec_per_page" );
		} else {
			$search_users_perpage = mysqli_query ( $connection, "select users.id,users.encrypted_id, users.name,users.locality,users.city,users.pincode,users.class,user_subjects.subject_name
                                                      from users inner join user_subjects on users.id=user_subjects.user_id
                                                     where users.usertype='student' and
(user_subjects.subject_name like '%" . $key . "%' or users.locality like '%" . $key . "%'
				or users.city like '%" . $key . "%' or users.class like '%" . $key . "%')  LIMIT $start_from, $num_rec_per_page " );
		}
		
		
	} 

	else {
		$_SESSION ["message"] = "No Such Records Found";
	}
}

$connection->close ();
?>