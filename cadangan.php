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
    <title>Data Barang</title>


    <?php include 'css.php'; ?>


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
                                <a class="nav-link active" href="produk_barang.php">
                                    <h6>DATA BARANG</h6>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="produk_kategori.php">
                                    <h6>DATA KATEGORI</h6>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="produk_stok.php">
                                    <h6>DATA STOK</h6>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <button type="button" class="float-left btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            <img src="icon/Putih/2x/baseline_add_box_white_48dp.png" width="20" height="20" alt="">
                            Tambah Data
                        </button>

                        <!--start modal-->
                        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="DataBarang" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="DataBarang">Tambah Data Barang</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <div class="form-row">
                                                <div class="col">
                                                    Kode Barang
                                                    <input type="text" name="kode" class="form-control" placeholder="Kode barang">
                                                </div>
                                                <div class="col">
                                                    Nama Barang
                                                    <input type="text" name="nama" class="form-control" placeholder="Nama barang">
                                                </div>
                                                <div class="col">
                                                    Kategori Barang
                                                    <select name="kategori" id="" class="form-control">
                                                        <?php
                                                        $query = mysqli_query($conn,"select id_kategori,nama_kategori from kategori");
                                                        while($data = mysqli_fetch_assoc($query)){?>

                                                        <option value="<?php echo $data['id_kategori']; ?>">
                                                            <?php  echo $data['nama_kategori']; ?>
                                                        </option>
                                                        <?php
                                                        }

                                                        // edit

                                                      ?>
                                                        <!-- <option value="KT02">KT02</option> -->
                                                        <!-- <option value="KT03">KT03</option> -->
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <div class="col">
                                                    Satuan
                                                    <input type="text" name="satuan" class="form-control" placeholder="Satuan barang">
                                                </div>
                                                <div class="col">
                                                    Stok
                                                    <input type="text" name="stok" class="form-control" placeholder="Jumlah Stok">
                                                </div>
                                                <div class="col">
                                                    Harga
                                                    <input type="text" name="harga" class="form-control" placeholder="Harga Barang">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <div class="col">
                                                    Merk
                                                    <input type="text" name="merk" class="form-control" placeholder="Merk barang">
                                                </div>
                                                <div class="col">
                                                    Ukuran
                                                    <input type="text" name="ukuran" class="form-control" placeholder="ukuran barang">
                                                </div>
                                                <div class="col">
                                                    Warna
                                                    <input type="text" name="warna" class="form-control" placeholder="warna barang">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-row float-right">
                                                <div class="col-sm">
                                                    <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                                                </div>
                                                <div class="col-sm">
                                                    <input type="button" data-dismiss="modal" value="Batal" class="btn btn-outline-danger">
                                                </div>
                                            </div>
                                        </form>
                                        <?php
                                        if(isset($_POST['simpan'])){
                                          $kode = $_POST['kode'];
                                          $nama = $_POST['nama'];
                                          $kategori = $_POST['kategori'];
                                          $satuan = $_POST['satuan'];
                                          $stok = $_POST['stok'];
                                          $harga = $_POST['harga'];
                                          $ukuran = $_POST['ukuran'];
                                          $merk = $_POST['merk'];
                                          $warna = $_POST['warna'];
                                          $kode_warna = substr($warna,0,3);
                                          $harga_bagi = $harga/1000;
                                          $harga_k = $harga_bagi."K";
                                          $kode = $merk.",".$kategori.",".$kode_warna.",".$ukuran.",".$harga_k;

                                          $query=mysqli_query($conn,"insert into barang values('".$kode."','".$kategori."','".$nama."','".$merk."','".$ukuran."','".$warna."',".$stok.",'".$satuan."',".$harga.")");
                                          // echo "insert into barang values('".$kode."','".$kategori."','".$nama."','".$ukuran."','".$merk."',".$stok.",'".$satuan."',".$harga.")";
                                          // if($query==1){
                                          //   ?>
                                        //
                                        <!-- <meta http-equiv="refresh" content="0;url=produk_barang.php /"> -->
                                        //
                                        <?php
                                          // } else {
                                          //   echo "gagal";
                                          // }
                                        }
                                         ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end modal-->

                        <br><br>
                        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover" border="0" id="example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                    $query = mysqli_query($conn,"select b.id_barang as id, b.nama_barang as nama, k.nama_kategori as kategori, b.harga as harga from barang b join kategori k on b.id_kategori=k.id_kategori group by b.id_barang, k.nama_kategori, b.nama_barang, b.harga");
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
                                        <?php echo $data['kategori']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['harga']; ?>
                                    </td>
                                    <td>
                                        <a href="#edtiDatabarang<?php echo $data['id']; ?>" data-toggle="modal"><button class="btn btn-primary" data-target="#edtiDatabarang">Edit</button></a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#hapusDataBarang<?php echo $data['id']; ?>">Hapus</button>
                                    </td>

                                </tr>
                                <?php
                                    $no++;
                                    }
                                ?>

                            </tbody>
                        </table>
                        <!-- edit Barang -->
                        <?php
                        $query = mysqli_query($conn,"select b.id_barang as id, b.nama_barang as nama,k.id_kategori as id_kategori , k.nama_kategori as kategori, b.harga as harga, b.satuan as satuan, b.harga as harga, b.merk_barang as merk, b.ukuran_barang as ukuran from barang b join kategori k on b.id_kategori=k.id_kategori group by b.id_barang, k.nama_kategori, b.nama_barang, b.harga");
                        while($data = mysqli_fetch_assoc($query)){
                        ?>
                        <div class="modal fade" id="editDataBarang<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="DataBarang">Edit Data Barang</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <div class="form-row">
                                                <div class="col">
                                                    Kode Barang
                                                    <input type="text" name="kode" class="form-control" placeholder="kode barang" value="<?php echo $data['id'] ?>" readonly>
                                                </div>
                                                <div class="col">
                                                    Nama Barang
                                                    <input type="text" name="nama" class="form-control" placeholder="Nama barang" value="<?php echo $data['nama'] ?>">
                                                </div>
                                                <div class="col">
                                                    Kategori Barang
                                                    <select name="kategori" id="" class="form-control">
                                                        <?php

                                                        $kat = $data['id_kategori'];
                                                        $query1 = mysqli_query($conn,"select id_kategori,nama_kategori from kategori where id_kategori='".$kat."'");
                                                        while ($data1 = mysqli_fetch_assoc($query1)) {
                                                          ?>
                                                        <option selected value="<?php echo $data1['id_kategori']; ?>">
                                                            <?php  echo $data1['nama_kategori']; ?>
                                                        </option>
                                                        <?php
                                                          }


                                                          $query2 = mysqli_query($conn,"select id_kategori,nama_kategori from kategori where id_kategori !='".$kat."'");
                                                          while ($data2 = mysqli_fetch_assoc($query2)) {
                                                          ?>
                                                        <option value="<?php echo $data2['id_kategori']; ?>">
                                                            <?php  echo $data2['nama_kategori']; ?>
                                                        </option>
                                                        <?php
                                                          }
                                                          ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <div class="col">
                                                    Satuan
                                                    <input type="text" name="satuan" class="form-control" placeholder="Satuan barang" value="<?php echo $data['satuan'] ?>">
                                                </div>
                                                <div class="col">
                                                    Merk
                                                    <input type="text" name="merk" class="form-control" placeholder="Merk barang" value="<?php echo $data['merk'] ?>">
                                                </div>
                                                <div class="col">
                                                    Ukuran
                                                    <input type="text" name="ukuran" class="form-control" placeholder="ukuran barang" value="<?php echo $data['ukuran'] ?>">
                                                </div>
                                            </div>
                                            <br>

                                            <div class="form-row float-right">
                                                <div class="col-sm">
                                                    <input type="submit" name="update" value="Perbarui" class="btn btn-success">
                                                </div>
                                                <div class="col-sm">
                                                    <input type="button" data-dismiss="modal" value="Batal" class="btn btn-outline-danger">
                                                </div>
                                            </div>
                                        </form>
                                        <?php
                                        if(isset($_POST['update'])){

                                          $kode = $_POST['kode'];
                                          $nama = $_POST['nama'];
                                          $kategori = $_POST['kategori'];
                                          $satuan = $_POST['satuan'];
                                          $ukuran = $_POST['ukuran'];
                                          $merk = $_POST['merk'];

                                          $query=mysqli_query($conn,"update barang set nama_barang='".$nama."', id_kategori='".$kategori."', ukuran_barang='".$ukuran."', merk_barang='".$merk."', satuan='".$satuan."' where id_barang='".$kode."'");
                                          // echo "update barang set nama_barang='".$nama."', id_kategori='".$kategori."', ukuran_barang='".$ukuran."', merk_barang='".$merk."', satuan='".$satuan."' where id_barang='".$kode."'";
                                          // if($query==1){
                                          //   ?>
                                        //
                                        <!-- <meta http-equiv="refresh" content="0;url=produk_barang.php /"> -->
                                        //
                                        <?php
                                          // } else {
                                          //   echo "gagal";
                                          // }
                                        }
                                         ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }


                        ?>
                        <!-- hapus barang -->
                        <?php
                        $query = mysqli_query($conn,"select b.id_barang as id, b.nama_barang as nama, k.nama_kategori as kategori, b.harga as harga from barang b join kategori k on b.id_kategori=k.id_kategori group by b.id_barang, k.nama_kategori, b.nama_barang, b.harga");
                        while($data = mysqli_fetch_assoc($query)){
                        ?>
                        <div class="modal fade" id="hapusDataBarang<?php echo $data['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Barang</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <input type="text" hidden name="id" value="<?php echo $data['id']; ?>" class="form-control" placeholder="id barang" readonly>
                                            <p>Apakah ingin menghapus kategori <b>
                                                    <?php echo $data['nama']; ?></b> ?</p>
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
                            $query = mysqli_query($conn,"delete from barang where id_barang='".$id."'");
                            if ($query==1) {
                                ?>
                    <meta http-equiv="refresh" content="0;url=produk_barang.php" />
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
    <?php include 'js.php'; ?>
</body>

</html>
