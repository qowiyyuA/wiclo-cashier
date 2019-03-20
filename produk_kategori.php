<?php include 'koneksi.php'; ?>
<?php session_start();?>
<?php
    if ($_SESSION['id']==false) {
        header("Location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Kategori</title>

    <?php include 'css.php' ?>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card text-center">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="produk_barang.php">
                                    <h6>DATA BARANG</h6>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="produk_kategori.php">
                                    <h6>DATA KATEGORI</h6>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="produk_stok.php">
                                    <h6>DATA STOK</h6>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="produk_warna.php">
                                    <h6>DATA WARNA</h6>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn float-left btn-primary" data-toggle="modal" data-target="#tambahDataKategori">
                            <img src="icon/Putih/2x/baseline_add_box_white_48dp.png" height="20" width="20" alt="">
                            Tambah Data
                        </button>
                        <br><br>
                        <!--start modal-->
                        <div class="modal fade" id="tambahDataKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kategori</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <div class="form-row">
                                                <div class="col">
                                                    <label for="" class="float-left">Nama Kategori</label>
                                                    <input type="text" name="nama" class="form-control" placeholder="kode kategori">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-row float-right">
                                                <div class="col-sm">
                                                    <input type="submit" value="Simpan" name="simpan" class="btn btn-success">
                                                </div>
                                                <div class="col-sm">
                                                    <input type="button" value="Batal" data-dismiss="modal" class="btn btn-outline-danger">
                                                </div>
                                            </div>
                                        </form>
                                        <?php
                                            if (isset($_POST['simpan'])) {
                                                $id = "";
                                            $angka = 1;
                                            do{
                                                if ($angka>=0 && $angka<=9) {
                                                    $id = "B-";
                                                    $id .= "00".$angka;
                                                }elseif ($angka>=10 && $angka<=99) {
                                                    $id = "B-";
                                                    $id .= "0".$angka;
                                                }else {
                                                    $id = "B-";
                                                    $id .= $angka;
                                                }
                                                $result = mysqli_query($conn,"select * from kategori where id_kategori='".$id."'");
                                                $jumlah = mysqli_num_rows($result);
                                                $angka++;
                                            } while ($jumlah>0);

                                            $nama_kategori = $_POST['nama'];
                                            $str = strtolower($_POST['nama']);
                                        		$panjang = strlen($str);
                                        		$arr1 = str_split($str);
                                        		$kode_kategori = substr($str,0,3);


                                            $query = mysqli_query($conn,"insert into kategori values ('".$id."','".$nama_kategori."','".$kode_kategori."')");
                                            // $cek = mysqli_fetch_row($query);
                                            if($query==1){
                                                ?>
                                        <meta http-equiv="refresh" content="0;url=produk_kategori.php" />
                                        <?php
                                                // echo "insert into kategori values ('".$id."','".$nama_kategori."')";
                                                // echo "berhasil";
                                            }else{
                                                // echo "insert into kategori values ('".$id."','".$nama_kategori."')";
                                                // echo "gagal";
                                            }
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--                        end modal-->
                        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover"
                            border="0" id="example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id Kategori</th>
                                    <th>Nama Kategori</th>
                                    <th>Jumlah</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = mysqli_query($conn,"select k.id_kategori as id, k.nama_kategori as nama, k.kode_kategori as kode, count(b.id_barang) as jumlah from kategori k left join barang b on k.id_kategori=b.id_kategori group by k.id_kategori order by k.id_kategori asc");
                                $no = 1;
                                while ($data = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $no; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['nama']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['jumlah']; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#editDataKategori<?php echo $data['id']; ?>">Edit</button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#hapusDataKategori<?php echo $data['id']; ?>">Hapus</button>
                                    </td>
                                </tr>
                                <?php
                                $no++;
                                }
                            ?>
                            </tbody>
                        </table>

                        <!-- edit kategori -->
                        <?php
                        $query = mysqli_query($conn,"select id_kategori, nama_kategori from kategori");
                        while($data = mysqli_fetch_assoc($query)){
                        ?>
                        <div class="modal fade" id="editDataKategori<?php echo $data['id_kategori'];?>" tabindex="-1"
                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Kategori</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <div class="form-row">
                                                <div class="col">
                                                    <label for="" class="float-left">Kode Kategori</label>
                                                    <input type="text" name="id" value="<?php echo $data['id_kategori']; ?>"
                                                        class="form-control" placeholder="kode kategori" readonly>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <label for="" class="float-left">Nama Kategori</label>
                                                    <input type="text" name="nama" value="<?php echo $data['nama_kategori']; ?>"
                                                        class="form-control" placeholder="nama kategori">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-row float-right">
                                                <div class="col-sm">
                                                    <input type="submit" value="Update" name="update" class="btn btn-success">
                                                </div>
                                                <div class="col-sm">
                                                    <input type="button" value="Batal" data-dismiss="modal" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }

                        if(isset($_POST['update'])){
                            $id = $_POST['id'];
                            $nama_kategori = $_POST['nama'];
                            $query = mysqli_query($conn,"update kategori set nama_kategori='".$nama_kategori."' where id_kategori='".$id."'");
                            if($query==1){
                                ?>
                        <meta http-equiv="refresh" content="0;url=produk_kategori.php" />
                        <?php
                            }else{

                            }
                        }
                        ?>

                        <!-- edit kategori -->

                        <!-- hapus kategori -->
                        <?php
                        $query = mysqli_query($conn,"select id_kategori, nama_kategori from kategori");
                        while($data = mysqli_fetch_assoc($query)){
                        ?>
                        <div class="modal fade" id="hapusDataKategori<?php echo $data['id_kategori'];?>" tabindex="-1"
                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Kategori</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <input type="text" hidden name="id" value="<?php echo $data['id_kategori']; ?>"
                                                class="form-control" placeholder="kode kategori" readonly>
                                            <p>Apakah ingin menghapus kategori <b>
                                                    <?php echo $data['nama_kategori']; ?></b> ?</p>
                                            <hr>
                                            <div class="form-row float-right">
                                                <div class="col-sm">
                                                    <input type="submit" value="Hapus" name="hapus" class="btn btn-success">
                                                </div>
                                                <div class="col-sm">
                                                    <input type="button" value="Batal" data-dismiss="modal" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                        if(isset($_POST['hapus'])){
                            $id = $_POST['id'];
                            $query = mysqli_query($conn,"delete from kategori where id_kategori='".$id."'");
                            if ($query==1) {
                                ?>
                    <meta http-equiv="refresh" content="0;url=produk_kategori.php" />
                    <?php
                            }else{
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include 'js.php' ?>
</body>

</html>
