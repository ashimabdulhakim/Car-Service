<?php
$id=$_GET['id'];
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
	$query = " UPDATE detailing SET status='Requested' WHERE id=".$id." ";
	//execute the query
	$result = $db->query( $query );
	if(!$result)
	{
		die("could  not query the database: <br />".$db->error);
	}
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Switch to Requested");';
		echo 'window.location.href = "detailing.php";';
		echo '</script>';
		$db->close();
		exit;
	}
?>