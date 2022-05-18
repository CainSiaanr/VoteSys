<?php 
if($role != null){
	if($candidate != null){
		if($voted != true){
?>

<h1 class="himpunan-title"><?php echo strtoupper($prodi['0']->akronim); ?></h1>

<div class="candidate-list">
    <?php
	$count = 1;
    foreach ($candidate as $row){
		
        echo "<a onClick=\"document.getElementById('votemodal".$count."').style.display='block'\" class='vote-link'><div class='candidate-card'>";
			echo "<p class='number'>".$row->nomor_urut_pasangan."</p>";
			echo "<div class='candidate-image-box'>";
				echo "<img src='".base_url()."public/img/candidates/".$row->foto_ballot."' class='candidate-image' alt='Image'>";
			echo "</div>";
			echo "<div class='candidate-name'>";
				echo "<h2 class='title'><b>".$row->calon_ketua."</b></h2>";
				echo "<h3 class='title'><b>".$row->calon_wakil_ketua."</b></h3>";
			echo "</div>";
        echo "</div></a>";
        $count = $count*10000;
    }
    ?>
</div>

<?php 
$count = 1;
for($i = 1; $i <= count($candidate); $i++) { ?>
<div id="votemodal<?php echo $count ?>" class="votemodal">
	<form class="modal-content" action="<?php echo site_url().'/savevote/save_vote/'.$count; ?>" method="POST">
		<div class="container">
			<h2>Konfirmasi Pemilihan</h2>
			<p>Apakah anda yakin ingin memilih pasangan calon nomor urut <?php echo $i?>?</p>
    
			<div class="clearfix">
				<button type="button" onclick="document.getElementById('votemodal<?php echo $count ?>').style.display='none'" class="cancelbtn">Tidak</button>
				<button type="submit" class="okbtn">Ya</button>
			</div>
		</div>
	</form>
</div>
<?php 
    $count = $count*10000;
}
?>

<?php 
}else{
?>
<div id="id01" class="modal">
  <form class="modal-content" action="<?php echo site_url(); ?>/home" method="POST">
    <div class="container">
      <h2>Anda Sudah Memberikan Suara</h2>
      <p>Terima Kasih Atas Partisipasi Anda dalam Bulan Demokrasi. <br> Mohon Tunggu Hasil Voting Pada <?php echo date_format($enddate,"j-F-Y H:i"); ?></p>
    
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
}else{
?>
<div id="id01" class="modal">
  <form class="modal-content" action="<?php echo site_url(); ?>/home" method="POST">
    <div class="container">
      <h2>Pemberian Suara Belum Dimulai</h2>
      <p>Pemberian Suara Belum Dimulai, Mohon Mengecek Jadwal Pemberian Suara.</p>
    
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
}else{
?>
<div id="id01" class="modal">
  <form class="modal-content" action="<?php echo site_url(); ?>/login" method="POST">
    <div class="container">
      <h2>Akses Terlarang</h2>
      <p>Mohon Login Terlebih Dahulu Sebelum Memberikan Suara.</p>
    
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
  <form class="modal-content" action="<?php echo site_url(); ?>/home" method="POST">
    <div class="container">
      <?php echo "<p>".$query_result."</p>"; ?>
    
      <div class="clearfix">
        <button type="submit" class="modalbtn">OK</button>
      </div>
    </div>
  </form>
</div>

<?php
}
?>
