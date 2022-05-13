<html>
	<!--Title declaration, importing css & js-->
    <head>
        <title>Urvoice - Sampaikan Aspirasimu!</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/header.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/footer.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/<?php echo $title; ?>.css">
		<?php 
		if($title != 'landingpage'){
			echo "<script src='".base_url()."public/js/header.js'></script>";
		}else{
			echo "<script src='".base_url()."public/js/headerlanding.js'></script>";
		}
		?>
	</head>
    <body style="margin: 0px; overflow-x: hidden; background-image: url('<?php echo base_url(); ?>public/img/background/<?php echo $background->image ?>'); background-size: cover; background-repeat: repeat;">
		<!--The header itself-->
		<?php 
		if($title != 'landingpage'){
			echo "<div class='header' id='header-colored'>";
		}else{
			echo "<div class='header' id='header'>";
		}
		?>
			<!--Urvoice logo-->
			<a href="<?php echo site_url(); ?>/home" class="logo"><img src= "<?php echo base_url(); ?>/public/img/urvoice_logo.png" width="112" height="50"></a>
			<!--Hamburger icon-->
			<a href="javascript:void(0);" class="icon" onclick="myFunction()">
				<i class="fa fa-bars"></i>
			</a>
			<!--Header tabs to other pages-->
			<div class="header-right">
				<ul>
					<li class="links head-clickable"><a href="<?php echo site_url(); ?>/home">Beranda</a></li>
					<li class="links head-clickable"><a href="<?php echo site_url(); ?>/vote">Beri Suara</a></li>
					<li class="links head-clickable"><a href="<?php echo site_url(); ?>/votingresult">Hasil Pemilu</a></li>
					<li class="links head-clickable"><a href="<?php echo site_url(); ?>/contact">Kontak</a></li>
					<?php
						if($this->input->cookie('role') != NULL){?>
							<li class="links head-clickable">
								<a onclick="document.getElementById('id02').style.display='block'">LogOut</a>
							</li>
						<?php
						}else{?>
							<li class="links head-clickable">
								<a href="<?php echo site_url(); ?>/login">Login</a>
							</li>
						<?php
						}
					?>
				</ul>
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
