 <div class="form">
    <form id="stripe-login" action="<?php echo site_url(); ?>/crud/insert_candidate" method="POST" enctype="multipart/form-data">
		<div class="cardLogin">
			<div class="card-header">
				<h1>Pendaftaran Calon Organisator</h1>
			</div>
            <div class="form-group">
               <label for="calon_ketua" class="label">Nama Calon Ketua :</label>
                <input type="text" name="calon_ketua" id="calon_ketua" class="field" required>
            </div>
            <div class="form-group">
               <label for="calon_wakil_ketua" class="label">Nama Calon Wakil Ketua :</label>
                <input type="text" name="calon_wakil_ketua" id="calon_wakil_ketua" class="field" required>
            </div>
            <div class="form-group">
               <label for="nomor_urut_pasangan" class="label">Nomor Urut Pasangan :</label>
                <input type="text" name="nomor_urut_pasangan" id="nomor_urut_pasangan" class="field" required>
            </div>
            <div class="form-group">
               <label for="himpunan_id" class="label">Nama Himpunan :</label>
				<select name="himpunan_id" id="himpunan_id" class="field" required >
				<?php foreach($prodi as $prodi){
					echo "<option value='".$prodi->id."'>".$prodi->akronim."</option>";
				}?>
				</select>
            </div>
            <div class="form-group">
               <label for="slogan" class="label">Slogan : </label>
                <input type="text" name="slogan" id="slogan" class="field" required>
            </div>
            <div class="form-group">
               <label for="visi" class="label">Visi : </label>
                <textarea name="visi" id="visi" class="field-area" required></textarea>
            </div>
            <div class="form-group">
               <label for="misi" class="label">Misi : </label>
                <textarea name="misi" id="misi" class="field-area" required></textarea>
            </div>
            <div class="form-group">
               <label for="foto_profil" class="label">Foto Profil : </label>
                <input type="file" accept="image/png, image/jpeg" name="foto_profil" id="foto_profil" class="field" required>
            </div>
            <div class="form-group">
               <label for="foto_ballot" class="label">Foto Ballot : </label>
                <input type="file" accept="image/png, image/jpeg" name="foto_ballot" id="foto_ballot" class="field" required>
            </div>
            <div class="form-group">
               <label for="link_instagram" class="label">Link Instagram : </label>
                <input type="text" name="link_instagram" id="link_instagram" class="field" required>
            </div>
			<div class="form-group buttons">
				<button type="button" class="btn-left"><a href="<?php echo site_url() ?>/admin/candidate">Kembali</a></button>
				<button type="submit" class="btn-right" name="tekan">Submit</button>
			</div>
        </div>
	</form>
</div>
