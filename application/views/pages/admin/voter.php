	<div class="second-header">
		<h1 class="second-title">Daftar Pemberi Suara</h1>
	</div>
	<div class="newscontainer">
		<!--show query result if available-->
		<p><?php if($query_result != NULL){echo $query_result; }?></p>
		<!--data table-->
		<table class="responsive-table">
			<thead>
				<tr class="table-header">
					<th class="col col-1">NO</th>
					<th class="col col-2">Nama Pemberi Suara</th>
					<th class="col col-3">NIM Pemberi Suara</th>
					<th class="col col-4">Tahun Angkatan Pemberi Suara</th>
					<th class="col col-5">Himpunan Pemberi Suara</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				//count for NO
				$count = 1;
				//show every fetched data
				foreach ($query as $row) {
					echo "<tr class='table-row'>";
					echo "<td class='col col-1' label='NO'>" . $count . "</td>";
					echo "<td class='col col-2' label='Nama Pemberi Suara'>" . $row->nama . "</td>";
					echo "<td class='col col-3' label='NIM Pemberi Suara'>" . $row->nim . "</td>";
					echo "<td class='col col-4' label='Tahun Angkatan Pemberi Suara'>" . $row->tahun_angkatan . "</td>";
					echo "<td class='col col-5' label='Himpunan Pemberi Suara'>" . $row->organisasi_mahasiswa . "</td>";
					echo "</tr>";
					$count++;
				}
			?>
			</tbody>
		</table>
	</div>
