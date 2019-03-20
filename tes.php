<!DOCTYPE html>
<html>
<body>


	<form class="" action="" method="post">
		<input type="text" name="kategori" value="">
		<input type="submit" name="cek" value="Cek" >
	</form>
	<?php

	if (isset($_POST['cek'])) {
		$str = strtolower($_POST['kategori']);
		$panjang = strlen($str);
		$arr1 = str_split($str);
		$kode_kategori = "";
		for($ke = 0; $ke<$panjang; $ke++){
			if ($arr1[$ke]==="a") {
			}elseif ($arr1[$ke]==="i") {
			}elseif ($arr1[$ke]==="u") {
			}elseif ($arr1[$ke]==="e") {
			}elseif ($arr1[$ke]==="o") {
			}elseif ($arr1[$ke]===" ") {
			}else {
				$kode_kategori .= $arr1[$ke];
			}
		}echo $str."<br>";
		echo $kode_kategori;
	}

	?>

</body>
</html>
