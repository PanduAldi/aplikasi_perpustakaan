<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?php echo base_url() ?>">Perpustakaan APP</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<!--
		<ul class="nav navbar-nav">
			<li class="active"><a href="#">Link</a></li>
			<li><a href="#">Link</a></li>
		</ul>
		-->
		<ul class="nav navbar-nav">
		<?php  
			if ($this->session->userdata('islogin') == true)
			{
				$masteradmin = array('buku', 'anggota', 'petugas');
				$masterpetugas = array('buku', 'anggota');
				$transaksi = array('peminjaman','pengembalian');
				$laporan = array('anggota', 'buku','peminjaman','pengembalian');
				if ($this->session->userdata('level')== '1') {
					?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Master Data <b class="caret"></b></a>
							<ul class="dropdown-menu">
							<?php
							for ($i=0; $i < count($masteradmin); $i++) { 
								echo '<li><a href="'.site_url($masteradmin[$i]).'">'.ucwords($masteradmin[$i]).'</a></li>';
							}
							?>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Transaksi<b class="caret"></b></a>
							<ul class="dropdown-menu">
							<?php
							for ($i=0; $i < count($transaksi); $i++) { 
								echo '<li><a href="'.site_url($transaksi[$i]).'">'.ucwords($transaksi[$i]).'</a></li>';
							}
							?>	
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan<b class="caret"></b></a>
							<ul class="dropdown-menu">
							<?php
							for ($i=0; $i < count($laporan); $i++) { 
								echo '<li><a href="'.site_url('lap_'.$laporan[$i]).'">'.ucwords($laporan[$i]).'</a></li>';
							}
							?>	
							</ul>
						</li>
					<?php
				}
			}
			if($this->session->userdata('level') == '2')
			{
					?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Master Data <b class="caret"></b></a>
							<ul class="dropdown-menu">
							<?php
							for ($i=0; $i < count($masterpetugas); $i++) { 
								echo '<li><a href="'.site_url($masterpetugas[$i]).'">'.ucwords($masterpetugas[$i]).'</a></li>';
							}
							?>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Transaksi<b class="caret"></b></a>
							<ul class="dropdown-menu">
							<?php
							for ($i=0; $i < count($transaksi); $i++) { 
								echo '<li><a href="'.site_url($transaksi[$i]).'">'.ucwords($transaksi[$i]).'</a></li>';
							}
							?>	
							</ul>
						</li>
					<?php	
			}
			else
			{
				echo "";
			}
		?>
		</ul>
		<?php  
			if ($this->session->userdata('islogin') == true) {
				?>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> &nbsp;<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo site_url('dashboard/gantipassword') ?>"><i class="fa fa-key"></i> Ganti Password</a></li>
							<li><a href="<?php echo site_url('dashboard/logout') ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
						</ul>
					</li>
				</ul>
				<?php
			}
			else
			{
				echo "";
			}
		?>
	</div><!-- /.navbar-collapse -->
	</div>
</nav>