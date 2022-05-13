<div class="form">
    <form id="stripe-login" action="<?php echo site_url(); ?>/crud/insert_landing" method="POST" enctype="multipart/form-data">
		<div class="cardLogin">
			<div class="card-header">
				<h1>Menambahkan Kutipan Halaman Awal</h1>
			</div>
            <div class="form-group">
                <label for="name" class="label">Nama Sumber Kutipan :</label>
                <input type="text" name="name" id="name" class="field" required>
            </div>
            <div class="form-group">
				<label for="quote" class="label">Kutipan :</label>
				<textarea name="quote" id="quote" class="field-area" required></textarea>
            </div>
            <div class="form-group">
                <label for="landing" class="label">Foto : </label>
                <input type="file" accept="image/png, image/jpeg" name="landing" id="landing" class="field" required>
            </div>
			<div class="form-group buttons">
				<button type="button" class="btn-left"><a href="<?php echo site_url() ?>/admin/landing">Kembali</a></button>
				<button type="submit" class="btn-right" name="tekan">Submit</button>
			</div>
        </div>
	</form>
</div>
