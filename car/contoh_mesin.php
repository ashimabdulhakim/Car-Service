

<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Car Services Auto Mobile</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<!-- <meta name="keywords" content="Car Services Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"
	/> -->
	<!--// Meta tag Keywords -->

	<!-- Custom-Files -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Bootstrap-Core-CSS -->
	<link href="css/JiSlider.css" rel="stylesheet">
	<!-- //banner-slider -->
	<link rel="stylesheet" href="css/smoothbox.css" type='text/css' media="all" />
	<!-- gallery lightbox -->
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link rel="stylesheet" href="css/fontawesome-all.css">
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //Custom-Files -->

	<!-- Web-Fonts -->
	<link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext"
	    rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Dr+Sugiyama&amp;subset=latin-ext" rel="stylesheet">
	<!-- //Web-Fonts -->

</head>

<?php
	//connect database
	require_once('db_login.php');
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if ($db->connect_errno){
		die ("Could not connect to the database: <br />". $db->connect_error);
	}
	
	$query = 'SELECT DISTINCT field FROM kondisi_mesin';
	// Execute the query
	$result = $db->query( $query );
	$row = $result->fetch_object();
	$jumfield = $result->num_rows;
	$jumfield = $jumfield-1;
	
	if (isset($_POST["submitMesin"])){
		$valid = TRUE;
		for( $i= 1 ; $i <= $jumfield ; $i++ ){
			
				$N[$i] = $_POST['N'.$i];
				if ($N[$i] == '' || $N[$i] == 'none'){
					$error_N[$i] = "This field is required";
					$valid_N[$i] = FALSE;
				}else{
					$valid_N[$i] = TRUE;
				}
				
				if($valid && $valid_N[$i]){
					$valid = TRUE;
				} else{
					$valid = FALSE;
				}
		}
		
		if($valid){
			
			$query1 = "SELECT * FROM mesin";
			// Execute the query
			$result1 = $db->query( $query1 );
			if (!$result1){
			   die ("Could not query the database: <br />". $db->error);
			}
			$row1 = $result1->fetch_object();
			$totaldata = $result1->num_rows;
			
			$query2 = "SELECT * FROM kondisi_mesin where field = 'goal'";
			// Execute the query
			$result2 = $db->query( $query2 );
			$j = 1;
			while($goal = $result2->fetch_object()){
				$kondisi[$j] = $goal->kondisi;
				$query3 = "SELECT * FROM mesin where goal = '".$kondisi[$j]."'";
				// Execute the query
				$result3 = $db->query( $query3 );
				$row3 = $result3->fetch_object();
				$total = $result3->num_rows;
				$probprior[$j] = $total/$totaldata;
				$result3->free();

				for( $i= 1 ; $i <= $jumfield ; $i++ ){
					$query4 = "SELECT * FROM mesin where F".$i." = '".$N[$i]."' AND goal = '".$kondisi[$j]."'";
					// Execute the query
					$result4 = $db->query( $query4 );
					$row4 = $result4->fetch_object();
					$jumlah = $result4->num_rows;
					if ($jumlah != 0){
						$bobot[$j][$i] = $jumlah / $total;
					} else{
						$bobot[$j][$i] = 0;
					}
					$result4->free();
				}
				$j = $j+1;
			}
			$result2->free();
	
			$totalbobot[1] = 1;
			$totalbobot[2] = 1;
			for( $i= 1 ; $i <= $jumfield ; $i++ ){
				$totalbobot[1] = $totalbobot[1] * $bobot[1][$i];
				$totalbobot[2] = $totalbobot[2] * $bobot[2][$i];
			}
			$totalbobot[1] = $totalbobot[1] * $probprior[1];
			$totalbobot[2] = $totalbobot[2] * $probprior[2];
			
			if ($totalbobot[1] >= $totalbobot[2]){
				$prediksi = $kondisi[1];
			} else{
				$prediksi = $kondisi[2];
			}
		}
	}
	
?>


