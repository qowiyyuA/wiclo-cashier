<?php include 'koneksi.php'; ?>
<?php session_start();?>
<?php
    if ($_SESSION['id']==false) {
        header("Location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Tahunan</title>

    <?php include 'css.php' ?>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card text-center">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="penjualan_harian.php">
                                    <h6>LAPORAN HARIAN</h6>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="penjualan_bulanan.php">
                                    <h6>LAORAN BULANAN</h6>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="penjualan_tahunan.php">
                                    <h6>LAPORAN TAHUNAN</h6>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form action="laporan.php" method="POST">
                            <button type="submit" name="cetak_laporan" class="btn btn-success btn-block btn-lg"> Cetak Laporan Tahunan</button>
                        </form>
                        <br>
                        <form class="form-inline" method="POST">
                            <div class="form-group mb-2">
                                <label for="email">Tanggal Awal : &thinsp;</label>
                                <input type="year" class="form-control" name="tawal">&emsp;
                            </div>
                            <div class="form-group">
                                <label for="pwd">Tanggal Akhir: &thinsp;</label>
                                <input type="year" class="form-control" name="takir">&emsp;
                            </div>
                            <button type="submit" name="cari" class="btn btn-primary"><i class='fa fa-search fa-fw'></i> Cari</button>&emsp;
                            <button type="submit" name="batal" class="btn btn-danger"><i class='fa fa-times fa-fw'></i>Batal</button>
                        </form>
                        <br>
                        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover" border="0" id="example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Transaksi</th>
                                    <th>Total</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  
                                if(isset($_POST['cari'])){
                                    $awal = $_POST['tawal'];
                                                $akhir = $_POST['takir'];
                                    $_SESSION['kata'] = "Laporan Penjualan Tahun ".$awal." s/d ".$akhir;
                                                // $awal1 = $awal." 00:00:00";
                                                // $akhir1 = $akhir." 23:59:59";
                                    $query = mysqli_query($conn,"select year(TGL_PENJUALAN) as tgl, sum(total_harga_penjualan) as total from penjualan where YEAR(tgl_penjualan) BETWEEN '".$awal."' and '".$akhir."' group by year(tgl_penjualan)");
                                    $_SESSION['query'] = "select year(TGL_PENJUALAN) as tgl, sum(total_harga_penjualan) as total from penjualan where YEAR(tgl_penjualan) BETWEEN '".$awal."' and '".$akhir."' group by year(tgl_penjualan)";
                                    $_SESSION['kat'] = "year";    
                                    $no = 1;   
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
                                        <button class="btn btn-success" data-toggle="modal" data-target="#DetailTahunan<?php echo $data['tgl']; ?>">Detail</button>
                                    </td>
                                </tr>
                                <?php
                                        $no++;
                                        }
                                }else if (isset($_POST['batal'])) {
                                    $query = mysqli_query($conn,"select year(TGL_PENJUALAN) as tgl, sum(total_harga_penjualan) as total from penjualan group by year(tgl_penjualan)");
                                    $_SESSION['kata'] = "Laporan Penjualan Tahunan";
                                    $_SESSION['query'] = "select year(TGL_PENJUALAN) as tgl, sum(total_harga_penjualan) as total from penjualan group by year(tgl_penjualan)";
                                    $_SESSION['kat'] = "year";
                                        $no = 1;   
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
                                        <button class="btn btn-success" data-toggle="modal" data-target="#DetailTahunan<?php echo $data['tgl']; ?>">Detail</button>
                                    </td>
                                </tr>
                                <?php
                                        $no++;
                                        }
                                }else{
                                    $query = mysqli_query($conn,"select year(TGL_PENJUALAN) as tgl, sum(total_harga_penjualan) as total from penjualan group by year(tgl_penjualan)");
                                    $_SESSION['kata'] = "Laporan Penjualan Tahunan";
                                    $_SESSION['query'] = "select year(TGL_PENJUALAN) as tgl, sum(total_harga_penjualan) as total from penjualan group by year(tgl_penjualan)";
                                    $_SESSION['kat'] = "year";
                                        $no = 1;   
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
                                        <button class="btn btn-success" data-toggle="modal" data-target="#DetailTahunan<?php echo $data['tgl']; ?>">Detail</button>
                                    </td>
                                </tr>
                                <?php
                                        $no++;
                                        }
                                }
                            ?>
                            </tbody>
                        </table>

                        <!--detil modal detail transaksi bulanan-->
                        <?php 
                            $query = mysqli_query($conn,"select distinct year(TGL_PENJUALAN) as tgl from penjualan");
                            
                            while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                        <div class="modal fade" id="DetailTahunan<?php echo $data['tgl']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Detail Penjualan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php 
                                            $query_barang = mysqli_query($conn,"select b.id_barang as id, b.nama_barang as nama, sum(dt.jumlah_jual) as jumlah from barang b join detil_penjualan dt on b.id_barang=dt.id_barang join penjualan p on dt.id_penjualan=p.id_penjualan where year(p.tgl_penjualan)='".$data['tgl']."' group by b.ID_BARANG");
                                        ?>
                                        <table class="table table-hover">
                                            <thead class="thead-dark">
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
                                                    <th scope="row">
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
                                </div>
                            </div>
                        </div>
                        <?php 
                            }
                        ?>
                        <!--end modal-->
                        <?php 
                        if(isset($_POST['hapus'])){
                            $id = $_POST['id'];
                            $query = mysqli_query($conn,"delete from kategori where id_kategori='".$id."'");
                            if ($query==1) {
                                ?>
                        <meta http-equiv="refresh" content="0;url=produk_kategori.php" />
                        <?php
                            }else{
                            }
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'js.php' ?>
</body>

</html>
