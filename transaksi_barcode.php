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
	<?php
	if (isset($_POST["btnTambahKeranjang"])) {
			// echo "sss";
			// echo '<meta http-equiv="refresh" content="0;url=penjualan.php"/>';
			// $_SESSION['id_transaksi_jual']=$_POST['tfIdTransaksi'];
			$x = $_POST["cbNamaBarang"];

			$q = mysqli_query($conn, "select * from barang where ID_BARANG='" . $x . "'");
			// $q1 = mysqli_query($conn, "select * from detil_penjualan where ID_BARANG='" . $x . "'");
			while ($data = mysqli_fetch_assoc($q)) {
					// while($data = mysqli_fetch_assoc($q1)) {
					// $_SESSION['barang_barcode'][]
					$_SESSION["barang_barcode"][$x]["id_barang"] = $data["ID_BARANG"];
					$_SESSION["barang_barcode"][$x]["kode_barcode"] = $data["KODE_BARCODE"];
					$_SESSION["barang_barcode"][$x]["nama_barang"] = $data["NAMA_BARANG"];


					if(isset($_SESSION["barang_barcode"][$x]["jumlah_cetak"])){
							$_SESSION["barang_barcode"][$x]["jumlah_cetak"] = $_SESSION["barang_barcode"][$x]["jumlah_cetak"]+ $_POST['tfJumlahBarcode'];
							// echo $_SESSION["barang_barcode"][$x]["jumlah_barang"]."dfs";/
							break;
					}else{
						// echo "Udah ada";
						$_SESSION["barang_barcode"][$x]["jumlah_cetak"] = $_POST['tfJumlahBarcode'];
						// echo $_SESSION["barang_barcode"][$x]["jumlah_barang"]."a";
						break;
					}
					// $_SESSION["barang_barcode"][$x]["subtotal"] = $_SESSION["barang_barcode"][$x]["jumlah_barang"]*$_SESSION["barang_barcode"][$x]["harga_barang"];
					// $_SESSION["grand_total_penjualan"] = $_SESSION["grand_total_penjualan"]+$_SESSION["barang_barcode"][$x]["subtotal"];
					$_POST["tambahbarang"] = "0";
			}
	}
	if (isset($_POST["btnHapusBarang"])) {
		$xx = $_POST["kod"];
		unset($_SESSION["barang_barcode"][$xx]);
		unset($_SESSION["total_harga_jual"]);
		$_POST["hapus_barang"] = "0";
	}
	if (isset($_POST["btnHapusKeranjang"])) {
					// SESSION_DESTROY();
					unset($_SESSION["barang_barcode"]);
					$_POST["clear"] = "0";
			}
			if (isset($_POST["btnCetak"]) && isset($_SESSION["barang_barcode"])) {
					date_default_timezone_set('Asia/Jakarta');
					$_POST["simpan"] = "0";
					// $grand_total_penjualan = $_SESSION["grand_total_penjualan"];
					// $total_harga_penjualan = $_SESSION["grand_total_penjualan"];
					// $_SESSION["uang_bayar"]=$_POST['tfUang'];
					// $id_penjualan = $_SESSION["id_transaksi_jual"];
					// $tgl_penjualan = $_SESSION['tgl_transaksi_jual'];

					// mysqli_query($conn, "INSERT into penjualan values('" . $id_penjualan . "','".$_SESSION['username']."','" . $tgl_penjualan . "'," . $total_harga_penjualan . ")");
					// mysqli_query($conn, "insert into penjualan values ('id_penjualan','kasir','tgl_penjualan','total_harga_penjualan','0','grand_total_penjualan')");
					// echo "INSERT into penjualan values('" . $id_penjualan . "','admin','" . $tgl_penjualan . "'," . $total_harga_penjualan . ",0," . $grand_total_penjualan . ")";

					// foreach ($_SESSION["barang_barcode"] as $yy => $yy_value) {
					// 		$id_barang = $_SESSION["barang_barcode"][$yy]["id_barang"];
					// 		$nama = $_SESSION["barang_barcode"][$yy]["nama_barang"];
					// 		$jumlah_jual = $_SESSION["barang_barcode"][$yy]["jumlah_barang"];
					// 		$harga_barang = $_SESSION["barang_barcode"][$yy]["harga_barang"];
					// 		$subtotal = $_SESSION["barang_barcode"][$yy]["harga_barang"] * $jumlah_jual;

							// mysqli_query($conn, "INSERT into detil_penjualan values('" . $id_barang . "','" . $id_penjualan . "'," . $jumlah_jual . "," . $subtotal . ")");
							// mysqli_query($conn, "insert into detil_penjualan values('id_barang','id_penjualan','jumlah_jual','subtotal')");
							// echo "INSERT into detil_penjualan values('" . $id_barang . "','" . $id_penjualan . "'," . $jumlah_jual . "," . $subtotal . ")";
					// }

					header('Location:cetak_barcode.php');
			}
	?>
	<div class="wrapper">
		<?php  include 'navbar.php';?>

		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Barcode Produk</h2>
								<!-- <ul class=" text-white breadcrumbs">
									<li class="nav-home">
										<a>
											<i class=" text-white fas fa-shopping-cart"></i>
										</a>
									</li>
									<li class="separator">
										<i class=" text-white flaticon-right-arrow"></i>
									</li>
									<li class="text-white nav-item">
										<a class="text-white" href="transaksi_penjualan.php">Penjualan Produk</a>
									</li>
								</ul> -->
							</div>
							<div class="ml-md-auto py-2 py-md-0">
								<h3 style="padding-right:50px;" class="text-white pb-2 fw-bold">
									<?php
														date_default_timezone_set('Asia/Jakarta');
														echo date(" Y-m-d H:i:s");
									?>
								</h3>
							</div>

						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row mt--12">
						<div class="col-md-9">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title"></div>
										<div class="d-flex flex-wrap justify-content-around pb-4 pt-4">
											<div class="table-responsive">
												<table id="basic-datatables" class="display table table-striped table-hover">
													<thead>
														<tr>
															<th style="width: 20%">Kode Barang</th>
															<th style="width: 20%">Barcode</th>
															<th style="width: 25%">Barang</th>
															<th style="width: 20%">Jumlah Cetak</th>
															<th>Opsi</th>
														</tr>
													</thead>
													<tbody>
														<?php
														if(isset($_SESSION["barang_barcode"])){
															$total=0;
															foreach($_SESSION["barang_barcode"] as $y => $y_value){
														?>
														<tr>
															<td>
                                        <?php echo $_SESSION["barang_barcode"][$y]["id_barang"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $_SESSION["barang_barcode"][$y]["kode_barcode"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $_SESSION["barang_barcode"][$y]["nama_barang"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $_SESSION["barang_barcode"][$y]["jumlah_cetak"]; ?>
                                    </td>
															<td>
																	<!-- <div class="form-button-action"> -->
																	<form method="post">
																		<input readonly hidden type="text" name="kod" value="<?php echo $_SESSION["barang_barcode"][$y]["id_barang"]; ?>">
																		<button type="submit" name="btnHapusBarang" title="Hapus" class="btn btn-icon btn-round btn-danger">
																			<i class="fas fa-trash-alt"></i>
																		</button>
																	</form>
																	<!-- </div> -->
															</td>
														</tr>
														<?php
															}
														}else {
															// $total = 0;
														}
														?>
													</tbody>
												</table><br>
											</div>
										</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card full-height">
								<div class="card-body">
									<!-- <div class="card-title"></div> -->
											<form action="" method="post">
												<div class="row">
													<div class="col-sm-12">
														<div class="form-group form-group-default">
															<label>Nama Barang</label>
																<select name="cbNamaBarang" class="form-control" value="">
																	<option value="">Pilih Barang</option>
																<?php
																	$query_b = mysqli_query($conn,"select ID_BARANG, NAMA_BARANG from barang");
																	while ($a = mysqli_fetch_array($query_b)) {?>
																		<option value="<?php echo $a['ID_BARANG']; ?>"><?php echo $a['NAMA_BARANG']; ?></option>
																	<?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="col-sm-12">
														<div class="form-group form-group-default">
															<label>Jumlah Cetak</label>
															<input name="tfJumlahBarcode" autofocus type="number" class="form-control" placeholder="Masukan Jumlah Cetak" value="">
														</div>
													</div>
													<div class="col-sm-12">
														<button type="submit" name="btnTambahKeranjang" class="btn btn-success btn-round btn-block" data-dismiss="modal"><i class="fas fa-plus"></i> Tambah</button>
														<button type="submit" name="btnHapusKeranjang" class="btn btn-danger btn-round btn-block" data-dismiss="modal">	<i class="fas fa-trash-alt"></i> Hapus Semua</button>
													</div>
												</div>
												<hr>
												<div class="row">
													<div class="col-sm-12">
														<button type="submit" name="btnCetak" class="btn btn-default btn-round btn-block" data-dismiss="modal"><i class="fas fa-print"></i> Cetak</button>
													</div>
												</div>
											</form>
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
