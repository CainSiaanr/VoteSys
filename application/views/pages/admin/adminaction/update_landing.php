<div class="form">
	<!--generate form main body according to fetched data-->
    <?php
	$row = $query;

	echo "<form id='stripe-login' action='".site_url()."/crud/update_landing/".$row['0']->id."' method='POST' enctype='multipart/form-data'>";
			
		echo "<div class='cardLogin'>";
			echo "<div class='card-header'>";
				echo "<h1>Ubah Pesan Halaman Awal</h1>";
			echo "</div>";

			echo "<div class='form-group'>";
				echo "<label for='name' class='label'>Nama Sumber Kutipan :</label>";
				echo "<input type='text' name='name' id='name' class='field' required value='".$row['0']->name."'>";
			echo "</div>";

			echo "<div class='form-group'>";
				echo "<label for='quote' class='label'>Kutipan :</label>";
				echo "<textarea name='quote' id='quote' class='field-area' required>".$row['0']->quote."</textarea>";
			echo "</div>";
			
			echo "<div class='form-group'>";
				echo "<label for='landing' class='label'>Foto : </label>";
				echo "<img src='".base_url()."public/img/landing/".$row['0']->image."' class='foto' alt='Image'>";
				echo "<input type='file' accept='image/png, image/jpeg' class='field' name='landing' id='landing' value='".$row['0']->image."'>";
			echo "</div>";
   
			echo "<div class='form-group buttons'>";
				echo "<button type='button' class='btn-left'><a href='".site_url()."/admin/landing'>Kembali</a></button>";
				echo "<button type='submit' class='btn-right' name='tekan'>Submit</button>";
			echo "</div>";

		?>
		</div>
	</form>
</div>
