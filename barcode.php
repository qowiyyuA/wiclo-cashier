<?php
session_start();
include 'koneksi.php';
?>
<?php
    if ($_SESSION['id']==false) {
        header("Location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Baroode</title>

    <?php include 'css.php'; ?>
</head>

<body>
    <?php
        $jum = 0;
        if (isset($_POST["tambahbarang"])) {
        $_SESSION['id_transaksi_jual']=$_POST['id_transaksi'];
        $x = $_POST["id_barang"];
        $jumlah_cetak = $_POST["jumlah_barang"];
        $q = mysqli_query($conn, "select * from barang where ID_BARANG='" . $x . "'");
        // $q1 = mysqli_query($conn, "select * from detil_penjualan where ID_BARANG='" . $x . "'");
        while ($data = mysqli_fetch_assoc($q)) {
            // while($data = mysqli_fetch_assoc($q1)) {
            // $_SESSION['barang_barcode'][]
            $_SESSION["barang_barcode"][$x]["id_barang"] = $data["ID_BARANG"];
            $_SESSION["barang_barcode"][$x]["kode_barcode"] = $data["KODE_BARCODE"];
            $_SESSION["barang_barcode"][$x]["nama_barang"] = $data["NAMA_BARANG"];
//            $_SESSION["barang_barcode"][$x]["jumlah"] = $jumlah_cetak;
            // $_SESSION["barang_barcode"][$x]["jumlah_barang"] = 0;
            if($jum>0){
                echo $_SESSION["barang_barcode"][$x]["id_barang"]." == ".$x;
                echo "sama";
                $_SESSION["barang_barcode"][$x]["jumlah_barang"] = strval(intval($_SESSION["barang_barcode"][$x]["jumlah_barang"])+$jumlah_cetak);
                $jum = $_SESSION["barang_barcode"][$x]["jumlah_barang"];
                echo $jum;
            }else{
                // echo $_SESSION["barang_barcode"][$x]["id_barang"]." == ".$x;
                echo "tidak sama";
                $_SESSION["barang_barcode"][$x]["jumlah_barang"] = $jumlah_cetak;
                $jum = $jumlah_cetak;
                echo $jum;
            }
            $_POST["tambahbarang"] = "0";
        }
    }

        if (isset($_POST["hapus_barang"])) {
            $xx = $_POST["id_barang"];
            unset($_SESSION["barang_barcode"][$xx]);
            unset($_SESSION["total_harga_jual"]);
            $_POST["hapus_barang"] = "0";
        }
        if (isset($_POST["clear"])) {
            // SESSION_DESTROY();
            unset($_SESSION["barang_barcode"]);
            unset($_SESSION["grand_total_penjualan"]);
            unset($_SESSION["grand_total_akhir"]);
            unset($_SESSION['uang_bayar']);
            $_POST["clear"] = "0";
        }
        if (isset($_POST["simpan"]) && isset($_SESSION["barang_barcode"])) {
            date_default_timezone_set('Asia/Jakarta');
            $_POST["simpan"] = "0";
            $grand_total_penjualan = $_SESSION["grand_total_penjualan"];
            $total_harga_penjualan = $_SESSION["grand_total_penjualan"];
            $_SESSION['uang_bayar']=$_POST['uang_bayar'];
            $id_penjualan = $_SESSION["id_transaksi_jual"];
//

            header('Location:cetak_barcode.php');
        }

        $result1 = mysqli_query($conn, "SELECT count(*) as jum from detil_penjualan");
        $row = mysqli_fetch_assoc($result1);
        $jumlahrecord = "TR" . ($row["jum"] + 1);
        $_SESSION["id_transaksi_jual"] = $jumlahrecord;
//  echo '<meta http-equiv="refresh" content="0;url=tpenjualan.php"/>';
//  echo '<meta http-equiv="refresh" content="0;url=tpenjualan.php"/>';

    ?>
    <?php include 'navbar.php'; ?>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div style="overflow-y: scroll; height: 315px;">
                    <form method="POST">
                        <table class="table table-striped">
                            <?php if (isset($_SESSION["barang_barcode"])) { ?>
                            <thead class="position-static">
                                <tr>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Barang</th>
                                    <th scope="col">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
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
                                        <?php echo $_SESSION["barang_barcode"][$y]["jumlah_barang"]; ?>
                                    </td>

                                    <td style="width: 5%"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">X</button></td>
                                </tr>

                    </form>
                </div>

                <!-- Modal -->
                <div class="modal  fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pemberitahuan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" name="id_barang" value="<?php echo $y; ?>" hidden>
                                                Yakin ingin dihapus? kode
                                                <?php echo $y; ?>
                                            </div>
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <input type="submit" class="btn btn-block btn-sm btn-secondary" value="Tidak">
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="submit" name="hapus_barang" class="btn btn-block btn-sm btn-danger" value="Ya">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </tbody>
                    <?php } } else {?>
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <?php $total = 0 ?>
                            </td>
                        </tr>

                    </thead>
                    <?php } ?>
                    </table>
                </div>

                <!-- Modal -->

                <hr>

            </div>
            <div class="col-md-4">
                <form action="" method="POST">
                    <div class="form-group">
                        Kode Barang
                        <select name="id_barang" class="form-control" autofocus>

                            <?php
                            $query = mysqli_query($conn,"select * from barang");
                            while($data = mysqli_fetch_assoc($query)){?>
                            <option value="<?php echo $data['ID_BARANG']; ?>">
                                <?php  echo $data['NAMA_BARANG']; ?>
                            </option>
                            <?php
                            }
                          ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" class="form-control" name="jumlah_barang" placeholder="masukkan jumlah">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" hidden name="id_transaksi" placeholder="ID Transaksi" value="<?php echo $_SESSION['id_transaksi_jual'] ?>">
                    </div>

                    <!-- <div class="form-group">
                        <label for="">Barang</label>
                        <input type="text" class="form-control" name="nama_barang" placeholder="masukkan nama barang">
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah</label>
                        <input type="text" class="form-control" name="jumlah_barang" placeholder="masukkan jumlah barang">
                    </div> -->
                    <div class="form-group">
                        <!--                        <input type="submit" class="btn btn-success btn-block" name="tambahbarang" value="SIMPAN">-->
                        <button type="submit" name="tambahbarang" class="btn btn-success btn-block"><i class="fa fa-check fa-fw"></i> Tambah</button>
                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#myModalHapus"><i class="fa fa-trash fa-fw"></i>Hapus Rencana Cetak</button>
                    </div>
                    <!-- tambahbarang -->

                </form>


                <hr>
                <form action="" method="POST">

                    <div class="form-group">
                        <input type="submit" class="btn btn-outline-success btn-block" name="simpan" value="PROSES">

                    </div>

                </form>
            </div>
            <div class='modal fade' id='myModalHapus' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered' role="document">
                    <div class='modal-content'>
                        <form action='' method='post'>
                            <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal'>x</button>
                            </div>
                            <div class='modal-body'>
                                <center>
                                    <h4>
                                        Apakah Anda Ingin Menghapus Keranjang ?
                                    </h4>
                                </center>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-danger' data-dismiss='modal'><i class='fa fa-times fa-fw'></i> Batal</button>
                                <button type='submit' name='clear' class='btn btn-success'><i class='fa fa-trash fa-fw'></i> Hapus</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'js.php'; ?>
</body>

</html>
