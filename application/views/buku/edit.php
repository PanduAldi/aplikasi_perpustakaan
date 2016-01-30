<?php foreach ($buku as $b): ?>
<div id="editbuku">
	<div class="panel panel-info">
		<div class="panel-heading">
			Form Edit Buku
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-9">
					<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Kode Buku :</label>
							<div class="col-md-2">
								<input type="text" name="kd_buku" class="form-control" value="<?php echo $b->kd_buku ?>" disabled>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Judul :</label>
							<div class="col-md-5">
								<input type="text" name="judul" class="form-control" value="<?php echo $b->judul ?>">
								<?php echo form_error('judul') ?>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Penerbit :</label>
							<div class="col-md-3">
								<input type="text" name="penerbit" class="form-control" value="<?php echo $b->penerbit ?>">
								<?php echo form_error('penerbit') ?>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Pengarang :</label>
							<div class="col-md-3">
								<input type="text" name="pengarang" class="form-control" value="<?php echo $b->pengarang ?>">
								<?php echo form_error('pengarang') ?>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Deskripsi :</label>
							<div class="col-md-9">
								<textarea name="deskripsi" rows="15"><?php echo $b->deskripsi ?></textarea>
								<?php echo form_error('deskripsi') ?>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-md-3 control-label">Cover :</label>
							<div class="col-md-3">
								<input type="file" name="cover" class="form-control">

							</div>
						</div>					
				</div>
				<div class="col-lg-3">
					<img src="<?php echo base_url('assets/img/'.$b->cover) ?>" alt="image" width="150" height="200">
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
<?php endforeach ?>