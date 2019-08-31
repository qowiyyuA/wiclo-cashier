<?php
session_start();
include 'koneksi.php';
?>
<html>

<body style="font-size:110px;">
    <?php
$total_harga_penjualan = $_SESSION["grand_total_penjualan"];
$kembalian = $_SESSION["grand_total_penjualan"];
$bayar = $_SESSION['uang_bayar'];
$id_penjualan = $_SESSION["id_transaksi_jual"];
$tgl_penjualan = $_SESSION['tgl_transaksi_jual'];


?>
    <table border="0" width="100%" style="font-size:100px;margin-top:160px;margin-buttom:260px">
        <tr style="text-align:center;">
            <td><img src="assets/img/logo-wiclo.jpeg"></td>
        </tr>
        
    </table>
    -------------------------------------------------
    <table width="100%" border="0" style="font-size:100px;margin-top:0px">
        <tr>
            <td width="25%">Transaksi</td>
            <td>:</td>
            <td>
                <?php echo $id_penjualan ?>
            </td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>
                <?php echo $tgl_penjualan ?>
            </td>
        </tr>
    </table>
    -------------------------------------------------
    <table width="100%" style="font-size:100px;">
        <tr>
            <td width="25%">Kasir</td>
            <td>:</td>
            <td>
                <?php echo $_SESSION['nama']; ?>
            </td>
        </tr>
    </table>
    -------------------------------------------------
    <br>
    <table width="100%" border="0" style="font-size:100px;text-align:center;">
        <tr>
            <td width="25%">Nama</td>
            <td width="25%">Harga</td>
            <td width="20%">Jumlah</td>
            <td width="30%">SubTotal</td>
        </tr>
        <?php foreach ($_SESSION["barang_jual"] as $yy => $yy_value) {
    $id_barang = $_SESSION["barang_jual"][$yy]["id_barang"];
    $nama = $_SESSION["barang_jual"][$yy]["nama_barang"];
    $jumlah_jual = $_SESSION["barang_jual"][$yy]["jumlah_barang"];
    $harga_barang = $_SESSION["barang_jual"][$yy]["harga_barang"];
    $subtotal = $_SESSION["barang_jual"][$yy]["harga_barang"] * $jumlah_jual;
    ?>
        <tr>
            <td width="25%">
                <?php echo $nama ?>
            </td>
            <td width="25%">
                <?php echo $harga_barang ?>
            </td>
            <td width="20%">
                <?php echo $jumlah_jual ?>
            </td>
            <td width="30%">
                <?php echo $subtotal ?>
            </td>
        </tr>
        <?php
    } ?>
    </table>
    -------------------------------------------------

    <table width="100%" border="0" style="font-size:100px;">
        <tr>
            <td width="60%" style="text-align:right;">Total</td>
            <td>:</td>
            <td>Rp. <?php echo $total_harga_penjualan ?></td>
        </tr>
        <tr>
            <td width="60%" style="text-align:right;">Bayar</td>
            <td>:</td>
            <td>Rp. <?php echo $bayar ?></td>
        </tr>
        <tr>
            <td width="60%" style="text-align:right;">Kembali</td>
            <td>:</td>
            <td>Rp. <?php echo $bayar-$total_harga_penjualan; ?></td>
        </tr>
    </table>
    -------------------------------------------------
    <table width="100%" border="0" style="font-size:100px;text-align:center;">
        <tr><td>Terima Kasih</td></tr>
    </table>

    <?php
    // unset($_SESSION["barang_jual"]);
    // unset($_SESSION["tgl_transaksi_jual"]);
    // unset($_SESSION["id_transaksi_jual"]);
    // unset($_SESSION["datakasir"]);
    // unset($_SESSION["total_harga_jual"]);
    // unset($_SESSION["grand_total_penjualan"]);
    ?>
    <script>
        window.print();
    </script>
</body>

</html>
