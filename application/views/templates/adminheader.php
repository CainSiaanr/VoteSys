<html>
	<!--Title declaration, importing css & js-->
	<head>
        <title>Urvoice - Sampaikan Aspirasimu!</title> 
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/admin/header.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/footer.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/admin/<?php echo $title; ?>.css">
		<script src="<?php echo base_url(); ?>public/js/adminheader.js"></script> 
		<script src="<?php echo base_url(); ?>public/js/admin/<?php echo $title; ?>.js"></script> 
	</head>
    <body style="margin: 0px; background-image: url('<?php echo base_url(); ?>public/img/background/<?php echo $background->image; ?>'); background-size: cover; background-repeat: repeat;">
		<!--The header itself-->
		<div class="header" id="header">
			<!--Urvoice logo-->
			<a href="<?php echo site_url(); ?>/admin/candidates" class="logo"><img src= "<?php echo base_url(); ?>/public/img/urvoice_logo.png" width="112" height="50"></a>
			<!--Hamburger icon-->
			<a href="javascript:void(0);" class="icon" onclick="myFunction()">
				<i class="fa fa-bars"></i>
			</a>
			<!--Header tabs to other pages-->
			<div class="header-right">
				<div class="dropdown" id="dropdown1">
					<button href="#" class="dropbtn" id="dropbtn1">Manajemen Pemilu</button>
					<i class="fa fa-angle-right arrow-right" id="arrow-right1"></i>
					<div class="dropdown-content non-null head-clickable">
						<a class="dropdown-link" href="<?php echo site_url(); ?>/admin/candidate">Calon Organisator</a>
						<a class="dropdown-link" href="<?php echo site_url(); ?>/admin/voter">Pemberi Suara</a>
						<a class="dropdown-link" href="<?php echo site_url(); ?>/admin/association">Himpunan</a>
						<a class="dropdown-link" href="<?php echo site_url(); ?>/admin/schedule">Jadwal Pemilu</a>
					</div>
				</div>
				<div class="dropdown" id="dropdown2">
					<button href="#" class="dropbtn" id="dropbtn2">Manajemen Website</button>
					<i class="fa fa-angle-right arrow-right" id="arrow-right2"></i>
					<div class="dropdown-content non-null head-clickable">
						<a class="dropdown-link" href="<?php echo site_url(); ?>/admin/landing">Halaman Awal</a>
						<a class="dropdown-link" href="<?php echo site_url(); ?>/admin/background">Latar Belakang</a>
						<a class="dropdown-link" href="<?php echo site_url(); ?>/admin/inquiry">Kontak Pengguna</a>
					</div>
				</div>
				<div class="dropdown">
					<button onclick="location.href='<?php echo site_url(); ?>/admin/progress'" class="dropbtn head-clickable">Daftar Suara</button>
					<div class="dropdown-content null">
					</div>
				</div>
				<div class="dropdown">
					<button class="dropbtn head-clickable"><a class="logout" id="cumalogout" onClick="document.getElementById('id02').style.display='block'">LogOut</a></button>
					<div class="dropdown-content right null">
					</div>
				</div>
			</div>
		</div> 
		<!--Start of page contents-->
		<div class="main-content" id="main-content">

			<div id="id02" class="logoutmodal">
				<form class="modal-content" action="<?php echo site_url(); ?>/logout" method="POST">
				<div class="container">
					<h2>Log Out</h2>
					<p>Apakah anda yakin ingin logout?</p>
    
					<div class="clearfix">
					<button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Tidak</button>
					<button type="submit" class="okbtn">Ya</button>
					</div>
				</div>
				</form>
			</div>
