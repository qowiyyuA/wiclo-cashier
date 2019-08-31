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
								<h2 class="text-white pb-2 fw-bold">Master Produk</h2>
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
										<a class="text-white" href="master_kategori.php">Master Produk</a>
									</li>
								</ul>
							</div>
							<div class="ml-md-auto py-2 py-md-0">
								<button data-toggle="modal" data-target="#tambahModal" class="btn btn-secondary btn-round"><i class="fa fa-plus"></i> Tambah Data</button>
							</div>
							<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header no-bd">
											<h5 class="modal-title">
												<span class="fw-mediumbold">
													Form Tambah Data Produk</span>
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form method="POST" action="">
											<div class="modal-body">
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group form-group-default">
															<label>Nama Barang</label>
															<input name="tfNamaBarang" type="text" class="form-control" value="">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group form-group-default">
															<label>Nama Kategori</label>
															<select name="cbNamaKategori" class="form-control" value="">
																<?php
																	$query_kat = mysqli_query($conn,"select * from kategori");
																	while ($row_kat = mysqli_fetch_array($query_kat)) {
																	?>
																		<option value="<?php echo $row_kat['ID_KATEGORI']."|".$row_kat['KODE_KATEGORI']; ?>"><?php echo $row_kat['NAMA_KATEGORI']; ?></option>
																<?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group form-group-default">
															<label>Merk Barang</label>
															<input name="tfMerkBarang" type="text" class="form-control" value="">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group form-group-default">
															<label>Ukuran Barang</label>
															<input name="tfUkuranBarang" type="text" class="form-control" value="">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group form-group-default">
															<label>Stok Barang</label>
															<input name="tfStokBarang" type="number" class="form-control" value="">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group form-group-default">
															<label>Harga Barang</label>
															<input name="tfHargaBarang" type="number" class="form-control" value="">
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
												$query_barang = mysqli_query($conn,"select * from barang");
												$jumlah_barang = mysqli_num_rows($query_barang);
												$id = "";
												$tmp = $_POST['cbNamaKategori'];
												$cek = explode("|",$tmp);
												if ($jumlah_barang>=0 && $jumlah_barang<=8) {
													$id = $cek[1]."00".($jumlah_barang+1);
												}elseif ($jumlah_barang>=9 && $jumlah_barang<=98) {
													$id = $cek[1]."0".($jumlah_barang+1);
												}elseif ($jumlah_barang>=99 && $jumlah_barang<=998) {
													$id = $cek[1]."".($jumlah_barang+1);
												}
												$kategori = $cek[0];
												$nama = ucwords($_POST['tfNamaBarang']);
												$merk = ucwords($_POST['tfMerkBarang']);
												$ukuran = $_POST['tfUkuranBarang'];
												$harga = $_POST['tfHargaBarang'];
												$potong_harga = $harga/1000;
												$barcode = substr($merk, 0,3).".".$id;
												$stok = $_POST['tfStokBarang'];
												$query = "insert into barang values('".$id."','".$kategori."','".$nama."','".$merk."','".$ukuran."','".$barcode."',".$stok.",".$harga.",0)";
												// echo "<script>console.log($query)</script>";
												// echo $query;
												$exc = mysqli_query($conn,$query);
												if ($exc==1) {
													echo "<script>alert('Data Berhasil Disimpan');</script>";
												}else {
													echo "<script>alert('Data Gagal Disimpan');</script>";
												}
												echo '<meta http-equiv="refresh" content="0;url=master_produk.php"/>';
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
															<th>Barcode</th>
															<th>Nama Kategori</th>
															<th>Nama Barang</th>
															<th>Stok</th>
															<th>Harga</th>
															<th style="width: 10%">Aksi</th>
														</tr>
													</thead>
													<tfoot>
														<tr>
															<th>ID</th>
															<th>Barcode</th>
															<th>Nama Kategori</th>
															<th>Nama Barang</th>
															<th>Stok</th>
															<th>Harga</th>
															<th>Aksi</th>
														</tr>
													</tfoot>
													<tbody>
														<?php
															$query = mysqli_query($conn,"select b.ID_BARANG as id, b.KODE_BARCODE as barcode, k.NAMA_KATEGORI as kategori ,b.NAMA_BARANG as nama, b.STOK as stok, b.HARGA as harga  from barang b join kategori k on b.ID_KATEGORI=k.ID_KATEGORI where b.status=1");
															while($row = mysqli_fetch_array($query)){
																$query1 = mysqli_query($conn,"select ifnull(sum(stok_masuk),0) as masuk from detil_pemasukan where id_barang='".$row['id']."'");
                                        $query2 = mysqli_query($conn,"select ifnull(sum(jumlah_jual),0) as keluar from detil_penjualan where id_barang='".$row['id']."'");
                                        $masuk = mysqli_fetch_assoc($query1);
                                        $keluar = mysqli_fetch_assoc($query2);
														?>
														<tr>
															<td><?php echo $row['id']; ?></td>
															<td><?php echo $row['barcode']; ?></td>
															<td><?php echo $row['kategori']; ?></td>
															<td><?php echo $row['nama']; ?></td>
															<td><?php echo ($row['stok']+$masuk['masuk'])-$keluar['keluar']; ?></td>
															<td><?php echo $row['harga']; ?></td>
															<td>
																	<div class="form-button-action">
																		<button type="button" title="Edit"
																			class="btn btn-link btn-primary btn-lg" data-toggle="modal" data-target="#detailModal<?php echo $row['id']; ?>">
																			<i class="fa fa-edit"></i>
																		</button>
																		<form action="" method="post">
																		<input hidden readonly type="text" name="kode" id="" value="<?php echo $row['id']; ?>">
																		<button name="hapus" type="submit" title="Hapus"
																			class="btn btn-link btn-danger btn-lg"">
																			<i class="fa fa-trash"></i>
																		</button>
																		</form>
																		<?php 
																			if(isset($_POST['hapus'])){
																				$id = $_POST['kode'];
																					$query = "update barang set status=0 where ID_BARANG='".$id."'";
																					// echo "<script>console.log($query)</script>";
																					// echo $query;
																					$exc = mysqli_query($conn,$query);
																					if ($exc==1) {
																						echo "<script>alert('Data Berhasil Dihapus');</script>";
																					}else {
																						echo "<script>alert('Data Gagal Dihapus');</script>";
																					}
																				
																				echo '<meta http-equiv="refresh" content="0;url=master_produk.php"/>';
																			}
																		?>
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
												$sql = mysqli_query($conn,"SELECT * FROM barang");
												while($row = mysqli_fetch_array($sql)){
												?>
												<div class="modal fade" id="detailModal<?php echo $row['ID_BARANG']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header no-bd">
																<h5 class="modal-title">
																	<span class="fw-mediumbold">
																		Form Edit Data Produk</span>
																</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<form method="POST" action="">
																<div class="modal-body">
																	<div class="row">
																		<div class="col-sm-6">
																			<div class="form-group form-group-default">
																				<label>Kode Barang</label>
																				<input readonly name="tfKodeBarang" type="text" class="form-control" value="<?php echo $row['ID_BARANG']; ?>">
																			</div>
																		</div>
																		<div class="col-sm-6">
																			<div class="form-group form-group-default">
																				<label>Nama Barang</label>
																				<input name="tfNamaBarang" type="text" class="form-control" value="<?php echo $row['NAMA_BARANG']; ?>">
																			</div>
																		</div>
																		<div class="col-sm-6">
																			<div class="form-group form-group-default">
																				<label>Nama Kategori</label>
																				<select name="cbNamaKategori" class="form-control" value="">
																					<?php
																						$query_kat = mysqli_query($conn,"select * from kategori");
																						while ($row_kat = mysqli_fetch_array($query_kat)) {
																						?>
																							<option <?php if($row['ID_KATEGORI']==$row_kat['ID_KATEGORI']){ echo "selected";} ?> value="<?php echo $row_kat['ID_KATEGORI']."|".$row_kat['KODE_KATEGORI']; ?>"><?php echo $row_kat['NAMA_KATEGORI']; ?></option>
																					<?php
																						}
																					?>
																				</select>
																			</div>
																		</div>
																		<div class="col-sm-6">
																			<div class="form-group form-group-default">
																				<label>Merk Barang</label>
																				<input name="tfMerkBarang" type="text" class="form-control" value="<?php echo $row['MERK_BARANG']; ?>">
																			</div>
																		</div>
																		<div class="col-sm-6">
																			<div class="form-group form-group-default">
																				<label>Ukuran Barang</label>
																				<input name="tfUkuranBarang" type="text" class="form-control" value="<?php echo $row['UKURAN_BARANG']; ?>">
																			</div>
																		</div>

																		<div class="col-sm-6">
																			<div class="form-group form-group-default">
																				<label>Harga Barang</label>
																				<input name="tfHargaBarang" type="number" class="form-control" value="<?php echo $row['HARGA']; ?>">
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
														$kode = $_POST['tfKodeBarang'];
														$nama = ucwords($_POST['tfNamaBarang']);
														$merk = ucwords($_POST['tfMerkBarang']);
														$ukuran = $_POST['tfUkuranBarang'];
														$harga = $_POST['tfHargaBarang'];
														$tmp = $_POST['cbNamaKategori'];
														$cek = explode("|",$tmp);
														$kategori = $cek[0];
														
														$query = "update barang set ID_KATEGORI='".$kategori."',NAMA_BARANG='".$nama."', MERK_BARANG='".$merk."', UKURAN_BARANG='".$ukuran."', HARGA=".$harga." where ID_BARANG='".$kode."'";
														// echo $query;
														$exc = mysqli_query($conn,$query);
														if ($exc==1) {
															// echo "<script>alert('Data Berhasil Diupdate');</script>";
														}else {
															echo "<script>alert('Data Gagal Diupdate');</script>";
														}
														echo '<meta http-equiv="refresh" content="0;url=master_produk.php"/>';
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
