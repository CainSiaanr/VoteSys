<?php
	for($i = 0; $i < count($prodi); $i++)
	{
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
				foreach($candidate[$i] as $row){
					echo "<div class='paslon-left'>";
						//echo "<img src='".base_url()."public/img/candidates/".$prodi[$i]->akronim."/".$row->foto_profil."'>";
						echo "<div class='div-frame-paslon'>";
							echo "<div class='div-foto-paslon'>";
								echo "<img class='foto-paslon' src='".base_url()."public/img/candidates/".$row->foto_profil."'>";
							echo "</div>";
						echo "</div>";

						echo "<div class='detil-paslon'>";
							echo "<h3 class='nama-ketua'>".$row->calon_ketua."</h3>";
							echo "<h3 class='nama-wakil'>".$row->calon_wakil_ketua."</h3>";
							//echo "<p>".$row->moto_slogan."</p>";
							if($row->link_instagram != null){
								echo "<a href='".$row->link_instagram."' target='_blank'><img class='link-insta' src='".base_url()."public/img/instagram_icon.png'></a>";
							}
						echo "</div>";
					echo "</div>";
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
				foreach($candidate[$i] as $row){
					echo "<div class='paslon-right'>";
						//echo "<img src='".base_url()."public/img/candidates/".$prodi[$i]->akronim."/".$row->foto_profil."'>";
						echo "<div class='div-frame-paslon'>";
							echo "<div class='div-foto-paslon'>";
								echo "<img class='foto-paslon' src='".base_url()."public/img/candidates/".$row->foto_profil."'>";
							echo "</div>";
						echo "</div>";

						echo "<div class='detil-paslon-right'>";
							echo "<h3 class='nama-ketua'>".$row->calon_ketua."</h3>";
							echo "<h3 class='nama-wakil'>".$row->calon_wakil_ketua."</h3>";
							//echo "<p>".$row->moto_slogan."</p>";
							if($row->link_instagram != null){
								echo "<a href='".$row->link_instagram."' target='_blank'><img class='link-insta' src='".base_url()."public/img/instagram_icon.png'></a>";
							}
						echo "</div>";
					echo "</div>";
				}
				echo "</div>";
			echo "</div>";
		}
	}

?>
