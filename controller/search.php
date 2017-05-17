<?php
include ('connection.php');


 

if(isset( $_POST['search'])){
	
	$search_values=$_POST['search-value'];
	$id = $_POST['id'];
	echo $search_values;
	
	
	// Details of Login user........//
	$user1 = mysqli_query ( $connection, "select * FROM `users` WHERE id= '".$id."'"  );
	$row1 = mysqli_fetch_array ( $user1);
	
	
	//search teacher and student details......//
	if($row1['usertype']=='student'){
		$search_users1 = mysqli_query ( $connection, "select users.name,users.locality,users.city,users.class,user_subjects.subject_name
                                                      from users inner join user_subjects on users.id=user_subjects.user_id
                                                     where users.usertype='teacher' and
(user_subjects.subject_name like '%".$search_values."%' or users.locality like '%".$search_values."%' or 
				users.city like '%".$search_values."%' or users.class like '%".$search_values."%')"  );
		
	//	echo "aa";
		$row1 = mysqli_fetch_array ( $search_users1);
		echo $row1['name'];
		echo $row1['subject_name'];
		//header ( "Location: ../views/search.html");
	
	}
	else{
		$search_users1 = mysqli_query ( $connection, "select users.name,users.locality,users.city,users.class,user_subjects.subject_name
                                                      from users inner join user_subjects on users.id=user_subjects.user_id
                                                     where users.usertype='teacher' and
(user_subjects.subject_name like '%".$search_values."%' or users.locality like '%".$search_values."%' 
				or users.city like '%".$search_values."%' or users.class like '%".$search_values."%')"  );
	
		$row1 = mysqli_fetch_array ( $search_users);
		echo "bb";
		//header ( "Location: ../views/search.html");
	}
	
}

$connection->close ();
?>