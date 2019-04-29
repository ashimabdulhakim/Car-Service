<?php
@ob_start();
session_start();

//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>

	<?php
        require_once('db_login.php');
        $db = new mysqli($db_host, $db_username, $db_password,$db_database); //skala objek, bikin kelas baru
        if($db->connect_errno){                         //karena objek, maka pakenya panah
          die ("Could not connect to the database: <br/>". $db-> connect_error);
        }

         //------------------------- verifikasi login---------------
        if(!isset($_SESSION['username']) && !isset($_SESSION['password'])){
          if(isset($_POST['submit'])){
           
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($username != ''){
              $valid_username = TRUE;
            }else{
              $valid_username = FALSE;
            }
            if ($password != ''){
              $valid_password = TRUE;
            }else{
              $valid_password = FALSE;
            }     
            //update into database
            if($valid_username && $valid_password){
              //escape inputs data
              $username = $db->real_escape_string($username);   //real escape biar nggak dibobol, buat mengamankan query
              $password = $db->real_escape_string($password);
              //assign a query
              $query = " SELECT username,password FROM admin WHERE username = '".$username."' AND password = '".$password."'";
              //execute the query
              $result = $db->query($query);
              if(!$result){
                die("Could not query the database: <br />".$db->error);
              } 
              if($result->num_rows == 1){
                $hasil = $result->fetch_assoc();
                $_SESSION['username'] = $hasil['username'];
                $_SESSION['password'] = $hasil['password'];
                header('location:index_admin.php');
                $db->close();
              }else{
                echo '<script> alert("username and password not match"); </script>';
              } 
            }
          }
        }

         
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>

			  	<a class="brand" href="index.html">
			  		Admin
			  	</a>

				<div class="nav-collapse collapse navbar-inverse-collapse">
				
					<ul class="nav pull-right">

						<li><a href="#">
							Sign Up
						</a></li>

						

						<li><a href="#">
							Forgot your password?
						</a></li>
					</ul>
				</div><!-- /.nav-collapse -->
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->



	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">
					<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<div class="module-head">
							<h3>Sign In</h3>
						</div>
						<div class="module-body">
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="text" id="inputEmail" name="username" placeholder="Username">
								</div>
							</div>
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="password" name="password" id="inputPassword" placeholder="Password">
								</div>
							</div>
						</div>
						<div class="module-foot">
							<div class="control-group">
								<div class="controls clearfix">
									<button type="submit" name="submit" class="btn btn-primary pull-right">Login</button>
									<label class="checkbox">
										<input type="checkbox"> Remember me
									</label>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--/.wrapper-->

	<div class="footer">
		<div class="container">
			 

			
		</div>
	</div>
	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>