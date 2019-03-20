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
    <title>Kasir</title>

    <?php include 'css.php'; ?>
</head>

<body>
    <?php
    if (isset($_POST["tambahbarang"])) {
        echo '<meta http-equiv="refresh" content="0;url=penjualan.php"/>';
        $_SESSION['id_transaksi_jual']=$_POST['id_transaksi'];
        $_SESSION['tgl_transaksi_jual']=$_POST['tgl_transaksi'];
        $x = $_POST["kode_barcode"];
        $q = mysqli_query($conn, "select * from barang where KODE_BARCODE='" . $x . "'");
        // $q1 = mysqli_query($conn, "select * from detil_penjualan where ID_BARANG='" . $x . "'");
        while ($data = mysqli_fetch_assoc($q)) {
            // while($data = mysqli_fetch_assoc($q1)) {
            // $_SESSION['barang_jual'][]
            $_SESSION["barang_jual"][$x]["id_barang"] = $data["ID_BARANG"];
            $_SESSION["barang_jual"][$x]["kode_barcode"] = $data["KODE_BARCODE"];
            $_SESSION["barang_jual"][$x]["id_kategori"] = $data["ID_KATEGORI"];
            $_SESSION["barang_jual"][$x]["nama_barang"] = $data["NAMA_BARANG"];
            $_SESSION["barang_jual"][$x]["harga_barang"] = $data["HARGA"];
            // $_SESSION["barang_jual"][$x]["jumlah_barang"] = 0;
            if($_SESSION["barang_jual"][$x]>=1){
//                echo $_SESSION["barang_jual"][$x]["id_barang"]." == ".$x;
//                echo "sama";
                $_SESSION["barang_jual"][$x]["jumlah_barang"] =$_SESSION["barang_jual"][$x]["jumlah_barang"]+1;
            }
            else{
                // echo $_SESSION["barang_jual"][$x]["id_barang"]." == ".$x;
                echo "tidak sama";
                $_SESSION["barang_jual"][$x]["jumlah_barang"] = 1;
            }
            $_POST["tambahbarang"] = "0";
        }
    }

        if (isset($_POST["hapus_barang"])) {
            $xx = $_POST["id_barang"];
            unset($_SESSION["barang_jual"][$xx]);
            unset($_SESSION["total_harga_jual"]);
            $_POST["hapus_barang"] = "0";
        }
        if (isset($_POST["clear"])) {
            // SESSION_DESTROY();
            unset($_SESSION["barang_jual"]);
            unset($_SESSION["grand_total_penjualan"]);
            unset($_SESSION["grand_total_akhir"]);
            unset($_SESSION['uang_bayar']);
            $_POST["clear"] = "0";
        }
        if (isset($_POST["simpan"]) && isset($_SESSION["barang_jual"])) {
            date_default_timezone_set('Asia/Jakarta');
            $_POST["simpan"] = "0";
            $grand_total_penjualan = $_SESSION["grand_total_penjualan"];
            $total_harga_penjualan = $_SESSION["grand_total_penjualan"];
            $_SESSION['uang_bayar']=$_POST['uang_bayar'];
            $id_penjualan = $_SESSION["id_transaksi_jual"];
            $tgl_penjualan = $_SESSION['tgl_transaksi_jual'];

            mysqli_query($conn, "INSERT into penjualan values('" . $id_penjualan . "','".$_SESSION['id']."','" . $tgl_penjualan . "'," . $total_harga_penjualan . ")");
            // mysqli_query($conn, "insert into penjualan values ('id_penjualan','kasir','tgl_penjualan','total_harga_penjualan','0','grand_total_penjualan')");
            // echo "INSERT into penjualan values('" . $id_penjualan . "','admin','" . $tgl_penjualan . "'," . $total_harga_penjualan . ",0," . $grand_total_penjualan . ")";

            foreach ($_SESSION["barang_jual"] as $yy => $yy_value) {
                $id_barang = $_SESSION["barang_jual"][$yy]["id_barang"];
                $nama = $_SESSION["barang_jual"][$yy]["nama_barang"];
                $jumlah_jual = $_SESSION["barang_jual"][$yy]["jumlah_barang"];
                $harga_barang = $_SESSION["barang_jual"][$yy]["harga_barang"];
                $subtotal = $_SESSION["barang_jual"][$yy]["harga_barang"] * $jumlah_jual;

                mysqli_query($conn, "INSERT into detil_penjualan values('" . $id_barang . "','" . $id_penjualan . "'," . $jumlah_jual . "," . $subtotal . ")");
                // mysqli_query($conn, "insert into detil_penjualan values('id_barang','id_penjualan','jumlah_jual','subtotal')");
                // echo "INSERT into detil_penjualan values('" . $id_barang . "','" . $id_penjualan . "'," . $jumlah_jual . "," . $subtotal . ")";
            }

            header('Location:cetak.php');
        }
        date_default_timezone_set('Asia/Jakarta');
        $kode = date("Ymd");
        $result1 = mysqli_query($conn, "SELECT count(*) as jum from penjualan where date(tgl_penjualan) = curdate()");
        $id;
        $row = mysqli_num_rows($result1);
        if ($row>=0 && $row<=9) {
            $id = "00".($row+1);
        }elseif ($row>=10 && $row<=99) {
            $id = "0".($row+1);
        }else {
            $id = ($row+1);
        }
        $_SESSION["id_transaksi_jual"] = $kode."".$id;
