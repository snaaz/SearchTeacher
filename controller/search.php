<?php
include ('connection.php');
//session_start();
 //$search_result=mysqli_query($connection, "select 1 from dual ");
 //echo mysqli_num_rows($search_result);
// print_r($search_result);



$queryArray = array();
$goodQuery = true ;

$record_available = false;


if (isset ( $_GET ['search-key'] )) {
	$key = $_GET ['search-key'];
	
	
	$id = $_SESSION['id'];
	// echo $search_values;
	
	// Details of Login user........//
	$user = mysqli_query ( $connection, "select * FROM `users` WHERE id= '" . $id . "'" );
	$row = mysqli_fetch_array ( $user );
	
	// search teacher and student details......//
	if ($row ['usertype'] == 'student') 
	{
		$search_users = mysqli_query ( $connection, "select users.name,users.locality,users.city,users.class,user_subjects.subject_name
                                                      from users inner join user_subjects on users.id=user_subjects.user_id
                                                     where users.usertype='teacher' and
(user_subjects.subject_name like '%" . $key . "%' or users.locality like '%" . $key . "%' or 
				users.city like '%" . $key . "%' or users.class like '%" . $key . "%')" );
		
	
		
	} 
	else 
	{
		$search_users = mysqli_query ( $connection, "select users.name,users.locality,users.city,users.class,user_subjects.subject_name
                                                      from users inner join user_subjects on users.id=user_subjects.user_id
                                                     where users.usertype='teacher' and
(user_subjects.subject_name like '%" . $key . "%' or users.locality like '%" . $key . "%' 
				or users.city like '%" . $key . "%' or users.class like '%" . $key . "%')" );
		
	}
	
 	if (mysqli_num_rows ( $search_users ) > 0) 
 	{
 		$record_available = true;
		while( $search_user = mysqli_fetch_array ( $search_users )) 
		{
			$queryArray[] = $search_user;
			
				
	     }
	}
	if($record_available){
	//echo "session";
		//$_SESSION['search_output'] = $queryArray;
		print_r($queryArray[0]['name']);
	
	//	print_r($_SESSION['search_output'][0]['name']);
		
		//header("Location: ../views/search.html");
	
		//exit;
	}
	else 
	{
		echo "no";
		echo $_SESSION ["message"] = "No Such Records Found";
		//header ( "Location: ../views/search.html" );
	}
}

$connection->close ();
?>



