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
								<h2 class="text-white pb-2 fw-bold">Laporan Bulanan</h2>
								<ul class=" text-white breadcrumbs">
									<li class="nav-home">
										<a>
											<i class=" text-white fas fa-file-alt"></i>
										</a>
									</li>
									<li class="separator">
										<i class=" text-white flaticon-right-arrow"></i>
									</li>
									<li class="text-white nav-item">
										<a class="text-white" href="laporan_bulanan.php">Laporan Bulanan</a>
									</li>
								</ul>
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
										<!-- <div class="d-flex flex-wrap pb-2 pt-2"> -->
										<form action="" method="post">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group form-group-default">
														<label>Bulan Awal</label>
														<input name="tfTglAwal" type="month" class="form-control" value="">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group form-group-default">
														<label>Bulan Akhir</label>
														<input name="tfTglAkhir" type="month" class="form-control" value="">
													</div>
												</div>
												<div class="col-md-2">
													<button type="submit" style="margin-top:5px;" name="btnCari" class="btn btn-lg btn-round btn-success btn-block" data-dismiss="modal"><i class="fas fa-search"></i> Cari</button>
												</div>
												<div class="col-md-2">
													<button type="submit" style="margin-top:5px;" name="btnBatal" class="btn btn-lg btn-round btn-danger btn-block" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
												</div>
											</div>
											</form>
											<form method="post" action="cetak_bulanan.php" target="_blank">
											<div class="row">
												<div class="col-md-12">
													<button type="submit" style="margin-top:5px;" name="btnCetak" class="btn btn-lg btn-round btn-default btn-block" data-dismiss="modal"><i class="fas fa-print"></i> Cetak</button>
												</div>

											</div>
										</form>
										<!-- </div> -->
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">
									</div>
										<div class="d-flex flex-wrap justify-content-around pb-4 pt-4">
											<div class="table-responsive">
												<table id="basic-datatables" class="display table table-striped table-hover">
													<thead>
														<tr>
															<th>No</th>
															<th>Bulan Transaksi</th>
															<th>Total</th>
															<th style="width: 10%">Aksi</th>
														</tr>
													</thead>
													<tfoot>
														<tr>
															<th>No</th>
															<th>Tanggal Transaksi</th>
															<th>Total</th>
															<th>Aksi</th>
														</tr>
													</tfoot>
													<tbody>
														<?php
														if(isset($_POST['btnCari'])){
															$awal = $_POST['tfTglAwal'];
                                    $akhir = $_POST['tfTglAkhir'];
                                    $_SESSION['kata'] = "Laporan Penjualan Bulan ".$awal." s/d ".$akhir;
                                    $awal1 = explode("-" , $awal);
                                    $akhir1 = explode("-" , $akhir);
                                    $query = mysqli_query($conn,"select concat(month(tgl_penjualan),'-',year(TGL_PENJUALAN)) as tgl, sum(total_harga_penjualan) as total from penjualan where month(tgl_penjualan) BETWEEN '".$awal1[1]."' and '".$akhir1[1]."' and  YEAR(tgl_penjualan) BETWEEN '".$awal1[0]."' and '".$akhir1[0]."' group by month(tgl_penjualan)");
                                    $_SESSION['query'] = "select concat(month(tgl_penjualan),'-',year(TGL_PENJUALAN)) as tgl, sum(total_harga_penjualan) as total from penjualan where month(tgl_penjualan) BETWEEN '".$awal1[1]."' and '".$akhir1[1]."' and  YEAR(tgl_penjualan) BETWEEN '".$awal1[0]."' and '".$akhir1[0]."' group by month(tgl_penjualan)";
                                        $no = 1;
                                    $_SESSION['kat'] = "month";
                                        while ($data = mysqli_fetch_assoc($query)) {
															?>
															<tr>
																			<td>
																					<?php echo $no; ?>
																			</td>
																			<td>
																					<?php echo $data['tgl']; ?>
																			</td>
																			<td>
																					<?php echo $data['total']; ?>
																			</td>
																<td>
																		<div class="form-button-action">
																			<button type="button" title="Lihat"
																				class="btn btn-link btn-primary btn-lg" data-toggle="modal" data-target="#detailModal<?php echo $data['tgl']; ?>">
																				<i class="fa fa-search"></i>
																			</button>
																		</div>
																</td>
															</tr>
															<?php
															$no++;
																}
														}elseif (isset($_POST['btnBatal'])) {
															$query = mysqli_query($conn,"select concat(month(tgl_penjualan),'-',year(TGL_PENJUALAN)) as tgl, sum(total_harga_penjualan) as total from penjualan group by month(tgl_penjualan)");
																	$_SESSION['kata'] = "Laporan Penjualan Bulanan";
																	$_SESSION['query'] = "select concat(month(tgl_penjualan),'-',year(TGL_PENJUALAN)) as tgl, sum(total_harga_penjualan) as total from penjualan group by month(tgl_penjualan)";
																			$no = 1;
																	$_SESSION['kat'] = "month";
																			while ($data = mysqli_fetch_assoc($query)) {
															?>
															<tr>
																			<td>
																					<?php echo $no; ?>
																			</td>
																			<td>
																					<?php echo $data['tgl']; ?>
																			</td>
																			<td>
																					<?php echo $data['total']; ?>
																			</td>
																<td>
																		<div class="form-button-action">
																			<button type="button" title="Lihat"
																				class="btn btn-link btn-primary btn-lg" data-toggle="modal" data-target="#detailModal<?php echo $data['tgl']; ?>">
																				<i class="fa fa-search"></i>
																			</button>
																		</div>
																</td>
															</tr>
															<?php
															$no++;
																}
														}else{
															$query = mysqli_query($conn,"select concat(month(tgl_penjualan),'-',year(TGL_PENJUALAN)) as tgl, sum(total_harga_penjualan) as total from penjualan group by month(tgl_penjualan)");
																	$_SESSION['kata'] = "Laporan Penjualan Bulanan";
																	$_SESSION['query'] = "select concat(month(tgl_penjualan),'-',year(TGL_PENJUALAN)) as tgl, sum(total_harga_penjualan) as total from penjualan group by month(tgl_penjualan)";
																			$no = 1;
																	$_SESSION['kat'] = "month";
																			while ($data = mysqli_fetch_assoc($query)) {
																?>
																<tr>
																				<td>
		                                        <?php echo $no; ?>
		                                    </td>
		                                    <td>
		                                        <?php echo $data['tgl']; ?>
		                                    </td>
		                                    <td>
		                                        <?php echo $data['total']; ?>
		                                    </td>
																	<td>
																			<div class="form-button-action">
																				<button type="button" title="Lihat"
																					class="btn btn-link btn-primary btn-lg" data-toggle="modal" data-target="#detailModal<?php echo $data['tgl']; ?>">
																					<i class="fa fa-search"></i>
																				</button>
																			</div>
																	</td>
																</tr>
																<?php
																$no++;
																	}
															}
														?>
													</tbody>
												</table><br>

												<!-- modal edit -->
												<?php
												$query = mysqli_query($conn,"select distinct date(tgl_penjualan) as tgl from penjualan");

                            while ($data = mysqli_fetch_assoc($query)) {
												?>
												<div class="modal fade" id="detailModal<?php echo $data['tgl']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header no-bd">
																<h5 class="modal-title">
																	<span class="fw-mediumbold">
																		Detail Produk Penjualan</span>
																</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
																<div class="modal-body">
																	<?php
                                    $query_barang = mysqli_query($conn,"select b.id_barang as id, b.nama_barang as nama, sum(dt.jumlah_jual) as jumlah from barang b join detil_penjualan dt on b.id_barang=dt.id_barang join penjualan p on dt.id_penjualan=p.id_penjualan where date(p.tgl_penjualan)='".$data['tgl']."' group by b.ID_BARANG");
                                  ?>
																	<table class="display table table-striped table-hover table-head-bg-default">
																		<thead>
																			<tr>
                                          <th scope="col">No</th>
                                          <th scope="col">Kode Barang</th>
                                          <th scope="col">Nama Barang</th>
                                          <th scope="col">Jumlah</th>
                                      </tr>
																		</thead>
																		<tbody>
																		<?php
	                                          $no = 1;
	                                          while($data_barang = mysqli_fetch_assoc($query_barang)){
	                                      ?>
	                                      <tr>
	                                          <th>
	                                              <?php echo $no; ?>
	                                          </th>
	                                          <td>
	                                              <?php echo $data_barang['id']; ?>
	                                          </td>
	                                          <td>
	                                              <?php echo $data_barang['nama']; ?>
	                                          </td>
	                                          <td>
	                                              <?php echo $data_barang['jumlah']; ?>
	                                          </td>
	                                      </tr>
	                                      <?php
	                                          $no++;
	                                          } ?>
	                                  </tbody>
																	</table>
																</div>
																<div class="modal-footer no-bd">
																	<!-- <button type="submit" name="btnUpdate" id="addRowButton" class="btn btn-primary">Update</button> -->
																	<!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button> -->
																</div>
														</div>
													</div>
												</div>
												<?php
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
