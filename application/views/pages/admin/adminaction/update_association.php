<div class="form">
	<!--generate form main body according to fetched data-->
    <?php
	$row = $query;

	echo "<form id='stripe-login' action='".site_url()."/crud/update_association/".$row['0']->id."' method='POST' enctype='multipart/form-data'>";
			
		echo "<div class='cardLogin'>";
			echo "<div class='card-header'>";
				echo "<h1>Ubah Data Himpunan</h1>";
			echo "</div>";

			echo "<div class='form-group'>";
				echo "<label for='nama' class='label'>Nama Himpunan :</label>";
				echo "<input type='text' name='nama' id='nama' class='field' required value='".$row['0']->nama."'>";
			echo "</div>";

			echo "<div class='form-group'>";
				echo "<label for='akronim' class='label'>Akronim Himpunan :</label>";
				echo "<input type='text' name='akronim' id='akronim' class='field' required value='".$row['0']->akronim."'>";
			echo "</div>";
			
			echo "<div class='form-group'>";
				echo "<label for='logo' class='label'>Logo Himpunan : </label>";
				echo "<img src='".base_url()."public/img/association/".$row['0']->logo."' class='foto' alt='Image'>";
				echo "<input type='file' accept='image/png, image/jpeg' name='logo' id='logo' class='field' value='".$row['0']->logo."'>";
			echo "</div>";

			echo "<div class='form-group' id='startdate'>";
				echo "<label for='startdate' class='label'>Waktu Dimulai :</label>";
				echo "<i class='fa fa-calendar' aria-hidden='true'></i><input type='date' name='tanggal_mulai' id='tanggal_mulai' class='field-date' value='".$row['0']->tanggal_mulai."' required>";
				echo "<i class='fa fa-clock-o' aria-hidden='true'></i><input type='time' name='jam_mulai' id='jam_mulai' class='field-time' value='".$row['0']->jam_mulai."' required/>";
			echo "</div>";
			
			echo "<div class='form-group' id='startdate'>";
				echo "<label for='enddate' class='label'>Waktu Selesai :</label>";
				echo "<i class='fa fa-calendar' aria-hidden='true'></i><input type='date' name='tanggal_selesai' id='tanggal_selesai' class='field-date' value='".$row['0']->tanggal_selesai."' required/>";
				echo "<i class='fa fa-clock-o' aria-hidden='true'></i><input type='time' name='jam_selesai' id='jam_selesai' class='field-time' value='".$row['0']->jam_selesai."' required/>";
			echo "</div>";
   
			echo "<div class='form-group buttons'>";
				echo "<button type='button' class='btn-left'><a href='".site_url()."/admin/association'>Kembali</a></button>";
				echo "<button type='submit' class='btn-right' name='tekan'>Submit</button>";
			echo "</div>";

		?>
		</div>
	</form>
</div>
