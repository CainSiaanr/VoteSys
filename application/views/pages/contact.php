<?php
if($name != null){
?>
<div class="form">
	<form id="stripe-login" action="<?php echo site_url(); ?>/inquiry" method="POST">
		<div class="cardLogin">
			<div class="card-header">
				<h1 class="title">Kontak</h1>
				<h3 class="tip">Kamu punya keluhan, saran, atau masukan?</h3>
				<h3 class="tip">Sampaikan semuanya disini!</h3>
			</div>
			<!-- Email -->
			<div class="form-group">
				<label for="email" class="label">Alamat Email :</label>
				<input type="email" name="email" id="email" class="field" required>
			</div>
			<!-- Subject -->
			<div class="form-group">
				<label for="subject" class="label">Subjek :</label>
				<input type="text" name="subject" id="subject" class="field" required>
			</div>
			<!-- Detail -->
			<div class="form-group">
				<label for="detail" class="label">Deskripsi :</label>
				<textarea name="detail" id="detail" class="field-area" required></textarea>
			</div>
			<!-- Button -->
			<div class="form-group">
				<button type="submit" class="btn" name="tekan">Submit</button>
			</div>
		</div>
	</form>
</div>

<?php 
}else{
?>
<div id="id01" class="modal">
  <form class="modal-content" action="<?php echo site_url(); ?>/login" method="POST">
    <div class="container">
      <h2>Akses Terlarang</h2>
      <p>Mohon Login Terlebih Dahulu Sebelum Mengirimkan Pesan</p>
    
      <div class="clearfix">
        <button type="submit" class="modalbtn">OK</button>
      </div>
    </div>
  </form>
</div>

<?php
}
?>

<?php 
if($query_result != NULL){
?>
<div id="id01" class="modal">
  <form class="modal-content">
    <div class="container">
      <?php echo "<p>".$query_result."</p>"; ?>
    
      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="modalbtn">OK</button>
      </div>
    </div>
  </form>
</div>

<?php
}
?>
