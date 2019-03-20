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
                            <li class="nav-item">
                                <a class="nav-link" href="produk_warna.php">
                                    <h6>DATA WARNA</h6>
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
                                                  Merk
                                                  <input type="text" name="merk" class="form-control" placeholder="Merk barang">
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
                                                      ?>
                                                        <!-- <option value="KT02">KT02</option> -->
                                                        <!-- <option value="KT03">KT03</option> -->
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-row">
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
                                                  Kode Barang
                                                  <input type="text" name="kode" class="form-control" placeholder="Kode barang">
                                              </div>
                                                <div class="col">
                                                    Ukuran
                                                    <input type="text" name="ukuran" class="form-control" placeholder="ukuran barang">
                                                </div>
                                                <div class="col">
                                                    Warna
                                                    <select name="warna" id="" class="form-control">
                                                        <?php
                                                        $query = mysqli_query($conn,"select id_warna,nama_warna from warna");
                                                        while($data = mysqli_fetch_assoc($query)){?>

                                                        <option value="<?php echo $data['id_warna']; ?>">
                                                            <?php echo $data['nama_warna']; ?>
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
                                          $stok = $_POST['stok'];
                                          $harga = $_POST['harga'];
                                          $ukuran = $_POST['ukuran'];
                                          $merk = $_POST['merk'];
                                          $kod_merk = substr($merk,0,3);
                                          $warna = $_POST['warna'];
                                          $harga_bagi = $harga/1000;
                                          $harga_k = $harga_bagi."K";
                                          while ($data = mysqli_fetch_assoc($cek_kode_kategori)) {
                                            $kode_kategori = $data['kode_kategori'];
                                          }
                                          $kode_barcode = $kod_merk.".".$kategori.".".$warna.".".$ukuran.".".$harga_k;

                                          $query=mysqli_query($conn,"insert into barang values('".$kode."','".$kategori."','".$warna."','".$kode_barcode."','".$nama."','".$merk."','".$ukuran."','".$warna."',".$stok.",".$harga.")");
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
                                    <th>Barcode</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                    $query = mysqli_query($conn,"select b.id_barang as id, b.kode_barcode as barcode , b.nama_barang as nama, k.nama_kategori as kategori, b.harga as harga from barang b join kategori k on b.id_kategori=k.id_kategori group by b.id_barang, k.nama_kategori, b.nama_barang, b.harga");
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
                                        <?php echo $data['barcode']; ?>
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
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#editDataBarang<?php echo $data['id']; ?>">Detil</button>
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
                        $query = mysqli_query($conn,"select b.id_barang as id, b.id_warna as warna, b.nama_barang as nama,k.id_kategori as id_kategori , k.nama_kategori as kategori, b.harga as harga, b.harga as harga, b.merk_barang as merk, b.ukuran_barang as ukuran, b.warna as warna from barang b join kategori k on b.id_kategori=k.id_kategori group by b.id_barang, k.nama_kategori, b.nama_barang, b.harga");
                        while($data = mysqli_fetch_assoc($query)){
                        ?>
                        <div class="modal fade" id="editDataBarang<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="DataBarang">Detil Data Barang</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <div class="form-row">
                                                <div class="col">
                                                    Kode Barang
                                                    <input type="text" name="kode" readonly readonly value="<?php echo $data['id'] ?>" class="form-control" placeholder="Kode barang">
                                                </div>
                                                <div class="col">
                                                  Nama Barang
                                                  <input type="text" name="nama" readonly value="<?php echo $data['nama'] ?>" class="form-control" placeholder="Nama barang">
                                                </div>
                                            </div>
                                            <div class="form-row">

                                              <div class="col">
                                                  Merk
                                                  <input type="text" name="merk" readonly value="<?php echo $data['merk'] ?>" class="form-control" placeholder="Merk barang">
                                              </div>
                                                <div class="col">
                                                    Kategori
                                                    <select name="kategori" readonly id="" class="form-control">
                                                    <?php
                                                    $query_kategori = mysqli_query($conn,"select id_kategori,nama_kategori from kategori");
                                                    while($data_kategori = mysqli_fetch_assoc($query_kategori)){?>

                                                    <option <?php if($data_kategori['id_kategori']===$data['id_kategori']){ echo "selected";} ?> value="<?php echo $data1_kategori['id_kategori']; ?>">
                                                        <?php  echo $data_kategori['nama_kategori']; ?>
                                                    </option>
                                                    <?php
                                                    }
                                                  ?>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                              <div class="col">
                                                  Harga
                                                  <input type="text" name="harga" readonly readonly value="<?php echo $data['harga'] ?>" class="form-control" placeholder="Harga Barang">
                                              </div>
                                                <div class="col">
                                                    Ukuran
                                                    <input type="text" name="ukuran" readonly value="<?php echo $data['ukuran'] ?>" class="form-control" placeholder="ukuran barang">
                                                </div>
                                                <div class="col">
                                                    Warna
                                                    <select name="warna" readonly id="" class="form-control">
                                                    <?php
                                                    $query_warna = mysqli_query($conn,"select id_warna,nama_warna from warna");
                                                    while($data_warna = mysqli_fetch_assoc($query_warna)){?>

                                                    <option <?php if($data_warna['id_warna']===$data['warna']){ echo "selected";} ?> value="<?php echo $data_warna['id_warna']; ?>">
                                                        <?php  echo $data_warna['nama_warna']; ?>
                                                    </option>
                                                    <?php
                                                    }
                                                  ?>
                                                </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-row float-right">
                                                <!-- <div class="col-sm"> -->
                                                    <!-- <input type="submit" name="simpan" value="Simpan" class="btn btn-success"> -->
                                                <!-- </div> -->
                                                <div class="col-sm">
                                                    <input type="button" data-dismiss="modal" value="Batal" class="btn btn-outline-danger">
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
