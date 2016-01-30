<!-- Jquery Ajax Simpan pengembalian -->
	<script>
	
		$(function(){

			//aksi kembalio
			$(".kembalikan").click(function(){
				var kd_pinjam= $(this).attr('kd_pinjam');
				var kd_buku = $(this).attr('kd_buku');
				var tgl_kembali = $(this).attr('tgl_kembali');
				var denda = $(this).attr('denda');
				var petugas = $(this).attr('petugas');

				swal({
					title : "Konfirmasi",
					text  : "Transaksi pengembalian dengan Nomor "+kd_pinjam+", Lanjutkan?",
					type : "warning",
					showCancelButton : true,
					confirmButtonColor : "#1369D9",
					confirmButtonText : "Ya, Lanjutkan",
					cancelButtonText : 'Tidak',
					closeOnConfirm : false, 
					closeOnCancel : false

					},

					function(isConfirm)
					{
						if (isConfirm) {
							$.ajax({
								url : "<?php echo site_url('pengembalian/simpan') ?>",
								type : "POST",
								data : "kd_peminjaman="+kd_pinjam+
									   "&kd_buku="+kd_buku+
									   "&tgl_kembali="+tgl_kembali+
									   "&denda="+denda+
									   "&petugas="+petugas,
								success : function(data){
									$(".clear_"+kd_buku).fadeOut(400);
									swal("Sukses", "Transaksi Berhasil", "success");
								}	
							})							
						}
						else
						{
							swal("Batal", "Anda Membatalkan transaksi", "error");
						}
					});
							/**	

							*/

			});
		})
	</script>
<!-- end -->

<hr>
<div class="table-responsive">
<table class="table table-striped">
	<tr>
		<td width="50">Kd. Peminjaman</td>
		<td width="10">:</td>
		<td width="150"><?php echo $bio->kd_peminjaman ?></td>

		<td width="50"></td>
		<td width="10"> </td>
		<td width="150"></td>

	</tr>
	<tr>
		<td width="50">Nama</td>
		<td width="10"> : </td>
		<td width="150"><?php echo $bio->nama ?></td>
	
		<td width="50">Tanggal Sekarang</td>
		<td width="10"> : </td>
		<td width="150"><?php echo $tanggal ?></td>

	</tr>
</table>
<table class="table table-striped table-bordered">
	<thead>
	<tr>
		<th>Kode Buku</th>
		<th>Judul BUku</th>
		<th>Tanggal Pinjam</th>
		<th>Tanggal Harus Kembali</th>
		<th>#</th>
	</tr>
	</thead>
	<tbody>
		<?php foreach ($cekdata as $d): ?>
			<tr class="clear_<?php echo $d->kd_buku ?>">
				<td><?php echo $d->kd_buku ?></td>
				<td><?php echo $d->judul ?></td>
				<td><?php echo $d->tgl_pinjam ?></td>
				<td>
					<?php  	
						#menentukan denda
							
							//tgl sekarang
							$pecah = explode("-", $d->tgl_pinjam);
							$tgl = $pecah[2];
							$bulan = $pecah[1];
							$tahun = $pecah[0];

							//tgl kembali
							$pecah1 = explode("-", $d->tgl_kembali);
							$tgl1 = $pecah1[2];
							$bulan1 = $pecah1[1];
							$tahun1 = $pecah1[0];

							// convert gregorian to JD
							$jd1 = gregoriantojd($bulan, $tgl, $tahun);
							$jd2 = gregoriantojd($bulan1, $tgl1, $tahun1);

							//selisih hari
							$selisih = $jd2 - $jd1;

							
							//tentukan denda
							if (($selisih - 7) <= 0) 
							{
								$jml = "0";
								$denda = "(tidak denda)";
								echo $d->tgl_kembali." ".$denda;
							}
							else
							{
								$jml  = ($selisih - 7)*500;

								$denda = "(Telat ".$selisih." hari = Rp. ".$jml.")";
								echo $d->tgl_kembali." ".$denda;
							}

							
					?>
				</td>
				<td>
					<a href="#" class="btn btn-primary kembalikan" kd_pinjam='<?php echo $d->kd_peminjaman ?>'
														kd_buku = '<?php echo $d->kd_buku ?>'
														tgl_kembali = '<?php echo date('Y-m-d') ?>'
														denda="<?php echo $jml ?>"
														petugas="<?php echo $this->session->userdata('nama') ?>">Kembalikan Buku</a>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
</div>