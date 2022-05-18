<div class="form">
    <form id="stripe-login" action="<?php echo site_url(); ?>/crud/insert_association" method="POST" enctype="multipart/form-data">
		<div class="cardLogin">
			<div class="card-header">
				<h1>Pendaftaran Himpunan Baru</h1>
			</div>
			<div class="form-group">
				<label for="nama" class="label">Nama Himpunan :</label>
				<input type="text" name="nama" id="nama" class="field" required>
			</div>
			<div class="form-group">
				<label for="akronim" class="label">Akronim Himpunan :</label>
				<input type="text" name="akronim" id="akronim" class="field" required>
			</div>
			<div class="form-group">
				<label for="logo" class="label">Logo Himpunan : </label>
				<input type="file" accept="image/png, image/jpeg" name="logo" id="logo" class="field" required>
			</div>
			<div class="form-group" id="startdate">
				<label for="startdate" class="label">Waktu Dimulai :</label>
				<i class="fa fa-calendar" aria-hidden="true"></i><input type="date" name="tanggal_mulai" id="tanggal_mulai" class="field-date" required>
				<i class="fa fa-clock-o" aria-hidden="true"></i><input type="time" name="jam_mulai" id="jam_mulai" class="field-time" required/>
			</div>
			<div class="form-group" id="enddate">
				<label for="enddate" class="label">Waktu Selesai :</label>
				<i class="fa fa-calendar" aria-hidden="true"></i><input type="date" name="tanggal_selesai" id="tanggal_selesai" class="field-date" required/>
				<i class="fa fa-clock-o" aria-hidden="true"></i><input type="time" name="jam_selesai" id="jam_selesai" class="field-time" required/>
			</div>
			<div class="form-group buttons">
				<button type="button" class="btn-left"><a href="<?php echo site_url() ?>/admin/association">Kembali</a></button>
				<button type="submit" class="btn-right" name="tekan">Submit</button>
			</div>
		</div>
	</form>
</div>
