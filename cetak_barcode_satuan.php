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

echo "<table>";
    echo "<tr>";
    echo "<td>";
    echo '<img style=" width:1500px;" src="data:image/png;base64,' . base64_encode($generator->getBarcode('BRG01', $generator::TYPE_CODE_128)) . '">';
                        echo '<p style="font-size:120px; text-align:center;">BRG01</p>';
echo "</td></tr>";
    
    echo "<tr>";
    echo "<td>";
    echo '<img style=" width:1500px;" src="data:image/png;base64,' . base64_encode($generator->getBarcode('BRG02', $generator::TYPE_CODE_128)) . '">';
                        echo '<p style="font-size:120px; text-align:center;">BRG02</p>';
echo "</td></tr>";
    echo "<tr>";
    echo "<td>";
    echo '<img style=" width:1500px;" src="data:image/png;base64,' . base64_encode($generator->getBarcode('BRG03', $generator::TYPE_CODE_128)) . '">';
                        echo '<p style="font-size:120px; text-align:center;">BRG03</p>';
echo "</td></tr>";
    
 echo "</table>";
?>
