<!-- jquery  -->
	
	<script>
		$(function(){

			//datepicker
			$("#tgl1").datepicker();
			$("#tgl2").datepicker();

			//tampilkan laporan
			$("#tampilkan").click(function(){
				var tgl1 = $("#tgl1").val();
				var tgl2 = $("#tgl2").val();

				

				$.ajax({
					url : "<?php echo site_url('lap_peminjaman/get_report') ?>",
					type : "POST",
					data : "tgl1="+tgl1+"&tgl2="+tgl2,
					beforeSend : function(){
						$("#tampil_data").html('<br><div class="alert alert-success"><i class="fa fa-spinner fa-spin"></i> Sedang memproses data. Tunggu sebentar...</div>');
					},
					success : function(msg){
						if (msg == "") {
							swal("Peringatan", "Data Kosong Coba Lagi", "warning");
						}
						else
						{
							$("#tampil_data").html(msg);
						}
					}
				})
			});
		})
	</script>

<!-- end -->
<div id="laporan_peminjaman">
	<div class="panel panel-success">
		<div class="panel-heading">
			Laporan Peminjaman
		</div>
		<div class="panel-body">
			<p>Masukan range periode untuk menampilkan laporan peminjaman :</p>
			<div class="col-lg-6">
				<div class="row">
					<div class="col-md-5">
						<input type="text" id='tgl1' class="form-control" placeholder = 'Input tanggal 1'>
					</div>
					<div class="col-md-5">
						<input type="text" id="tgl2" class="form-control" placeholder="Input tgl 2">
					</div>
					<div class="col-md-2">
						<button class="btn btn-primary" id="tampilkan"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</div>

			<div class="col-md-12">
				<div id="tampil_data"></div>				
			</div>
		</div>
	</div>
</div>