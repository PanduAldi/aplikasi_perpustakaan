<!-- Jquery ajx -->
<script>
	
	$(function(){
		//cari data peminjaman
		$("#cari").click(function(){
			var id = $("#id_anggota").val();

			if(id == "")
			{
				swal("Peringatan!!", "ID tidak boleh kosong", "error");
			}
			else
			{
				$.ajax({
					url : "<?php echo site_url('pengembalian/cariData') ?>",
					type : "POST",
					data : "id_anggota="+id,
					beforeSend : function(){
						$("#alert-loading").html('<div class="alert alert-info"><i class="fa fa-spinner fa-spin"></i> Sedang mengambil data ... </div>');
					},
					success : function(msg){
						if (msg == "") {
							swal("Info", "ID Anggota tidak ada dalam transaksi peminjaman", "error");
							$("#tampil_data").html("");
						}
						else
						{
							$("#tampil_data").html(msg);		
						}
					}
				})
			}
		});	

		
	})

</script>
<div id="pengembalian">
	<div class="panel panel-primary">
		<div class="panel-heading">
			Pengembalian Buku
		</div>
		<div class="panel-body">
			<div id="anggota">
				<div class="row">
					<div class="col-md-3">
						<input type="text" id="id_anggota" class="form-control	" placeholder="Masukan ID Anggota">
					</div>
					<div class="col-md-2">
						<p class="btn btn-primary" id="cari"><i class="fa fa-search"></i></p>
					</div>					
				</div>
			</div>
			<div class="tampil">
				<div id="tampil_data"></div>
			</div>
		</div>
	</div>
</div>