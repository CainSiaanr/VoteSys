<?php 
	$printed = 0;
	for($i = 0; $i < count($prodi); $i++){
		if($candidate[$i] != null && $result[$i] != null && $count[$i] != null){
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

					$increment = 0;
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
								/*if($increment == 1){
									echo "<p class='percent'>".round((float)(($result[$i]/$count[$i])*100), 2)."%</p>";
									echo "<p class='number'>".$result[$i]."/".$count[$i]."</p>";
									echo "<p class='number'>Pemberi Suara</p>";
								}else if($increment == 2){
									echo "<p class='percent'>".round((float)((($count[$i]-$result[$i])/$count[$i])*100), 2)."%</p>";
									echo "<p class='number'>".($count[$i]-$result[$i])."/".$count[$i]."</p>";
									echo "<p class='number'>Pemberi Suara</p>";
								}else{
									echo "<p>Terjadi Kesalahan Pada Sistem</p>";
								}*/
								echo "<div class='circle'>";
									echo "<p class='percent'>".round((float)(((int)substr($result[$i], (4*$increment)-1, 1)/$count[$i])*100), 2)."%</p>";
								echo "</div>";
								echo "<p class='number'>".substr($result[$i], (4*$increment)-1, 1)."/".$count[$i]."</p>";
								echo "<p class='number'>Pemberi Suara</p>";
							echo "</div>";
						echo "</div>";
						$increment--;
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

					$increment = 0;
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
								/*if($increment == 1){
									echo "<p class='percent'>".round((float)(($result[$i]/$count[$i])*100), 2)."%</p>";
									echo "<p class='number'>Jumlah Pemilih : ".$result[$i]."</p>";
									echo "<p class='number'>Total Jumlah Suara : ".$count[$i]."</p>";
								}else if($increment == 2){
									echo "<p class='percent'>".round((float)((($count[$i]-$result[$i])/$count[$i])*100), 2)."%</p>";
									echo "<p class='number'>Jumlah Pemilih : ".($count[$i]-$result[$i])."</p>";
									echo "<p class='number'>Total Jumlah Suara : ".$count[$i]."</p>";
								}else{
									echo "<p>Terjadi Kesalahan Pada Sistem</p>";
								}*/
								
								echo "<p class='percent'>".round((float)(((int)substr($result[$i], (4*$increment)-1, 1)/$count[$i])*100), 2)."%</p>";
								echo "<p class='number'>Jumlah Pemilih : ".substr($result[$i], (4*$increment)-1, 1)."</p>";
								echo "<p class='number'>Total Jumlah Suara : ".$count[$i]."</p>";
							echo "</div>";
						echo "</div>";
						$increment--;
					}
					echo "</div>";
				echo "</div>";
			}
			$printed++;
		} 
	}

	if($printed == 0){
	?>
	<div id="id01" class="modal">
		<form class="modal-content" action="<?php echo site_url(); ?>/home" method="POST">
		<div class="container">
			<h2>Tidak Ada Hasil Suara</h2>
			<p>Belum ada himpunan yang menyelesaikan pemilunya. Mohon cek jadwal pelaksanaan pemilu di media sosial KPU UMN.</p>
    
			<div class="clearfix">
			<button type="submit" class="modalbtn">OK</button>
			</div>
		</div>
		</form>
	</div>

	<?php
	}
?>
