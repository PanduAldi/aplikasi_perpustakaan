<div id="buku">
	<div id="delay-alert">
		<?php  
			echo $this->session->flashdata('add_success');
			echo $this->session->flashdata('update_success');
			echo $this->session->flashdata('delete_success');
		?>
	</div>
	<div class="panel panel-info">
		<div class="panel-body">
			<div class="well well-sm">
				<a href="<?php echo site_url('buku/tambah') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
			</div>
			<div class="table-responsive">
				<div class="panel panel-warning">
					<div class="panel-body">
						<form action="<?php echo site_url('buku/cariData') ?>" method="post">	
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
									<th>Cover</th>
									<th>Kode Buku</th>
									<th>Judul</th>
									<th>Penerbit</th>
									<th>Pengarang</th>
									<th>Deskripsi</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($buku as $b): ?>
									<tr>
										<td>
											<?php 
												if($b->cover == "")
												{
													echo '<img src="'.base_url('assets/img/Logo.png').'" alt="" width="100" height="150">';
												} 
												else{
													echo '<img src="'.base_url('assets/img/'.$b->cover).'" alt="" width="100" height="150">';
												}
											?>
										</td>
										<td><?php echo $b->kd_buku ?></td>
										<td>
											<?php echo $b->judul ?><br>
											<a href="<?php echo site_url('buku/edit/'.$b->kd_buku) ?>">Edit</a>&nbsp;|&nbsp;
											<a href="#" class="hapus" kode="<?php echo $b->kd_buku ?>">Hapus</a>
										</td>
										<td><?php echo $b->penerbit ?></td>
										<td><?php echo $b->pengarang ?></td>
										<td width="300"><?php echo $b->deskripsi ?></td>
										<td>
											<?php  
												
												$status;

												if ($b->status == "y") {
													$status = "Tersedia";
												}
												elseif ($b->status == "n") {
													$status = "Tidak tersedia / sedang di pinjam";
												}

												echo $status;
											?>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
				<div id="paging">
					<?php echo $paging ?>
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
				url  : "<?php echo site_url('buku/hapus') ?>",
				type : "POST",
				data : "id_hapus="+kode,
				success : function(html){
					location.reload();
				} 
			});
		});
	})
</script>