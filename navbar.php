<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">

				<a href="index.html" class="logo">
					<!-- <img src="assets/img/logo.svg" alt="navbar brand" class="navbar-brand"> -->
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
					data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4>Hizrian</h4>
												<p class="text-muted">hello@example.com</p><a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">My Profile</a>
										<a class="dropdown-item" href="#">My Balance</a>
										<a class="dropdown-item" href="#">Inbox</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Account Setting</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
        </div>


        <!-- ====================================================== -->
        	<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<?php echo $_SESSION['nama']; ?>
									<span class="user-level"><?php if($_SESSION['status']=="1"){echo "Admin";}else{ echo "Pegawai";} ?></span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">Profil Saya</span>
										</a>
									</li>
									<li>
										<a href="logout.php">
											<span class="link-collapse">Keluar</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
							<li class="nav-item">
							<a href="index.php">
								<i class="fas fa-home"></i>
								<p>Dasboard</p>
							</a>
						</li>
							<?php
								if ($_SESSION["status"]=="1") {
									?>
									<li class="nav-item">
										<a data-toggle="collapse" href="#base">
											<i class="fas fa-layer-group"></i>
											<p>Master</p>
											<span class="caret"></span>
										</a>
										<div class="collapse" id="base">
											<ul class="nav nav-collapse">
												<li>
													<a href="master_pegawai.php">
														<span class="sub-item">Pegawai</span>
													</a>
												</li>
												<li>
													<a href="master_kategori.php">
														<span class="sub-item">Kategori</span>
													</a>
												</li>
												<li>
													<a href="master_produk.php">
														<span class="sub-item">Produk</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
								<?php
								}
							?>
							<li class="nav-item">
								<a data-toggle="collapse" href="#base1">
									<i class="fas fa-shopping-cart"></i>
									<p>Transaksi</p>
									<span class="caret"></span>
								</a>
								<div class="collapse" id="base1">
									<ul class="nav nav-collapse">
										<li>
											<a href="transaksi_penjualan.php">
												<span class="sub-item">Penjualan Produk</span>
											</a>
										</li>
										<?php
										if ($_SESSION["status"]=="1") {
											?>
											<li>
												<a href="transaksi_produk_masuk.php">
													<span class="sub-item">Stok Produk Masuk</span>
												</a>
											</li>
											<li>
												<a href="transaksi_barcode.php">
													<span class="sub-item">Barcode Produk</span>
												</a>
											</li>
											<?php
										}
										?>
									</ul>
								</div>
							</li>
							<?php
								if ($_SESSION['status']=="1") {
									?>
									<li class="nav-item">
										<a data-toggle="collapse" href="#base2">
											<i class="fas fa-file-alt"></i>
											<p>Laporan Penjualan</p>
											<span class="caret"></span>
										</a>
										<div class="collapse" id="base2">
											<ul class="nav nav-collapse">
												<li>
													<a href="laporan_harian.php">
														<span class="sub-item">Laporan Harian</span>
													</a>
												</li>
												<li>
													<a href="laporan_bulanan.php">
														<span class="sub-item">Laporan Bulanan</span>
													</a>
												</li>
												<li>
													<a href="laporan_tahunan.php">
														<span class="sub-item">Laporan Tahunan</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
									<?php
								}
							?>
						</ul>

					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->
