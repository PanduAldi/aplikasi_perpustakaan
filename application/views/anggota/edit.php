<?php foreach ($anggota as $a): ?>
<div id="row">
	<div class="col-md-10">
		<div class="panel panel-info">
			<div class="panel-heading">
				Form Edit Anggota
			</div>
			<div class="panel-body">
				<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="form-group">
						<label for="" class="col-md-3 control-label">NIM :</label>
						<div class="col-md-2">
							<input type="text" name="nim" class="form-control" value="<?php echo $a->nim ?>">
							<?php echo form_error('nim') ?>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-md-3 control-label">Nama :</label>
						<div class="col-md-5">
							<input type="text" name="nama" class="form-control" value="<?php echo $a->nama ?>">
							<?php echo form_error('nama') ?>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-md-3 control-label">Alamat :</label>
						<div class="col-md-5">
							<input type="text" name="alamat" class="form-control" value="<?php echo $a->alamat ?>">
							<?php echo form_error('alamat') ?>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-md-3 control-label">Foto :</label>
						<div class="col-md-3">
							<input type="file" name="foto" class="form-control">
						</div>
					</div>
			</div>
			<div class="panel-footer">
				<div class="container-fluid">
					<button class="btn btn-primary">Simpan Data</button>
					<a href="<?php echo site_url('buku') ?>" class="btn btn-danger">Batal / Kembali</a>
				</div>
			</div>
			</form>
		</div>		
	</div>

	<div class="col-md-2">
		<img src="<?php echo base_url('assets/img/anggota/'.$a->foto) ?>" class="img-rounded" alt="" width="100" height="150">
	</div>
</div>	
<?php endforeach ?>
