<script>
	
	// jquery
	$(function() {

		//tgl
		$("#tgl1").datepicker({
			format : "yyyy-mm-dd"
		});
		$('#tgl2').datepicker({
			format : "yyyy-mm-dd"
		});

		$("#cari").click(function(){
			var tgl1 = $("#tgl1").val();
			var tgl2 = $("#tgl2").val();

			$.ajax({
				url : "<?php echo site_url('lap_anggota/get_report') ?>",
				type : "POST",
				data : {tgl1 : tgl1, tgl2 : tgl2},
				beforeSend : function(msg){
					$("#tampil").html('<div class="alert alert-success"><i class="fa fa-spinner fa-spin"></i> Sedang memproses data ...</div>');
				},
				success : function(msg){
					if (msg == "") {
						$("#tampil").html('<tr><td colspan="5" align="center">Data tidak ada ... !!!</td></tr>');
					}
					else
					{
						$("#tampil").html(msg);
					}
				}
			})
		});

	})
</script>
<div id="laporan_anggota">
	<div class="panel panel-primary">
		<div class="panel-heading">
			Laporan Anggota
		</div>
		<div class="panel-body">
			<p>Masukan range tanggal periode pendaftaran anggota :</p>
			<div class="col-lg-12">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-5">
							<input type="text" class="form-control" id="tgl1" placeholder = "Masukan tanggal 1">
						</div>
						<div class="col-md-5">
							<input type="text" class="form-control" id="tgl2" placeholder = "Masukan tanggal 2">
						</div>
						<div class="col-md-2">
							<button class="btn btn-primary" id="cari"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12"><hr></div>
			<div class="col-lg-12">
				<div id="loading"></div>
				<div id="tampil">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>NIM</th>
								<th>Nama</th>
								<th>Alamat</th>
								<th>Tgl Pendaftaran</th>
							</tr>
						</thead>
						<tbody id="kosong">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

