<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <script src="../bootstrap/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <!--   navigasi awal-->
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            Cashier
        </a>
        <span class="navbar-text">Dashboard {nama}</span>
        <a href="../login/login.php" class="btn btn-light btn-sm float-right"><img src='../icon/md-log-out.svg' width='18' height='18'> logout</a>
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
                            <li class="nav-item">
                                <a class="nav-link " href="../admin/produk.php"><img src="../icon/md-cube.svg" width="20" height="20" alt=""> Produk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="../admin/penjualan.php"><img src="../icon/md-cart.svg" width="20" height="20" alt=""> Kasir Penjualan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../admin/laporan.php"><img src="../icon/md-document.svg" width="20" height="20" alt=""> Laporan</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <div class="row">
            
        </div>
    </div>

    <br><br>

    <footer class="modal-footer bg-light">
        <div class="container">
            <div class="row">
                <div class="col">
                    &copy; 2018 Cashier - <span class="text-danger">Core</span>
                </div>
            </div>
        </div>

    </footer>

</body>

</html>
