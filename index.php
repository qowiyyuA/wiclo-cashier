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
    <title>Beranda</title>

    <?php include 'css.php'; ?>
</head>

<body>

    <?php include 'navbar.php'; ?>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Data Barang</h5>
                        <?php 
                            $query = mysqli_query($conn, "select count(*) as jumlah from barang"); 
                            $data = mysqli_fetch_assoc($query);
                        ?>
                        <p class="card-text">Saat Ini Anda memiliki <b>
                                <?php echo $data['jumlah']; ?></b> Data Barang </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-wa bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Data Transaksi Hari ini</h5>
                        <?php 
                            $query = mysqli_query($conn, "select count(*) as jumlah from penjualan where tgl_penjualan = CURDATE()"); 
                            $data1 = mysqli_fetch_assoc($query);
                        ?>
                        <p class="card-text">Hari Ini Telah Terjadi <b>
                                <?php echo $data1['jumlah']; ?></b> Transaksi</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Data Transaksi Lusa</h5>
                        <?php 
                            date_default_timezone_set('Asia/Jakarta');
                            $hari = date("Y-m-d");
                            $query = mysqli_query($conn, "select count(*) as jumlah from penjualan where date(tgl_penjualan) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)"); 
                            $data1 = mysqli_fetch_assoc($query);
                        ?>
                        <p class="card-text">Hari Ini Telah Terjadi <b>
                                <?php echo $data1['jumlah']; ?></b>
                            Transaksi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'js.php'; ?>
</body>

</html>
