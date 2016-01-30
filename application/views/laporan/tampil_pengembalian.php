<script>
	
	$(function(){

		// lihat detail anggota
		$(".id_anggota").click(function(){
			var id_anggota = $(this).attr("kode");

			$.ajax({
				url : "<?php echo site_url('lap_pengembalian/det_anggota') ?>",
				type  : "POST",
				data  : "id_anggota="+id_anggota,
				success : function(msg){
					ex = msg.split("|");

					var nim = ex[0];
					var nama = ex[1];
					var alamat = ex[2];

					swal({
						title : "Detail Anggota",
						text : '<p>ID Anggota : '+id_anggota+'</p><br><p>NIM :'+nim+'</p><br><p>Nama : '+nama+'</p><br><p>Alamat : '+alamat+'</p>',
						confirmButtonText : "Kembali",
						html : true
					}); 
				}
			})
		});

		//lihat detail buku
		$(".kd_buku").click(function(){
			var kd_buku = $(this).attr("kd_buku");

			$.ajax({
				url : "<?php echo site_url('lap_pengembalian/det_buku') ?>",
				type : "POST",
				data : "kd_buku="+kd_buku,
				success : function(msg){
					d = msg.split("|");

					var judul = d[0];
					var penerbit = d[1];
					var pengarang = d[2];

					swal({
						title : "Detail Buku "+kd_buku,
						text : "<p>Judul: "+judul+"</p><br><p>Penerbit : "+penerbit+"</p><br><p>Pengarang : "+pengarang+"</p>",
						confirmButtonText : "Kembali",
						html : true
					});
				}

			});
		});
	})

</script>

<br>
<br>
<div id="tampil_peminjaman">
	<div class="table-responsive">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Transaksi</th>
					<th>ID Anggota</th>
					<th>Kode Buku</th>
					<th>Tanggal Pinjam</th>
					<th>Tanggal Kembali</th>
					<th>Denda</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach ($tampil_data as $data): ?>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $data->kd_peminjaman ?></td>
						<td><a href="#" class="id_anggota" kode="<?php echo $data->id_anggota ?>"><?php echo $data->id_anggota ?></a></td>
						<td><a href="#" class="kd_buku" kd_buku="<?php echo $data->kd_buku ?>"><?php echo $data->kd_buku ?></a></td>
						<td><?php echo $data->tgl_pinjam ?></td>
						<td><?php echo $data->tgl_kembali; ?></td>
						<td>
							<?php  
								echo $data->denda;
							?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>