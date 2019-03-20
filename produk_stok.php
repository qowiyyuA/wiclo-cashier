<?php include 'koneksi.php'; ?>
<?php session_start(); ?>
<?php
    if ($_SESSION['id']==false) {
        header("Location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Stok</title>

    <?php include 'css.php'; ?>
</head>

<body>
    <!--   navigasi awal-->
    <?php include 'navbar.php'; ?>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card text-center">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="produk_barang.php">
                                    <h6>DATA BARANG</h6>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="produk_kategori.php">
                                    <h6>DATA KATEGORI</h6>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="produk_stok.php">
                                    <h6>DATA STOK</h6>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="produk_warna.php">
                                    <h6>DATA WARNA</h6>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#tambahDataStok">
                            <img src="icon/Putih/2x/baseline_add_box_white_48dp.png" height="20" width="20" alt=""> Tambah Data
                        </button>
                        <br><br>
                        <!--start modal-->
                        <div class="modal fade" id="tambahDataStok" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <div class="form-row">
                                                <div class="col">
                                                    Kode Barang
                                                    <input type="text" class="form-control" disabled placeholder="kode barang">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    Nama Barang
                                                    <select name="id_barang" id="" class="form-control">
                                                        <option value="">Pilih Nama Barang</option>
                                                        <?php
                                                            $query = mysqli_query($conn,"select id_barang, nama_barang from barang");
                                                            while ($data = mysqli_fetch_assoc($query)) {
                                                                echo "<option value='".$data['id_barang']."'>".$data['nama_barang']."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    Stok Barang
                                                    <input type="text" name="stok" class="form-control" placeholder="jumlah stok">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-row float-right">
                                                <div class="col-sm">
                                                    <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                                                </div>
                                                <div class="col-sm">
                                                    <input type="button" value="Batal" data-dismiss="modal" class="btn btn-outline-danger">
                                                </div>
                                            </div>
                                        </form>
                                        <?php
                                            if(isset($_POST['simpan'])){
                                                $id = "";
                                                $angka = 1;
                                                do{
                                                    if ($angka>=0 && $angka<=9) {
                                                        $id = "STOK-";
                                                        $id .= "00".$angka;
                                                    }elseif ($angka>=10 && $angka<=99) {
                                                        $id = "STOK-";
                                                        $id .= "0".$angka;
                                                    }else {
                                                        $id = "STOK-";
                                                        $id .= $angka;
                                                    }
                                                    $result = mysqli_query($conn,"select * from pemasukan where id_pemasukan='".$id."'");
                                                    $jumlah = mysqli_num_rows($result);
                                                    $angka++;
                                                } while ($jumlah>0);
                                                date_default_timezone_set('Asia/Jakarta');
                                                $waktu = date("Y-m-d H:i:s");
                                                $id_barang = $_POST['id_barang'];
                                                $stok = $_POST['stok'];
                                                $query = mysqli_query($conn, "insert into pemasukan values('".$id."','".$_SESSION['id']."','".$waktu."')");
                                                $query_detil = mysqli_query($conn, "insert into detil_pemasukan values('".$id_barang."','".$id."',".$stok.")");
//                                                echo "insert into pemasukan values('".$id."','".$_SESSION['id']."','".$waktu."')";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end modal-->

                        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover" border="0" id="example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id Barang</th>
                                    <th>Nama Barang</th>
                                    <!--                                    <th>Stok</th>-->
                                    <!--                                    <th>Stok masuk</th>-->
                                    <!--                                    <th>stok keluar</th>-->
                                    <th>stok akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                    $query = mysqli_query($conn,"select id_barang, nama_barang , stok from barang ");
                                    while ($data = mysqli_fetch_assoc($query)) {
                                        $query1 = mysqli_query($conn,"select ifnull(sum(stok_masuk),0) as masuk from detil_pemasukan where id_barang='".$data['id_barang']."'");
                                        $query2 = mysqli_query($conn,"select ifnull(sum(jumlah_jual),0) as keluar from detil_penjualan where id_barang='".$data['id_barang']."'");
                                        $masuk = mysqli_fetch_assoc($query1);
                                        $keluar = mysqli_fetch_assoc($query2);
                                        ?>
                                <tr>
                                    <td>
                                        <?php echo $no; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['id_barang']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['nama_barang']; ?>
                                    </td>

                                    <td>
                                        <?php echo ($data['stok']+$masuk['masuk'])-$keluar['keluar']; ?>
                                    </td>
                                </tr>
                                <?php

                                    $no++;
                                    }
                                ?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'js.php'; ?>
</body>

</html>
