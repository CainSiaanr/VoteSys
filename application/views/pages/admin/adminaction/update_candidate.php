<div class="form">
	<!--generate form main body according to fetched data-->
    <?php
	$row = $query;

	echo "<form id='stripe-login' action='".site_url()."/crud/update_candidate/".$row['0']->id."' method='POST' enctype='multipart/form-data'>";
			
		echo "<div class='cardLogin'>";
			echo "<div class='card-header'>";
				echo "<h1>Ubah Data Pasangan Calon</h1>";
			echo "</div>";

			echo "<div class='form-group'>";
				echo "<label for='calon_ketua' class='label'>Nama Calon Ketua :</label>";
				echo "<input type='text' name='calon_ketua' id='calon_ketua' class='field' required  value='".$row['0']->calon_ketua."'>";
			echo "</div>";

			echo "<div class='form-group'>";
				echo "<label for='calon_wakil_ketua' class='label'>Nama Calon Wakil Ketua :</label>";
				echo "<input type='text' name='calon_wakil_ketua' id='calon_wakil_ketua' class='field' required  value='".$row['0']->calon_wakil_ketua."'>";
			echo "</div>";

			echo "<div class='form-group'>";
				echo "<label for='nomor_urut_pasangan' class='label'>Nomor Urut Pasangan :</label>";
				echo "<input type='text' name='nomor_urut_pasangan' id='nomor_urut_pasangan' class='field' required  value='".$row['0']->nomor_urut_pasangan."'>";
			echo "</div>";

			echo "<div class='form-group'>";
				echo "<label for='himpunan_id' class='label'>Nama Himpunan :</label>";
				echo "<select name='himpunan_id' id='himpunan_id' class='field' required >";
				foreach($prodi as $prodi){
					if($prodi->akronim == $row['0']->nama_himpunan){
						echo "<option value='".$prodi->id."' selected>".$prodi->akronim."</option>";
					}else{
						echo "<option value='".$prodi->id."'>".$prodi->akronim."</option>";
					}
				}
				echo "</select>";
			echo "</div>";

			echo "<div class='form-group'>";
				echo "<label for='slogan' class='label'>Slogan :</label>";
				echo "<input type='text' name='slogan' id='slogan' class='field' required  value='".$row['0']->moto_slogan."'>";
			echo "</div>";

			echo "<div class='form-group'>";
				echo "<label for='visi' class='label'>Visi :</label>";
				echo "<textarea name='visi' id='visi' class='field-area' required>".$row['0']->visi."</textarea>";
			echo "</div>";

			echo "<div class='form-group'>";
				echo "<label for='misi' class='label'>Misi :</label>";
				echo "<textarea name='misi' id='misi' class='field-area' required>".$row['0']->misi."</textarea>";
			echo "</div>";
			
			echo "<div class='form-group'>";
				echo "<label for='foto_profil' class='label'>Foto Profil : </label>";
				echo "<img src='".base_url()."public/img/candidates/".$row['0']->foto_profil."' class='foto' alt='Image'>";
				echo "<input type='file' accept='image/png, image/jpeg' name='foto_profil' id='foto_profil' class='field' value='".$row['0']->foto_profil."'>";
			echo "</div>";
			
			echo "<div class='form-group'>";
				echo "<label for='foto_ballot' class='label'>Foto Ballot : </label>";
				echo "<img src='".base_url()."public/img/candidates/".$row['0']->foto_ballot."' class='foto' alt='Image'>";
				echo "<input type='file' accept='image/png, image/jpeg' name='foto_ballot' id='foto_ballot' class='field' value='".$row['0']->foto_ballot."'>";
			echo "</div>";
			
			echo "<div class='form-group'>";
				echo "<label for='link_instagram' class='label'>Link Instagram : </label>";
				echo "<input type='text' name='link_instagram' id='link_instagram' class='field' required  value='".$row['0']->link_instagram."'>";
			echo "</div>";
   
			echo "<div class='form-group buttons'>";
				echo "<button type='button' class='btn-left'><a href='".site_url()."/admin/candidate'>Kembali</a></button>";
				echo "<button type='submit' class='btn-right' name='tekan'>Submit</button>";
			echo "</div>";

		?>
		</div>
	</form>
</div>
