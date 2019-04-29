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
	<script type="text/javascript">
		function delete_record(id)
		{
			if(confirm('Are you sure To Remove This Reservation?'))
			{
				window.location.href='delete_caring.php?id='+id;
			}
		}
		function booked_record(id)
		{
			if(confirm('Are you sure To Approve This Reservation ?'))
			{
				window.location.href='bookeddiverifcaring.php?id='+id;
			}
		}
		function booking_record(id)
		{
			if(confirm('Are you sure To Cancel This Reservation?'))
			{
				window.location.href='canceldiverifcaring.php?id='+id;
			}
		}
	</script>
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
							<li>
								<a href="index_admin.php">
									<i class="menu-icon icon-dashboard"></i>
									Car Wash Request
								</a>
							</li>
							<li class="active">
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
								<h3>Car Caring Request</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>Caring Type</th>
											<th>Customer Name</th>
											<th>Phone Number</th>
											<th>Date and Time</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<?php
	              require_once('db_login.php');
	        // Connect
	        $con = mysqli_connect($db_host, $db_username, $db_password,$db_database);
	        if (mysqli_connect_errno()){
	          die ("Could not connect to the database: <br />". mysqli_connect_error( ));
	        }
	        //Asign a query
	        $query = " SELECT * FROM caring ";
	        // Execute the query
	        $result = mysqli_query($con,$query);
	        if (!$result){
	          die ("Could not query the database: <br />". mysqli_error($con));
	        }
	        
	        //$i = 1;
	        while($row = $result->fetch_object()){
	          echo '<tr>';
	          //echo '<td>'.$i.'</td>';
	          echo '<td>'.$row->type.'</td>';
	          echo '<td>'.$row->name.'</td>';
	          echo '<td>'.$row->no.'</td>';
	          echo '<td>'.$row->date.'</td>';
	          echo '<td>'.$row->status.'</td>';

	          if ($row->status=='Booked'){
				echo '<td>';
				echo '<a href="javascript:booking_record('.$row->id.')">Cancel<br></a>';
				echo '<a href="edit_caring.php?id='.$row->id.'">Edit<br></a>';
				echo '<a href="javascript:delete_record('.$row->id.')">Delete</a>';
				echo '</td>';
			}else {
				echo '<td>';
				echo '<a href="javascript:booked_record('.$row->id.')">Approved<br></a>';
				echo '<a href="edit_caring.php?id='.$row->id.'">Edit<br></a>';
				echo '<a href="javascript:delete_record('.$row->id.')">Delete</a>';
				echo '</td>';
			}

	        echo'</tr>';
	          //$i++;
	        }
	        echo '</table>';
	        
	        $result->free();
	        $db->close();
	      ?>
								</table>
							</div>
						</div><!--/.module-->

					<br />
						
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