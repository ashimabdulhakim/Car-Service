<?php
	session_start();
	unset($_SESSION['username']); 
	session_destroy();
	if(!isset($_SESSION['username']))
	{
		header("Location: login.php");
	}
?>