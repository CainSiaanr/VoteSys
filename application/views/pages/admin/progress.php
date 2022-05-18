<div class="second-header">
		<h1 class="second-title">Daftar Suara</h1>
	</div>
	<div class="assoc-group">
		<?php
		$divider = 1;
		foreach ($prodi as $prodi){
			if($divider == 1){
				echo "<a class='assoc-selector' href='".site_url()."/admin/progress/".$prodi->id."'>".$prodi->akronim."</a>";
			}else{
				echo " / <a class='assoc-selector' href='".site_url()."/admin/progress/".$prodi->id."'>".$prodi->akronim."</a>";
			}
			$divider++;
		}
		?>
	</div>
	<div class="newscontainer">
		<!--data table-->
		<table class="responsive-table">
			<thead>
				<tr class="table-header">
					<th class="col col-1">NO</th>
					<th class="col col-2">Nama Pemberi Suara</th>
					<th class="col col-3">Pilihan</th>
					<th class="col col-4">Himpunan</th>
					<th class="col col-5">Waktu Pemilihan</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				//count for NO
				$count = 1;
				//show every fetched data
				foreach ($result as $row) {
					echo "<tr class='table-row'>";
					echo "<td class='col col-1' label='NO'>" . $count . "</td>";
					echo "<td class='col col-2' label='Nama Pemberi Suara'>" . $row->voter_name . "</td>";
					echo "<td class='col col-3' label='Tahun Angkatan Pemberi Suara'>" . $row->votee . "</td>";
					echo "<td class='col col-4' label='NIM Pemberi Suara'>" . $row->program_studi . "</td>";
					echo "<td class='col col-5' label='Himpunan Pemberi Suara'>" . $row->time_submitted . "</td>";
					echo "</tr>";
					$count++;
				}
			?>
			</tbody>
		</table>
	</div>
