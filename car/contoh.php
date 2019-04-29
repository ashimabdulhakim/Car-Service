<!DOCTYPE html>
<html>
<head>
<title>Sistem Pendukung Keputusan Kenaikan Pangkat</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- font files -->
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
<!-- //font files -->
<!-- css files -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' media="all">
<link href="css/wickedpicker.css" rel="stylesheet" type="text/css" media="all">        
<link href="css/style.css" rel="stylesheet" type="text/css" media="all">
<!-- /css files -->
<!-- js files -->
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<style>
	h4{color:white;
	text-align:center;
	font-size:25px;
	text-decoration:bold;}
</style>
<!-- /js files -->		
</head>
<body>
<?php
	if (isset($_POST["submit"]))
	{
		$W[1][0]=-1.744;	$W[1][1]=4.760;	$W[1][2]=-8.640	;$V[1][0]=-1.154	;$V[2][0]=1.136;
		$V[1][1]=0.282;	$V[2][1]=-0.373;
		$V[1][2]=0.482;	$V[2][2]=-0.573;
		$V[1][3]=0.582;	$V[2][3]=-0.673;
		$V[1][4]=0.682;	$V[2][4]=-0.473;
		
		$dedikasi = $_POST["dedikasi"];
		$loyalitas = $_POST["loyalitas"];
		$lama_kerja = $_POST["lama_kerja"];
		$waktu_kedatangan = $_POST["waktu_kedatangan"];

	$ZNET[1] = 0; $ZNET[2] = 0;  $Z[0] = 1; $a = 0.1;
	
		for($j=1;$j<=2;$j++){
			$ZNET[$j] = number_format($V[$j][0] + ($dedikasi*$V[$j][1]) + ($loyalitas*$V[$j][2])+($lama_kerja*$V[$j][3])+ ($waktu_kedatangan*$V[$j][4]),3);
			//echo "Znet[".$j."] = ".$V[$j][0]." + (".$dedikasi." x ".$V[$j][1].") + (".$loyalitas." x ".$V[$j][2].") + (".$lama_kerja." x ".$V[$j][3].")+(".$waktu_kedatangan." x ".$V[$j][4].") = ".$ZNET[$j]."<br/>";
		}
		//echo "<br/>";
		for($j=1;$j<=2;$j++){
			$Z[$j] = number_format(1/(1 +  pow(2.71828 , ($ZNET[$j]*(-1)))),3);
			//echo "Z[".$j."] = 1 / (1 + 2.71828^-".$ZNET[$j].") = ".$Z[$j]."<br/>";
		}
	
		$YNET = number_format($W[1][0] + ($Z[1]*$W[1][1]) + ($Z[2]*$W[1][2]),3);
		//echo "Ynet = ".$W[1][0]." + (".$Z[1]." x ".$W[1][1].") + (".$Z[2]." x ".$W[1][2].") = ".$YNET."<br/>";
		$Y = number_format(1/(1 +  pow(2.71828 , ($YNET*(-1)))),3);
		//echo "Y = 1 / (1 + 2.71828^-".$YNET.") = ".$Y."<br/>";
			if ($Y < 0.5)
		{
			$keputusan= "Tidak Naik Pangkat";
		}
		else if($Y >= 0.5)
		{
			$keputusan= "Naik Pangkat";
		}
	}
?>



<div class="header">
	<h1>SISTEM PENDUKUNG KEPUTUSAN KENAIKAN PANGKAT<br>
	SEORANG PEGAWAI DI SUATU PERUSAHAAN<br>
	MENGGUNAKAN METODE <i>BACKPROPAGATION</i></h1>
</div>
       <div class="banner-top">
				
	<form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">			
				<div class="banner-bottom">
					<div class="bnr-one">
						<div class="bnr-left">
							<p>Dedikasi</p>
						</div>
						<div class="bnr-right">
							<select name="dedikasi" value="dedikasi">
								<option value="1"<?php if (isset($dedikasi) && $dedikasi == "1") echo 'selected="true"';?>>Buruk</option>
								<option value="2"<?php if (isset($dedikasi) && $dedikasi == "2") echo 'selected="true"';?>>Baik</option>
							</select>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="bnr-one">
						<div class="bnr-left">
							<p>Loyalitas</p>
						</div>
						<div class="bnr-right">
							<select name="loyalitas" value="loyalitas">
								<option value="1"<?php if (isset($loyalitas) && $loyalitas == "1") echo 'selected="true"';?>>Tidak</option>
								<option value="2"<?php if (isset($loyalitas) && $loyalitas == "2") echo 'selected="true"';?>>Lumayan</option>
								<option value="3"<?php if (isset($loyalitas) && $loyalitas == "3") echo 'selected="true"';?>>Sangat</option>
							</select>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="bnr-one">
						<div class="bnr-left">
							<p>Lama Kerja</p>
						</div>
						<div class="bnr-right">
							<select name="lama_kerja" value="lama_kerja">
								<option value="1"<?php if (isset($lama_kerja) && $lama_kerja == "1") echo 'selected="true"';?>>Sebentar</option>
								<option value="2"<?php if (isset($lama_kerja) && $lama_kerja == "2") echo 'selected="true"';?>>Lama</option>
							</select>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="bnr-one">
						<div class="bnr-left">
							<p>Waktu Kedatangan</p>
						</div>
						<div class="bnr-right">
							<select name="waktu_kedatangan" value="waktu_kedatangan">
								<option value="1"<?php if (isset($waktu_kedatangan) && $waktu_kedatangan == "1") echo 'selected="true"';?>>Telat</option>
								<option value="2"<?php if (isset($waktu_kedatangan) && $waktu_kedatangan == "2") echo 'selected="true"';?>>Tepat</option>
							</select>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="bnr-btn">
							<input type="submit" name="submit" value="Submit">
						</form>
					</div>
					<h4><br/>
					<?php
					if(isset($keputusan)){
						
						echo strtoupper($keputusan);
					}
					
					?>
					</h4>
				</div>
			</div>
</body>
</html>