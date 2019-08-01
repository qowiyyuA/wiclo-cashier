<?php
session_start();
include 'koneksi.php';

// $q = mysqli_query($conn,"update pegawai set LOGOUT_AT=now() where ID_PEGAWAI='".$_SESSION."'");
echo "<script>alert('Bye Bye $_SESSION[nama]');</script>";
session_destroy();
?>
<meta http-equiv="refresh" content="0;url=login.php" />
