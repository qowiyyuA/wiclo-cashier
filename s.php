<html>

<head>
</head>

<body>
    <?php 
    session_start();
//    $_SESSION["barang_barcode"] = strval(intval($_SESSION["barang_barcode"]["BRG01"]["jumlah_barang"])+30);
    echo json_encode($_SESSION["barang_barcode"]);
?>
</body>

</html>
