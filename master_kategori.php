<?php
	include 'koneksi.php'; ?>
<?php
session_start();
if (isset($_SESSION['username'])==false) {
	header("location:login.php");
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>WICLO - Dasboard</title>
<?php include 'css.php'; ?>
</head>
<body>
	<div class="wrapper">
		<?php  include 'navbar.php';?>

		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Master Kategori</h2>
								<ul class=" text-white breadcrumbs">
									<li class="nav-home">
										<a>
											<i class=" text-white fas fa-layer-group"></i>
										</a>
									</li>
									<li class="separator">
										<i class=" text-white flaticon-right-arrow"></i>
									</li>
									<li class="text-white nav-item">
										<a class="text-white" href="master_kategori.php">Master Kategori</a>
									</li>
								</ul>
							</div>
							<div class="ml-md-auto py-2 py-md-0">
								<button data-toggle="modal" data-target="#tambahModal" class="btn btn-secondary btn-round"><i class="fa fa-plus"></i> Tambah Data</button>
							</div>
							<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header no-bd">
											<h5 class="modal-title">
												<span class="fw-mediumbold">
													Form Tambah Data Kategori</span>
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form method="POST" action="">
											<div class="modal-body">
												<div class="row">
													<div class="col-sm-12">
														<div class="form-group form-group-default">
															<label>ID Kategori</label>
															<?php
																$query_cek_jumlah = mysqli_query($conn,"select * from kategori");
																$jumlah_kategori = mysqli_num_rows($query_cek_jumlah);
																$kode = "";
																if ($jumlah_kategori>=0 && $jumlah_kategori<=8) {
																	$kode = "KT-00".($jumlah_kategori+1);
																}elseif ($jumlah_kategori>=9 && $jumlah_kategori<=98) {
																	$kode = "KT-0".($jumlah_kategori+1);
																}elseif ($jumlah_kategori>=99 && $jumlah_kategori<=998) {
																	$kode = "KT-".($jumlah_kategori+1);
																}
															?>
															<input readonly name="tfIdKategori" type="text" class="form-control" value="<?php echo $kode; ?>">
														</div>
													</div>
													<div class="col-sm-12">
														<div class="form-group form-group-default">
															<label>Nama Kategori</label>
															<input name="tfNamaKategori" type="text" class="form-control" value="">
														</div>
													</div>
													<div class="col-sm-12">
														<div class="form-group form-group-default">
															<label>Kode Kategori</label>
															<input name="tfKodeKategori" type="text" class="form-control" value="">
														</div>
													</div>

												</div>
											</div>
											<div class="modal-footer no-bd">
												<button type="submit" name="btnSimpan" id="addRowButton" class="btn btn-primary">Simpan</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
											</div>
										</form>
										<!-- modal Tambah -->
										<?php
											if (isset($_POST['btnSimpan'])) {
												$id = $_POST['tfIdKategori'];
												$nama = $_POST['tfNamaKategori'];
												$kode = $_POST['tfKodeKategori'];

												$query = "insert into kategori(ID_KATEGORI,NAMA_KATEGORI,KODE_KATEGORI,CREATED_AT) values('".$id."','".$nama."','".$kode."',now())";
												// echo $query;
												$exc = mysqli_query($conn,$query);
												if ($exc==1) {
													// echo "<script>alert('Data Berhasil Diupdate');</script>";
												}else {
													echo "<script>alert('Data Gagal Disimpan');</script>";
												}
												echo '<meta http-equiv="refresh" content="0;url=master_kategori.php"/>';
											}

										?>
										<!-- modal Tambah -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row mt--12">
						<div class="col-md-12">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title"></div>
										<div class="d-flex flex-wrap justify-content-around pb-4 pt-4">
											<div class="table-responsive">
												<table id="basic-datatables" class="display table table-striped table-hover">
													<thead>
														<tr>
															<th>ID</th>
															<th>Kode</th>
															<th>Nama Kategori</th>
															<th>Waktu Ditambahkan</th>
															<th>Waktu Diperbarui</th>
															<th style="width: 10%">Aksi</th>
														</tr>
													</thead>
													<tfoot>
														<tr>
															<th>ID</th>
															<th>Kode</th>
															<th>Nama Kategori</th>
															<th>Waktu Ditambahkan</th>
															<th>Waktu Diperbarui</th>
															<th>Aksi</th>
														</tr>
													</tfoot>
													<tbody>
														<?php
															$query = mysqli_query($conn,"select * from kategori");
															while($row = mysqli_fetch_array($query)){
														?>
														<tr>
															<td><?php echo $row['ID_KATEGORI']; ?></td>
															<td><?php echo $row['KODE_KATEGORI']; ?></td>
															<td><?php echo $row['NAMA_KATEGORI']; ?></td>
															<td><?php echo $row['CREATED_AT']; ?></td>
															<td><?php echo $row['UPDATED_AT']; ?></td>
															<td>
																	<div class="form-button-action">
																		<button type="button" title="Edit"
																			class="btn btn-link btn-primary btn-lg" data-toggle="modal" data-target="#detailModal<?php echo $row['ID_KATEGORI']; ?>">
																			<i class="fa fa-edit"></i>
																		</button>
																	</div>
															</td>
														</tr>
														<?php
															}
														?>
													</tbody>
												</table><br>

												<!-- modal edit -->
												<?php
												$sql = mysqli_query($conn,"SELECT * FROM kategori");
												while($row = mysqli_fetch_array($sql)){
												?>
												<div class="modal fade" id="detailModal<?php echo $row['ID_KATEGORI']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header no-bd">
																<h5 class="modal-title">
																	<span class="fw-mediumbold">
																		Form Edit Data Kategori</span>
																</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<form method="POST" action="">
																<div class="modal-body">
																	<div class="row">
																		<div class="col-sm-12">
																			<div class="form-group form-group-default">
																				<label>ID Kategori</label>
																				<input readonly name="tfIdKategori" type="text" class="form-control" value="<?php echo $row['ID_KATEGORI']; ?>">
																			</div>
																		</div>
																		<div class="col-sm-12">
																			<div class="form-group form-group-default">
																				<label>Nama Kategori</label>
																				<input name="tfNamaKategori" type="text" class="form-control" value="<?php echo $row['NAMA_KATEGORI']; ?>">
																			</div>
																		</div>
																		<div class="col-sm-12">
																			<div class="form-group form-group-default">
																				<label>Kode Kategori</label>
																				<input readonly name="tfKodeKategori" type="text" class="form-control" value="<?php echo $row['KODE_KATEGORI']; ?>">
																			</div>
																		</div>

																	</div>
																</div>
																<div class="modal-footer no-bd">
																	<button type="submit" name="btnUpdate" id="addRowButton" class="btn btn-primary">Update</button>
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
																</div>
															</form>
														</div>
													</div>
												</div>
												<?php
												}
												?>
												<!-- modal edit -->
												<?php
													if (isset($_POST['btnUpdate'])) {
														$id = $_POST['tfIdKategori'];
														$nama = $_POST['tfNamaKategori'];

														$query = "update kategori set NAMA_KATEGORI='".$nama."', updated_at=now() where ID_KATEGORI='".$id."'";
														// echo $query;
														$exc = mysqli_query($conn,$query);
														if ($exc==1) {
															// echo "<script>alert('Data Berhasil Diupdate');</script>";
														}else {
															echo "<script>alert('Data Gagal Diupdate');</script>";
														}
														echo '<meta http-equiv="refresh" content="0;url=master_kategori.php"/>';
													}

												?>
												<!-- modal edit -->

											</div>
										</div>
								</div>
							</div>
						</div>

					</div>

				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link" href="https://www.themekita.com">
									ThemeKita
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Help
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Licenses
								</a>
							</li>
						</ul>
					</nav>
					<div class="copyright ml-auto">
						2019, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
					</div>
				</div>
			</footer>
		</div>

		<!-- Custom template | don't include it in your project! -->
		<div class="custom-template">
			<div class="title">Settings</div>
			<div class="custom-content">
				<div class="switcher">
					<div class="switch-block">
						<h4>Logo Header</h4>
						<div class="btnSwitch">
							<button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
							<button type="button" class="selected changeLogoHeaderColor" data-color="blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="white"></button>
							<br/>
							<button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Navbar Header</h4>
						<div class="btnSwitch">
							<button type="button" class="changeTopBarColor" data-color="dark"></button>
							<button type="button" class="changeTopBarColor" data-color="blue"></button>
							<button type="button" class="changeTopBarColor" data-color="purple"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue"></button>
							<button type="button" class="changeTopBarColor" data-color="green"></button>
							<button type="button" class="changeTopBarColor" data-color="orange"></button>
							<button type="button" class="changeTopBarColor" data-color="red"></button>
							<button type="button" class="changeTopBarColor" data-color="white"></button>
							<br/>
							<button type="button" class="changeTopBarColor" data-color="dark2"></button>
							<button type="button" class="selected changeTopBarColor" data-color="blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="purple2"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="green2"></button>
							<button type="button" class="changeTopBarColor" data-color="orange2"></button>
							<button type="button" class="changeTopBarColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Sidebar</h4>
						<div class="btnSwitch">
							<button type="button" class="selected changeSideBarColor" data-color="white"></button>
							<button type="button" class="changeSideBarColor" data-color="dark"></button>
							<button type="button" class="changeSideBarColor" data-color="dark2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Background</h4>
						<div class="btnSwitch">
							<button type="button" class="changeBackgroundColor" data-color="bg2"></button>
							<button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
							<button type="button" class="changeBackgroundColor" data-color="bg3"></button>
							<button type="button" class="changeBackgroundColor" data-color="dark"></button>
						</div>
					</div>
				</div>
			</div>
			<div class="custom-toggle">
				<i class="flaticon-settings"></i>
			</div>
		</div>
		<!-- End Custom template -->
	</div>
	<?php include 'js.php'; ?>
</body>
</html>