<body>

	<!-- contact -->
	<div class="team py-5" id="team">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="title text-capitalize text-dark text-center pb-3 mb-sm-5 mb-4">Let's solve it!
				<span></span>
			</h3>
			<div class="row team-bottom">
				<div class="col-sm-4 team-grid">
						
					</div>
					<div class="col-sm-4 team-grid mt-sm-0 mt-3">
						<form role="form" method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							<table align="center" style="margin-left: 70px;">
							<?php
								for( $i= 1 ; $i <= $jumfield ; $i++ ){
									echo '<tr>';
									echo '<td>';
									echo '<div class="form-group">';
										//Asign query field
										$queryfield = " SELECT * FROM kondisi_mesin WHERE field='F".$i."' ";
										// Execute the query
										$resultfield = $db->query( $queryfield );
										$resultfield2 = $db->query( $queryfield );
										if (!$resultfield || !$resultfield2){
											die ("Could not query the database: <br />". $db->error);
										}
										$field2 = $resultfield2->fetch_object();

										echo '<label>'.$field2->nama_field.'</label><br />';
										
										echo '<select name="N'.$i.'" class="form-control" required>';
										echo '<option value="none"';
											if (!isset($N[$i])) echo 'selected="true"';
										echo '>--'.$field2->nama_field.'--</option>';
												while ($field = $resultfield->fetch_object()){
													$kondisi = ucwords($field->kondisi);
													echo "<option value='".$field->kondisi."' ";
													if(isset($N[$i]) && $N[$i]==$field->kondisi) echo 'selected="true"';
													echo ">".$kondisi."</option>";
												}			
										echo '</select>';
										echo '</div>';
									echo '</td>';
									echo '</tr>';
									echo '<td valign="top"><span class="error">';
									if(isset($error_N[$i])){echo $error_N[$i];}
									echo '</span></td>';

									if ($i %4 == 0){
										echo'</tr>';
										echo'<td>';
										//echo'<br />';
										echo'</td>';
										echo'<tr>';
									}
								}
							?>
							</table>
							<div style="margin-left: 110px;">
							<button type="submit" name="submitMesin" class="btn btn-secondary">Submit</button>
							<a href="index.php"> <button type="button" class="btn btn-secondary">Back</button></a>
							</div>
							<h4 style="color: red;margin-left: 90px;"><br/>
							<?php
								if(isset($prediksi)){
									echo strtoupper($prediksi);
								}
							?>
							</h4>
						</form>
					</div>
				</div>
			</div>
		</div>
	<!-- //contact -->
	
	<!-- Js files -->
	<!-- JavaScript -->
	<script src="js/jquery-2.2.3.min.js"></script>
	<!-- <script src="js/jquery-1.11.3.min.js"></script> -->
	<!-- Default-JavaScript-File -->
	<script src="js/bootstrap.js"></script>
	<!-- Necessary-JavaScript-File-For-Bootstrap -->

	<!--banner-slider-->
	<script src="js/JiSlider.js"></script>
	<script>
		$(window).load(function () {
			$('#JiSlider').JiSlider({
				color: '#fff',
				start: 3,
				reverse: true
			}).addClass('ff')
		})
	</script>
	<!-- //banner-slider -->

	<!-- smooth scrolling -->
	<script src="js/SmoothScroll.min.js"></script>
	<!-- //smooth scrolling -->

	<!-- move-top -->
	<script src="js/move-top.js"></script>
	<!-- easing -->
	<script src="js/easing.js"></script>
	<!--  necessary snippets for few javascript files -->
	<script src="js/car_services.js"></script>
	<!-- banner text -->
	<script src="js/text.js"></script>
	<!-- menu -->
	<script src="js/menu.js"></script>
	<!-- lightbox -->
	<script src="js/smoothbox.jquery2.js"></script>

	<!-- testimonials -->
	<!-- required-js-files-->
	<link href="css/owl.carousel.css" rel="stylesheet">
	<script src="js/owl.carousel.js"></script>
	<script>
		$(document).ready(function () {
			$("#owl-demo").owlCarousel({
				items: 1,
				lazyLoad: true,
				autoPlay: false,
				navigation: true,
				navigationText: true,
				pagination: true,
			});
		});
	</script>
	<!-- //required-js-files-->
	<!-- //Js files -->
	
</body>

</html>