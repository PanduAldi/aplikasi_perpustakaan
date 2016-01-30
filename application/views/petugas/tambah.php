<div id="tambahbuku">
	<div class="panel panel-info">
		<div class="panel-heading">
			Form Tambah Petugas
		</div>
		<div class="panel-body">
			<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
				<div class="form-group">
					<label for="" class="col-md-3 control-label">nama :</label>
					<div class="col-md-5">
						<input type="text" name="nama" class="form-control" value="<?php echo $this->input->post('nama') ?>">
						<?php echo form_error('nama') ?>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-3 control-label">Username :</label>
					<div class="col-md-5">
						<input type="text" name="username" class="form-control" value="<?php echo $this->input->post('username') ?>">
						<?php echo form_error('username') ?>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-3 control-label">Password :</label>
					<div class="col-md-5">
						<input type="password" name="password" class="form-control" value="<?php echo $this->input->post('password') ?>">
						<?php echo form_error('password') ?>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-3 control-label">Level :</label>
					<div class="col-md-3">
						<select name="level" class="form-control">
							<option value="">--Pilih Level--</option>
							<option value="1">Admin</option>
							<option value="2">Petugas</option>
						</select>
						<?php echo form_error('level') ?>
					</div>
				</div>
		</div>
		<div class="panel-footer">
			<div class="container-fluid">
				<button class="btn btn-primary">Simpan Data</button>
				<a href="<?php echo site_url('petugas') ?>" class="btn btn-danger">Batal / Kembali</a>
			</div>
		</div>
		</form>
	</div>
</div>