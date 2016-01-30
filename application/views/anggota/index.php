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
				<a href="<?php echo site_url('anggota/tambah') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
			</div>
			<div class="table-responsive">
				<div class="panel panel-warning">
					<div class="panel-body">
						<form action="<?php echo site_url('buku/cariData') ?>" method="post">	
						<div class="col-sm-4 pull-right">
							<div class="form-group pull-right">
							  <div class="input-group">
							    <input type="text" class="form-control" placeholder="cari berdasarkan nama">
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
									<th>Foto</th>
									<th>id Anggota</th>
									<th>NIM</th>
									<th>Nama</th>
									<th>Alamat</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($anggota as $a): ?>
									<tr>
										<td>
											<?php 
												if($a->foto == "")
												{
													echo '<img src="'.base_url('assets/img/no_photo.png').'" alt="" width="100" height="150">';
												} 
												else{
													echo '<img src="'.base_url('assets/img/anggota/'.$a->foto).'" alt="" width="100" height="150">';
												}
											?>											
										</td>
										<td><?php echo $a->id_anggota ?></td>
										<td><?php echo $a->nim ?></td>
										<td><?php echo $a->nama ?>
										<br>
											<a href="<?php echo site_url('anggota/edit/'.$a->id_anggota) ?>">Edit</a>&nbsp;|&nbsp;
											<a href="#" class="hapus" kode="<?php echo $a->id_anggota ?>">Hapus</a>
										</td>
										<td><?php echo $a->alamat ?></td>
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
		$('#delay-alert').delay(2000).hide(100);

		//delete buku
		$('.hapus').click(function(){
			var kode = $(this).attr('kode');
			$('#idhapus').val(kode);
			$('#modal-delete').modal('show');
		});

		$('#konfirmasi').click(function(){
			var kode = $("#idhapus").val();

			$.ajax({
				url  : "<?php echo site_url('anggota/hapus') ?>",
				type : "POST",
				data : "id_hapus="+kode,
				success : function(html){
					location.reload();
				} 
			});
		});
	})
</script>