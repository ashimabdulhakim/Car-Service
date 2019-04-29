<?php
	//file : db_login.php
	//deskripsi : menyimpan parameter untuk koneksi ke database
	
	$db_host='localhost';
	$db_database='car';
	$db_username='root';
	$db_password='';
	
	function filter($data){
		$data=trim($data);
		$data=stripslashes($data);
		$data=mysql_real_escape_string($data);
		$data=htmlspecialchars($data, ENT_QUOTES);
		return $data;
	}
?>