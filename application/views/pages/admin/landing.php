	<div class="second-header">
		<h1 class="second-title">Daftar Kutipan Halaman Awal</h1>
		<button class="insert-button"><a style="text-decoration: none;" href="<?php echo site_url(); ?>/action/insert_landing"><i class="fa fa-plus"></i>Tambah Kutipan Baru</a></button>
	</div>
	<div class="newscontainer">
		<!--show query result if available-->
		<p><?php if($query_result != NULL){echo $query_result; }?></p>
		<!--data table-->
		<table class="responsive-table">
			<thead>
				<tr class="table-header">
					<th class="col col-1">NO</th>
					<th class="col col-2">Nama Sumber Kutipan</th>
					<th class="col col-3">Kutipan</th>
					<th class="col col-4">Foto</th>
					<th class="col col-5">Action</th>
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
					echo "<td class='col col-2' label='Nama Sumber Kutipan'>" . $row->name . "</td>";
					echo "<td class='col col-3' label='Kutipan'>" . $row->quote . "</td>";
					echo "<td class='col col-4' label='Foto'><img src='".base_url()."public/img/landing/".$row->image."' class='iconDetails' alt='Image'></td>";
					echo "<td class='col col-5' label='Action'><a class='fa fa-refresh' href='".site_url()."/action/update_landing/".$row->id."'></a>
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
		<form class="modal-content" action="<?php echo site_url().'/crud/delete_landing/'.$row->id; ?>" method="POST">
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
