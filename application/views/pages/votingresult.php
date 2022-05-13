<?php 
	
	if($prodi != null && $result != null && $count != null){
		for($i = 0; $i < count($prodi); $i++){
			if($i % 2 == 0){
				echo "<div class='calon-himpunan-left'>";
					echo "<div class='himpunan-left'>";
						echo "<img class='logo-himpunan' src='".base_url()."public/img/association/".$prodi[$i]->logo."'>";
						echo "<div class='info-himpunan'>";
							echo "<h1 class='akronim-himpunan'>".$prodi[$i]->akronim."</h1>";
							echo "<h3 class='nama-himpunan'>".$prodi[$i]->nama."</h3>";
						echo "</div>";
					echo "</div>";
					echo "<div class='calon'>";

					$increment = 1;
					foreach($candidate[$i] as $row){
						echo "<div class='paslon-left'>";
							echo "<div class='div-frame-paslon'>";
								echo "<div class='div-foto-paslon'>";
									echo "<img class='foto-paslon' src='".base_url()."public/img/candidates/".$row->foto_profil."'>";
								echo "</div>";
							echo "</div>";

							echo "<div class='detil-paslon'>";
								echo "<h3 class='nama-ketua'>".$row->calon_ketua."</h3>";
								echo "<h3 class='nama-wakil'>".$row->calon_wakil_ketua."</h3>";
								if($increment == 1){
									echo "<p>".$result[$i]." suara/".$count[$i]." total pemberi suara himpunan</p>";
								}else if($increment == 2){
									echo "<p>".($count[$i]-$result[$i])." suara/".$count[$i]." total pemberi suara himpunan</p>";
								}else{
									echo "<p>Terjadi Kesalahan Pada Sistem</p>";
								}
							echo "</div>";
						echo "</div>";
						$increment++;
					}
					echo "</div>";
				echo "</div>";
			}else{
				echo "<div class='calon-himpunan-right'>";
					echo "<div class='himpunan-right'>";
						echo "<img class='logo-himpunan' src='".base_url()."public/img/association/".$prodi[$i]->logo."'>";
						echo "<div class='info-himpunan'>";
							echo "<h1 class='akronim-himpunan'>".$prodi[$i]->akronim."</h1>";
							echo "<h3 class='nama-himpunan'>".$prodi[$i]->nama."</h3>";
						echo "</div>";
					echo "</div>";
					echo "<div class='calon'>";
					$increment = 1;
					foreach($candidate[$i] as $row){
						echo "<div class='paslon-right'>";
							echo "<div class='div-frame-paslon'>";
								echo "<div class='div-foto-paslon'>";
									echo "<img class='foto-paslon' src='".base_url()."public/img/candidates/".$row->foto_profil."'>";
								echo "</div>";
							echo "</div>";

							echo "<div class='detil-paslon-right'>";
								echo "<h3 class='nama-ketua'>".$row->calon_ketua."</h3>";
								echo "<h3 class='nama-wakil'>".$row->calon_wakil_ketua."</h3>";
								if($increment == 1){
									echo "<p>".$result[$i]." suara/".$count[$i]." total pemberi suara himpunan</p>";
								}else if($increment == 2){
									echo "<p>".($count[$i]-$result[$i])." suara/".$count[$i]." total pemberi suara himpunan</p>";
								}else{
									echo "<p>Terjadi Kesalahan Pada Sistem</p>";
								}
							echo "</div>";
						echo "</div>";
						$increment++;
					}
					echo "</div>";
				echo "</div>";
			}
		} 
	}else{
	?>
	<div id="id01" class="modal">
		<form class="modal-content" action="<?php echo site_url(); ?>/home" method="POST">
		<div class="container">
			<h2>Pemberian Suara Sedang Berlangsung</h2>
			<p>Masa pemungutan suara sedang berlangsung. <br> Mohon tunggu hasil pemungutan suara pada tanggal <?php echo date_format($enddate,"j-F-Y")." jam ".date_format($enddate,"H:i"); ?></p>
    
			<div class="clearfix">
			<button type="submit" class="modalbtn">OK</button>
			</div>
		</div>
		</form>
	</div>

	<?php
	}
?>
