<?php session_start(); ?>
<html>

<head>
</head>

<body>
    <?php
include('php-barcode-generator/src/BarcodeGenerator.php');
include('php-barcode-generator/src/BarcodeGeneratorPNG.php');
include('php-barcode-generator/src/BarcodeGeneratorSVG.php');
include('php-barcode-generator/src/BarcodeGeneratorJPG.php');
include('php-barcode-generator/src/BarcodeGeneratorHTML.php');
//    $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
//$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
$generator = new Picqer\Barcode\BarcodeGeneratorJPG();
//$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
//echo $generator->getBarcode('BRG01', $generator::TYPE_CODE_128);

?>
    <table border="3">
        <?php
        $cek =1;
        foreach ($_SESSION["barang_barcode"] as $yy => $yy_value) {
            $id_barang = $_SESSION["barang_barcode"][$yy]["id_barang"];
            $barcode = $_SESSION["barang_barcode"][$yy]["kode_barcode"];
            $nama = $_SESSION["barang_barcode"][$yy]["nama_barang"];
            $jumlah_jual = $_SESSION["barang_barcode"][$yy]["jumlah_barang"];
                for($baris = 0; $baris< $jumlah_jual; $baris++){
                    if($cek==1){
                    ?>
        <tr>
            <td style="padding:150px;">
                <?php
                        echo '<img style=" width:1500px;" src="data:image/png;base64,' . base64_encode($generator->getBarcode($id_barang, $generator::TYPE_CODE_128)) . '">';
                        echo '<p style="font-size:120px; text-align:center;">'.$barcode.'</p>';
                    ?>
            </td>
            <?php
                        $cek++;
                    }else if($cek>1 && $cek<=3){
                    ?>
            <td style="padding:150px;">
                <?php
                        echo '<img style=" width:1500px;" src="data:image/png;base64,' . base64_encode($generator->getBarcode($id_barang, $generator::TYPE_CODE_128)) . '">';
                        echo '<p style="font-size:120px; text-align:center;">'.$barcode.'</p>';
                    ?>
            </td>
            <?php
                        $cek++;
                    }else{
                    ?>
            <td style="padding:150px;">
                <?php
                        echo '<img style=" width:1500px;" src="data:image/png;base64,' . base64_encode($generator->getBarcode($id_barang, $generator::TYPE_CODE_128)) . '">';
                        echo '<p style="font-size:120px; text-align:center;">'.$barcode.'</p>';
                    ?>
            </td>
        </tr>
        <?php
                        $cek = 1;
                    }
                }

        }

    ?>
        <tr>


        </tr>
    </table>
    <script>
        window.print();

    </script>
    <?php
   unset($_SESSION["barang_barcode"]);
            unset($_SESSION["data_tgl_jual"]);
            unset($_SESSION["kode_transaksi_jual"]);
            unset($_SESSION["datakasir"]);
            unset($_SESSION["nama_customer"]);
			unset($_SESSION["alamat_customer"]);
			unset($_SESSION["telp_customer"]);
            unset($_SESSION["total_harga_jual"]);
            unset($_SESSION["diskon_harga_jual"]);
            unset($_SESSION["grand_total_jual"]);
?>
</body>

</html>
