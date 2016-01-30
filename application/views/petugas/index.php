<div id="buku">
	<div id="delay-alert">
		<?php  
			echo $this->session->flashdata('add_success');
			echo $this->session->flashdata('update_success');
			echo $this->session->flashdata('delete_success');
			echo $this->session->flashdata('reset_success');
		?>
	</div>
	<div class="panel panel-info">
		<div class="panel-body">
			<div class="well well-sm">
				<a href="<?php echo site_url('petugas/tambah') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
			</div>
			<div class="table-responsive">
				<div class="panel panel-warning">
					<div class="panel-body">
						<form action="<?php echo site_url('petugas/cariData') ?>" method="post">	
						<div class="col-sm-4 pull-right">
							<div class="form-group pull-right">
							  <div class="input-group">
							    <input type="text" class="form-control" placeholder="cari berdasarkan judul / kode">
							    <span class="input-group-btn">
							      <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
							    </span>
							  </div>
							</div>
						</div>
						</form>
						<table class="table table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Username</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1; foreach ($petugas as $p): ?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td>
											<?php echo $p->nama ?><br>
											<a href="<?php echo site_url('petugas/edit/'.$p->id_user) ?>">Edit</a>&nbsp;|&nbsp;
											<a href="#" class="hapus" kode="<?php echo $p->id_user ?>">Hapus</a>&nbsp;|&nbsp;
											<a href="#" class="reset_pass" kode="<?php echo $p->id_user ?>" pass="<?php echo $p->username ?>">Reset Password </a>
										</td>
										<td width="500"><?php echo $p->username ?></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>			
			</div>
		</div>
</div>

<script>
	$(function(){

		//delay alert
		$('#delay-alert').delay(2000).fadeOut(2000);

		//delete buku
		$('.hapus').click(function(){
			var kode = $(this).attr('kode');
			$('#idhapus').val(kode);
			$('#modal-delete').modal('show');
		});

		$('#konfirmasi').click(function(){
			var kode = $("#idhapus").val();

			$.ajax({
				url  : "<?php echo site_url('petugas/hapus') ?>",
				type : "POST",
				data : "id_hapus="+kode,
				success : function(html){
					location.reload();
				} 
			});
		});

		// reset password
		$('.reset_pass').click(function(){
			var kode = $(this).attr('kode');
			var pass = $(this).attr('pass');

			$.ajax({
				url  : "<?php echo site_url('petugas/resetPassword') ?>",
				type : "POST",
				data : "id_reset="+kode+"&pass="+pass,
				success : function(html){
					location.reload();
				}
			});
		});
	})
</script>