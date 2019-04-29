<?php
@ob_start();
session_start();
?>

<?php
	//$id_wash = (isset($_GET['id']) ? $_GET['id'] : '');
	$id_wash = $_GET['id'];
	require_once('db_login.php');
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if ($db->connect_errno){
		die ("Could not connect to the database: <br />". $db->connect_error);
	}

	if (!isset($_POST["submitEditWash"])){
		$queryq = " SELECT * FROM wash WHERE id_wash='".$id_wash."' ";
		//echo "1"; var_dump($id_wash); echo "</br";
		// Execute the query
		$resultq = $db->query( $queryq );
		if (!$resultq){
			die ("Could not query the database: <br />". $db->error);
		}else{
			while ($row = $resultq->fetch_object()){
				$id_wash = $row->id_wash;
				$type = $row->type;
				$name = $row->name;
				$no = $row->no;
				$date = $row->date;
			}
		}
	}else{
		$type = test_input($_POST['type']);
		$name = test_input($_POST['name']);
		$no = test_input($_POST['no']);
		$date = test_input($_POST['date']);
		
		//escape inputs data
		//$id_wash = $db->real_escape_string($id_wash);
		$type = $db->real_escape_string($type);
		$name = $db->real_escape_string($name);
		$no = $db->real_escape_string($no);
		$date = $db->real_escape_string($date);
			
		$queryEditWash = "UPDATE wash SET type='".$type."', name='".$name."', no='".$no."' , date='".$date."' WHERE id_wash='".$id_wash."' ";
			//var_dump($queryEditWash);die();
			// Execute the query
			$resultEditWash = $db->query( $queryEditWash );
			if (!$resultEditWash){
				die ("Could not query the database: <br />". $db->error);
			}else{
				echo '<script> alert("Data have been updated"); 
				window.location.href = "index_admin.php";
				</script>';
			$db->close();
				exit;
			}
		}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
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
          //session_start();
          if(isset($_SESSION['username']) && isset($_SESSION['password']))
          {
            $id_admin=$_SESSION['username'];
            //$nama_admin="";
            //var_dump($id);die();
            //$nama_admin = null;
            require_once('db_login.php');
            // Connect
            $db = new mysqli($db_host, $db_username, $db_password,$db_database);
            if($db->connect_errno){
              die ("Could not connect to the database3: <br />". $db->connect_error);
            }
            $query = " SELECT name FROM admin WHERE username='".$id_admin."' ";
            //var_dump($query);die;
            // Execute the queryd 
            $result = $db->query($query);
            //var_dump($result);die;
            if (!$result){
              die("could not query the database: <br />". $db->error);
            }
            $user = $result->fetch_array();
            //var_dump($user);die();
          }
?>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>

			  	<a class="brand" href="index_admin.php">
			  		Admin
			  	</a>

				<div class="nav-collapse collapse navbar-inverse-collapse">
					<ul class="nav pull-right">
						<li><a href="#">
							<?php echo ''.$user['name']. '';?>
						</a></li>
						<li class="nav-user dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="images/user.png" class="nav-avatar" />
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</li>
					</ul>
				</div><!-- /.nav-collapse -->
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->



	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="span3">
					<div class="sidebar">

						<ul class="widget widget-menu unstyled">
							<li class="active">
								<a href="index_admin.php">
									<i class="menu-icon icon-dashboard"></i>
									Car Wash Request
								</a>
							</li>
							<li>
								<a href="coating.php">
									<i class="menu-icon icon-dashboard"></i>
									Car Coating Request
								</a>
							</li>
							<li>
								<a href="detailing.php">
									<i class="menu-icon icon-dashboard"></i>
									Car Detailing Request
								</a>
							</li>
							<li>
								<a href="caring.php">
									<i class="menu-icon icon-dashboard"></i>
									Car Caring Request
								</a>
							</li> 
						</ul><!--/.widget-nav-->
					</div><!--/.sidebar-->
				</div> <!--/.span3-->


				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Edit Request</h3>
							</div>
							<div class="module-body">
								<form class="form-horizontal row-fluid" role="form" method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $id_wash;?>" enctype="multipart/form-data">
										<div class="control-group">
											<label class="control-label" for="basicinput">Wash Type </label>
											<div class="controls">
												<select tabindex="1" value="<?php echo $type;?>" name="type" class="span8">
													<option name="type" value="Regular"<?php if (isset($type) && $type == "Regular") echo 'selected="true"';?>>Regular</option>
													<option name="type" value="Premium"<?php if (isset($type) && $type == "Premium") echo 'selected="true"';?>>Premium</option>
							
												</select>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Customer Name</label>
											<div class="controls">
												<input type="text" name="name" pattern="[a-zA-Z\s]+" title="Letters only, space allowed" value="<?php echo $name;?>" class="span8 tip" required="">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">Customer Contact</label>
											<div class="controls">
												<input type="text" name="no" pattern= "[0-9]+" title="Numbers only" value="<?php echo $no;?>" class="span8 tip" required="">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">Date Reservation</label>
											<div class="controls">
												<input type="text" name="date" value="<?php echo $date;?>" class="span8 tip" readonly>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">New Date Reservation</label>
											<div class="controls">
												<input type="datetime-local" name="date" value="<?php echo $date;?>" class="span8 tip" required="">
											</div>
										</div>

										<div class="control-group">
											<div class="controls">
												<button type="submit" name="submitEditWash" class="btn">Edit</button>
											</div>
										</div>
									</form>
							</div>
						</div><!--/.module-->
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

	<!-- <div class="footer">
		<div class="container">
			 

			<b class="copyright">&copy; 2014 Edmin - EGrappler.com </b> All rights reserved.
		</div>
	</div> -->

	<script src="scripts/jquery-1.9.1.min.js"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
</body>