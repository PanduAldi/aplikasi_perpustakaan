<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th width="10">No</th>
				<th>Kode Buku</th>
				<th width="300">Judul</th>
				<th>Pengarang</th>
				<th>Penerbit</th>
				<th width="200">Tanggal Masuk</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; foreach ($tampil_data as $d): ?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $d->kd_buku ?></td>
					<td><?php echo $d->judul ?></td>
					<td><?php echo $d->pengarang ?></td>
					<td><?php echo $d->penerbit ?></td>
					<td><?php echo $d->tgl_masuk ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>