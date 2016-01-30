<script>
	$(function(){

			//hapusbuku
			$(".hapus").click(function(){
				var kode = $(this).attr('kode');
				$.ajax({
					url : "<?php echo site_url('peminjaman/hapusBuku') ?>",
					type : "POST",
					data : "hapusid="+kode,
					success : function(html)
					{
						$(".hilang"+kode).fadeOut(100);
						swal("Hapus berhasil", "success");
					}
				})
			});
	})
</script>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Kode Buku</th>
			<th>Judul Buku</th>
			<th>Pengarang</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($tampil_buku as $t): ?>
			<tr class="hilang<?php echo $t->kd_buku ?>">
				<td><?php echo $t->kd_buku ?></td>
				<td><?php echo $t->judul ?></td>
				<td><?php echo $t->pengarang ?></td>
				<td><p class="hapus" kode="<?php echo $t->kd_buku ?>"> <i class="fa fa-trash"></i></p></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>