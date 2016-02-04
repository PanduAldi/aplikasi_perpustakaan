<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Id Anggota</th>
				<th>NIM</th>
				<th>Nama</th>
				<th>Alamat</th>
				<th>Tgl Daftar</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1; foreach ($tampil_data as $d): ?>
				<tr>
					<td width="30"><?php echo $d->id_anggota ?></td>
					<td width="30"><?php echo $d->nim ?></td>
					<td><?php echo $d->nama ?></td>
					<td><?php echo $d->alamat ?></td>
					<td><?php echo $d->tgl_daftar ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>