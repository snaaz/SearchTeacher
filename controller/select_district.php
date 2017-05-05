<?php 
header( "Content-type: application/json" );
include ('connection.php');


if(!empty($_GET["state_id"])){
	$res = array();
	$districts = mysqli_query ( $connection, "select * from district where state_id='".$_GET["state_id"]."' order by dname" );
	while($result = mysqli_fetch_array($districts)){
		$res[] = array(
				'id'=> $result['id'],
				'name'=> $result['dname']
		);
		
	}
		
echo json_encode($res);
	
}

?>
