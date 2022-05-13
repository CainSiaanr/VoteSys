	<div class="second-header">
		<h1 class="second-title">Daftar Pesan Pengguna</h1>
	</div>
	<div class="newscontainer">
		<!--show query result if available-->
		<p><?php if($query_result != NULL){echo $query_result; }?></p>
		<!--data table-->
		<table class="responsive-table">
			<thead>
				<tr class="table-header">
					<th class="col col-1">NO</th>
					<th class="col col-2">Nama Pengirim</th>
					<th class="col col-3">Subjek Pesan</th>
					<th class="col col-4">Status Pesan</th>
					<th class="col col-5">Terakhir Diubah</th>
					<th class="col col-6">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				//count for NO
				$count = 1;
				//show every fetched data
				foreach ($query as $row) {
					$lastchanged = new DateTime($row->last_changed);
					echo "<tr class='table-row'>";
					echo "<td class='col col-1' label='NO'>" . $count . "</td>";
					echo "<td class='col col-2' label='Nama Pengirim'>" . $row->sender . "</td>";
					echo "<td class='col col-3' label='Subjek Pesan'>" . $row->subject . "</td>";
					echo "<td class='col col-4' label='Status Pesan'>" . $row->status . "</td>";
					echo "<td class='col col-5' label='Terakhir Diubah'>" . date_format($lastchanged,"j F Y H:i") . "</td>";
					echo "<td class='col col-6' label='Action'><a class='fa fa-refresh' href='".site_url()."/action/update_inquiry/".$row->id."'></a>
                    <a class='fa fa-trash' onClick=\"document.getElementById('deletemodal".$row->id."').style.display='block'\"></a></td>";
					echo "</tr>";
					$count++;
				}
			?>
			</tbody>
		</table>
	</div>

	<?php 
	foreach ($query as $row) { ?>
	<div id="deletemodal<?php echo $row->id ?>" class="deletemodal">
		<form class="modal-content" action="<?php echo site_url().'/crud/delete_inquiry/'.$row->id; ?>" method="POST">
			<div class="container">
				<h2>Konfirmasi Penghapusan</h2>
				<p>Apakah anda yakin ingin menghapus data himpunan ini?</p>
    
				<div class="clearfix">
					<button type="button" onclick="document.getElementById('deletemodal<?php echo $row->id ?>').style.display='none'" class="cancelbtn">Tidak</button>
					<button type="submit" class="okbtn">Ya</button>
				</div>
			</div>
		</form>
	</div>
	<?php 
	}
	?>
