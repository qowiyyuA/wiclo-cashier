<?php include 'koneksi.php' ?>
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
    <title>Document</title>


    <?php include 'css.php'; ?>


</head>

<body>
    <?php include 'navbar.php'; ?>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
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
                                                    $id = "KT-";
                                                    $id .= "00".$angka;
                                                }elseif ($angka>=10 && $angka<=99) {
                                                    $id = "KT-";
                                                    $id .= "0".$angka;
                                                }else {
                                                    $id = "KT-";
                                                    $id .= $angka;
                                                }
                                                $result = mysqli_query($conn,"select * from kategori where id_kategori='".$id."'");
                                                $jumlah = mysqli_num_rows($result);
                                                $angka++;
                                            } while ($jumlah>0);

                                            $nama_kategori = $_POST['nama'];
                                            $query = mysqli_query($conn,"insert into kategori values ('".$id."','".$nama_kategori."')");
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
                <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover" border="0"
                    id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Kategori</th>
                            <th>Nama Kategori</th>
                            <th>Jumlah Jenis Barang</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                                $query = mysqli_query($conn,"select k.id_kategori as id, k.nama_kategori as nama, count(b.id_barang) as jumlah from kategori k left join barang b on k.id_kategori=b.id_kategori group by k.id_kategori order by k.id_kategori asc");
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
            </div>
        </div>

    </div>
    <?php include 'js.php'; ?>
</body>

</html>