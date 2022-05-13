<div class="form">
	<!--generate form main body according to fetched data-->
    <?php
	$statuses = array("Baru", "Diproses", "Selesai");

	$row = $query;

	echo "<form id='stripe-login' action='".site_url()."/crud/update_inquiry/".$row['0']->id."' method='POST' enctype='multipart/form-data'>";
	
		echo "<div class='cardLogin'>";
			echo "<div class='card-header'>";
				echo "<h1>Manajemen Pesan Pengguna</h1>";
			echo "</div>";

			echo "<div class='form-group'>";
				echo "<label for='sender' class='label'>Nama Pengirim :</label>";
				echo "<input type='text' name='sender' id='sender' class='field readonly' required readonly value='".$row['0']->sender."'>";
			echo "</div>";

			echo "<div class='form-group'>";
				echo "<label for='email' class='label'>Alamat Email :</label>";
				echo "<input type='text' name='email' id='email' class='field readonly' required readonly value='".$row['0']->email."'>";
			echo "</div>";

			echo "<div class='form-group'>";
				echo "<label for='subject' class='label'>Subjek Pesan :</label>";
				echo "<input type='text' name='subject' id='subject' class='field readonly' required readonly value='".$row['0']->subject."'>";
			echo "</div>";

			echo "<div class='form-group'>";
				echo "<label for='detail' class='label'>Detil Pesan :</label>";
				echo "<textarea name='detail' id='detail' class='field-area readonly' required readonly>".$row['0']->detail."</textarea>";
			echo "</div>";

			echo "<div class='form-group'>";
				echo "<label for='status' class='label'>Status Pesan :</label>";
				echo "<select name='status' id='status' class='field' required >";
				foreach($statuses as $statuses){
					if($statuses == $row['0']->status){
						echo "<option value='".$statuses."' selected>".$statuses."</option>";
					}else{
						echo "<option value='".$statuses."'>".$statuses."</option>";
					}
				}
				echo "</select>";
			echo "</div>";

			echo "<div class='form-group'>";
				echo "<label for='last_changed' class='label'>Terakhir Diubah :</label>";
				echo "<input type='text' name='last_changed' id='last_changed readonly' class='field readonly' required readonly value='".$row['0']->last_changed."'>";
			echo "</div>";

			echo "<div class='form-group'>";
				echo "<label for='note' class='label'>Catatan Admin :</label>";
				echo "<input type='text' name='note' id='note' class='field' value='".$row['0']->note."'>";
			echo "</div>";
   
			echo "<div class='form-group buttons'>";
				echo "<button type='button' class='btn-left'><a href='".site_url()."/admin/inquiry'>Kembali</a></button>";
				echo "<button type='submit' class='btn-right' name='tekan'>Submit</button>";
			echo "</div>";

		?>
		</div>
	</form>
</div>
