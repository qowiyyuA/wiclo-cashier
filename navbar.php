<!--   navigasi awal-->
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        Cashier
    </a>
    <span class="navbar-text">Dashboard {nama}</span>
    <a href="logout.php" class="btn btn-light float-right"><img src='icon/Hitam/2x/sharp_exit_to_app_black_48dp.png' width="20" height="20"> Logout</a>
</nav>

<!--    navigasi akhir-->
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <?php 
                                if ($_SESSION['status']=="admin") {
                                    ?>
                        <!--                        <img src="/open-iconic/svg/people.svg">-->
                        <li class="nav-item">
                            <a class="nav-link" href="index.php"><img src="open-iconic/svg/home.svg" width="17" height="17" alt=""> Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user.php"><img src="open-iconic/svg/people.svg" width="17" height="17" alt=""> User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="barcode.php"><img src="open-iconic/svg/people.svg" width="17" height="17" alt=""> Barcode</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="produk_barang.php"><img src="icon/Hitam/2x/baseline_apps_black_48dp.png" width="20" height="20" alt=""> Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="penjualan.php"><img src="icon/Hitam/2x/sharp_shopping_cart_black_48dp.png" width="20" height="20" alt=""> Kasir Penjualan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="penjualan_harian.php"><img src="icon/Hitam/2x/baseline_assignment_black_48dp.png" width="20" height="20" alt=""> Laporan</a>
                        </li>
                        <?php
                                }else if($_SESSION['status']==="kasir"){
                                    ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="penjualan.php"><img src="icon/Hitam/2x/sharp_shopping_cart_black_48dp.png" width="20" height="20" alt=""> Kasir Penjualan</a>
                        </li>
                        <?php
                                }
                            ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
