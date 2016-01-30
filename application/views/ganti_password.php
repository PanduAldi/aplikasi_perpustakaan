<div id="gantipassword">
	<div class="alert-delay">
		<?php 
			echo $this->session->flashdata('success'); 
			echo $this->session->flashdata('gagal');
		?>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<i class="fa fa-key"></i> Ganti Password
		</div>
		<form action="<?php echo site_url('dashboard/gantiPassword') ?>" class="form-horizontal" method="POST">
			<div class="panel-body">
				<div class="form-group">
					<label for="" class="col-md-3 control-label">Password Lama :</label>
					<div class="col-md-4">
						<input type="password" class="form-control" name="old" value="<?php echo $this->input->post('old') ?>">
						<?php echo form_error('old') ?>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-3 control-label">Password Baru :</label>
					<div class="col-md-4">
						<input type="password" class="form-control" name="new" value="<?php echo $this->input->post('new') ?>">
						<?php echo form_error('new') ?>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-3 control-label">Konfirmasi Password :</label>
					<div class="col-md-4">
						<input type="password" class="form-control" name="conf" value="<?php echo $this->input->post('conf') ?>">
						<?php echo form_error('conf') ?>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-3 control-label"></label>
					<div class="col-md-4">
						<button class="btn btn-primary">Simpan</button>
						<a href="<?php echo site_url('dashboard') ?>" class="btn btn-danger">Batal</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	$(function(){
		$('.alert-delay').delay(2000).fadeOut(2000);
	});
</script>