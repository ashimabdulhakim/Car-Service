<?php

$id_wash=$_GET['id'];

//connect database

require_once('db_login.php');
$db =new mysqli($db_host, $db_username, $db_password, $db_database);

if ($db->connect_errno)
{
	die("could not connect to the database: <br />".$db->connect_error);
}
	//delete data into database
	//escape inputs data
	//asign a query
	$query = " DELETE FROM wash WHERE id_wash='".$id_wash."' ";
	//execute the query
	$result = $db->query( $query );
	if(!$result)
	{
		die("could  not query the database: <br />".$db->error);
	}
	else
	{
		
		echo '<script> alert("Reservation canceled"); 
				window.location.href = "index_admin.php";
				</script>';
		
		$db->close();
		exit;
	}
?>