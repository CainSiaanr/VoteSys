	<div class="container">
		<!--show query result if available-->
		<p><?php if($query_result != NULL){echo $query_result; }?></p>
		<!--background editor-->
		<form id="background-form" action="<?php echo site_url(); ?>/crud/update_background" method="POST" enctype="multipart/form-data">
			<div class="title">
				<h1>Update Background</h1>
			</div>
			<!-- File -->
			<div class="form-group">
				<label for="background" class="label"></label>
				<input type='file' class="field" accept='image/png, image/jpeg' name='background' />
			</div>
			<!-- Button -->
			<button class="submit-button" type="submit" name="tekan">Submit</button>
		</form>
	</div>
