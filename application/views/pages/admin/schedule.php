	<div class="container">
		<!--show query result if available-->
		<p><?php if($query_result != NULL){echo $query_result; }?></p>

		<!--schedule editor-->
		<form id="schedule-form" action="<?php echo site_url(); ?>/crud/update_schedule" method="POST">
			<!-- Header -->
			<div class="title">
				<h1>Update Jadwal</h1>
			</div>
			<!-- Start -->
			<div class="form-group" id="startdate">
				<label for="startdate" class="label">Waktu Dimulai :</label>
				<input type='date' name='startdate' class="field" value='<?php echo $start_date; ?>' required>
				<input type='time' name='starttime' class="field" value='<?php echo date_format($start_time,"H:i"); ?>' required/>
			</div>
			<!-- End -->
			<div class="form-group" id="enddate">
				<label for="enddate" class="label">Waktu Selesai :</label>
				<input type='date' name='enddate' class="field" value='<?php echo $end_date; ?>' required/>
				<input type='time' name='endtime' class="field" value='<?php echo date_format($end_time,"H:i"); ?>' required/>
			</div>
			<!-- Button -->
			<button class="submit-button" type="submit" name="tekan">Submit</button>
		</form>
	</div>