//        echo $_SESSION["id_transaksi_jual"];
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
                            <?php if (isset($_SESSION["barang_jual"])) { ?>
                            <thead class="position-static">
                                <tr>
                                    <th scope="col">Kode</th>
                                    <th scope="col">barcode</th>
                                    <th scope="col">Barang</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $total=0;
                            foreach($_SESSION["barang_jual"] as $y => $y_value){
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $_SESSION["barang_jual"][$y]["id_barang"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $_SESSION["barang_jual"][$y]["kode_barcode"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $_SESSION["barang_jual"][$y]["nama_barang"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $_SESSION["barang_jual"][$y]["jumlah_barang"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $_SESSION["barang_jual"][$y]["harga_barang"]; ?>
                                    </td>
                                    <td>
                                        <?php
                                    echo $_SESSION["barang_jual"][$y]["jumlah_barang"] * $_SESSION["barang_jual"][$y]["harga_barang"];
                                    $total = $total + $_SESSION["barang_jual"][$y]["jumlah_barang"] * $_SESSION["barang_jual"][$y]["harga_barang"];
                                    ?>
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
                            <th>Harga</th>
                            <th>Sub Total</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
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
                <div class="card">
                    <form method="POST">
                        <?php $_SESSION["grand_total_penjualan"] = $total;
                        if(isset($_SESSION['uang_bayar'])){
                        $_SESSION["grand_total_akhir"]=$_SESSION['uang_bayar']-$_SESSION['grand_total_penjualan'];
                        }else {
                        $_SESSION['grand_total_akhir']=0;
                        }?>
                        <div class="card-body">
                            <h1>TOTAL : Rp.
                                <label>
                                    <?php if (isset($_SESSION["grand_total_penjualan"])) {
                                echo $_SESSION["grand_total_penjualan"];
                            } else {
                                echo "0";
                            } ?>
                                </label>
                            </h1>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="">Kode</label>
                        <input type="text" class="form-control" autofocus name="kode_barcode" placeholder="masukan kode barang">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" hidden name="id_transaksi" placeholder="ID Transaksi" value="<?php echo $_SESSION['id_transaksi_jual'] ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" readonly name="tgl_transaksi" placeholder="Tanggal Transaksi" value="<?php if(isset($_SESSION['tgl_transaksi_jual'])){
                            echo $_SESSION['tgl_transaksi_jual'];
                        } else {
                            date_default_timezone_set('Asia/Jakarta');
                            echo date(" Y-m-d H:i:s"); } ?>">
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
                        <!-- <input type="submit" class="btn btn-success btn-block" name="tambahbarang" value="SIMPAN"> -->
                        <button type="submit" hidden name="tambahbarang" class="btn btn-success btn-block"><i class="fa fa-check fa-fw"></i> Tambah</button>
                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#myModalHapus"><i class="fa fa-trash fa-fw"></i>Hapus Keranjang</button>

                    </div>
                </form>

                <hr>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="">Bayar</label>
                        <input type="text" class="form-control" name="uang_bayar" placeholder="masukkan jumlah bayar">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-outline-success btn-block" name="simpan" value="PROSES">
                        <input type="text" style="margin-top:30px;" class="form-control" readonly name="grand_total" placeholder="hasil" value="<?php echo $_SESSION['grand_total_akhir']; ?>">
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
