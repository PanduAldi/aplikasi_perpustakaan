<?php foreach ($petugas as $p): ?>

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
						<input type="text" name="nama" class="form-control" value="<?php echo $p->nama ?>">
						<?php echo form_error('nama') ?>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-3 control-label">Username :</label>
					<div class="col-md-5">
						<input type="text" name="username" class="form-control" value="<?php echo $p->username ?>">
						<?php echo form_error('username') ?>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-3 control-label">Level :</label>
					<div class="col-md-3">
						<select name="level" class="form-control">
							<option value="">--Pilih Level--</option>
							<?php  
								$array = array('1' =>'admin', '2' => 'petugas');
								foreach ($array as $value => $text) {
									$selected = ($value == $p->level)?"selected":"";
									echo '<option value="'.$value.'" '.$selected.'>'.ucwords($text).'</option>';
								}
							?>
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
	
<?php endforeach ?>