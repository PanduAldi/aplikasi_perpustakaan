<div id="tambahbuku">
	<div class="panel panel-info">
		<div class="panel-heading">
			Form Tambah Anggota
		</div>
		<div class="panel-body">
			<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
				<div class="form-group">
					<label for="" class="col-md-3 control-label">Id Anggota :</label>
					<div class="col-md-3">
						<input type="text" name="id_anggota" class="form-control" value="<?php echo $autonumber ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-3 control-label">NIM :</label>
					<div class="col-md-2">
						<input type="text" name="nim" class="form-control" value="<?php echo $this->input->post('nim') ?>">
						<?php echo form_error('nim') ?>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-3 control-label">nama :</label>
					<div class="col-md-5">
						<input type="text" name="nama" class="form-control" value="<?php echo $this->input->post('nama') ?>">
						<?php echo form_error('nama') ?>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-3 control-label">alamat :</label>
					<div class="col-md-5">
						<input type="text" name="alamat" class="form-control" value="<?php echo $this->input->post('alamat') ?>">
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
				<a href="<?php echo site_url('anggota') ?>" class="btn btn-danger">Batal / Kembali</a>
			</div>
		</div>
		</form>
	</div>
</div>