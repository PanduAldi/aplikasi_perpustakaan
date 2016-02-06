<!-- Scrip jQuery & Ajax -->
<script>
	
	$(function(){

		//datepicker
		$('#tgl1').datepicker({format:"yyyy-mm-dd"});
		$('#tgl2').datepicker({format:"yyyy-mm-dd"});

		$("#cari").click(function(){
			var tgl1 = $("#tgl1").val();
			var tgl2 = $("#tgl2").val();

			$.ajax({
				url : "<?php echo site_url('lap_buku/get_report') ?>",
				type : "POST",
				data : {tgl1:tgl1, tgl2:tgl2},
				beforeSend : function(){
					$("#tampil_data").html('<div class="alert alert-success"><i class="fa fa-spinner fa-spin"></i> Sedang memproses data .. </div>');
				},
				success : function(msg){
					if (msg == "") {
						$('#tampil_data').html('Data tidak ditemukan');
					}
					else 
					{
						$("#tampil_data").html(msg);
					}
				}
			});
		});
	})
</script>
<!-- end -->

<div id="lap_buku">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<?php echo $title ?>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-12">
					<div class="col-md-6">
						<p>Masukan range tanggal buku masuk : </p>
						<div class="row">
							<div class="col-md-5"><input type="text" class="form-control" id="tgl1" placeholder="Masukan tanggal 1"></div>
							<div class="col-md-5"><input type="text" class="form-control" id="tgl2" placeholder="Masukan tanggal 2"></div>
							<div class="col-md-2"><button id="cari" class="btn btn-primary"><i class="fa fa-search"></i></button></div>
						</div>						
					</div>
				</div>
				<div style="height:100px"></div>
				<div class="col-lg-12">
					<div id="tampil_data">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="10">No</th>
									<th>Kode Buku</th>
									<th width="300">Judul</th>
									<th>Pengarang</th>
									<th>Penerbit</th>
									<th width="200">Tanggal Masuk</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>