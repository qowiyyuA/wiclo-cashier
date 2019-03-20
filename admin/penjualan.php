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
        <a href="../login/login.php" class="btn btn-light btn-sm float-right"><img src='../icon/Hitam/2x/sharp_exit_to_app_black_48dp.png' width='18' height='18'> logout</a>
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
                                <a class="nav-link active" href="../admin/penjualan.php"><img src="../icon/Hitam/2x/sharp_shopping_cart_black_48dp.png" width="20" height="20" alt=""> Kasir Penjualan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="../admin/produk_barang.php"><img src="../icon/Hitam/2x/baseline_apps_black_48dp.png" width="20" height="20" alt=""> Produk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../admin/laporan.php"><img src="../icon/Hitam/2x/baseline_assignment_black_48dp.png" width="20" height="20" alt=""> Laporan</a>
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
            <div class="col-md-8">
                <div style="overflow-y: scroll; height: 315px;">

                    <table class="table table-striped">
                        <thead class="position-static">
                            <tr>
                                <th scope="col">Kode</th>
                                <th scope="col">Barang</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col" colspan="2">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>kode</td>
                                <td>nama_barang</td>
                                <td>jumlah</td>
                                <td>harga</td>
                                <td style="width: 5%"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">X</button></td>
                            </tr>
                        </tbody>
                    </table>
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
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-6">
                                            Yakin ingin dihapus?
                                        </div>
                                        <div class="col-6">
                                            <form action="">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <input type="submit" class="btn btn-block btn-sm btn-secondary" value="Tidak">
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="submit" class="btn btn-block btn-sm btn-danger" value="Ya">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->

                <hr>
                <div class="card">
                    <div class="card-body">
                        <h1>TOTAL : Rp.<label>0</label></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <form action="">
                    <div class="form-group">
                        <label for="">Kode</label>
                        <input type="text" class="form-control" placeholder="masukkan kode barang">
                    </div>
                    <div class="form-group">
                        <label for="">Barang</label>
                        <input type="text" class="form-control" placeholder="masukkan nama barang">
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah</label>
                        <input type="text" class="form-control" placeholder="masukkan jumlah barang">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success btn-block" value="SIMPAN">
                    </div>
                </form>
                <hr>
                <form action="">
                    <div class="form-group">
                        <label for="">Bayar</label>
                        <input type="text" class="form-control" placeholder="masukkan jumlah bayar">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-outline-success btn-block" value="PROSES">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
