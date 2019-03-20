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
    <title>Data User</title>

    <?php include 'css.php' ?>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card text-center">
                    <div class="card-body">
                        <button type="button" class="btn float-left btn-primary" data-toggle="modal" data-target="#tambahDataUser">
                            <img src="icon/Putih/2x/baseline_add_box_white_48dp.png" height="20" width="20" alt="">
                            Tambah Data
                        </button>
                        <br><br>
                        <!--start modal-->
                        <div class="modal fade" id="tambahDataUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <div class="form-row">
                                                <div class="col">
                                                    <label for="" class="float-left">Username</label>
                                                    <input type="text" name="username" class="form-control" placeholder="username">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <label for="" class="float-left">Nama User</label>
                                                    <input type="text" name="nama" class="form-control" placeholder="nama user">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <label for="" class="float-left">Password</label>
                                                    <input type="text" name="password" class="form-control" placeholder="password">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <label for="" class="float-left">Status</label>
                                                    <select name="status" id="" class="form-control">
                                                        <option value="admin">admin</option>
                                                        <option value="kasir">Kasir</option>
                                                    </select>
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
                                           
                                            $username = $_POST['username'];
                                            $nama_pegawai = $_POST['nama'];
                                            $password = $_POST['password'];
                                            $status = $_POST['status'];

                                            $query = mysqli_query($conn,"insert into pegawai values ('".$username."','".$nama_pegawai."','".$password."','".$status."')");
                                            // $cek = mysqli_fetch_row($query);
                                            if($query==1){
                                                ?>
                                        <meta http-equiv="refresh" content="0;url=user.php" />
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
                        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover" border="0" id="example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama User</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = mysqli_query($conn,"select * from pegawai");
                                $no = 1;
                                while ($data = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $no; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['NAMA_PEGAWAI']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['STATUS']; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#editUser<?php echo $data['ID_PEGAWAI']; ?>">Edit</button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#hapusUser<?php echo $data['ID_PEGAWAI']; ?>">Hapus</button>
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
                        $query = mysqli_query($conn,"select * from pegawai");
                        while($data = mysqli_fetch_assoc($query)){
                        ?>
                        <div class="modal fade" id="editUser<?php echo $data['ID_PEGAWAI'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <div class="form-row">
                                                <div class="col">
                                                    <label for="" class="float-left">Nama User</label>
                                                    <input hidden type="text" name="username" value="<?php echo $data['ID_PEGAWAI']; ?>" class="form-control" placeholder="nama user" readonly>
                                                    <input type="text" name="nama" value="<?php echo $data['NAMA_PEGAWAI']; ?>" class="form-control" placeholder="nama user" readonly>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <label for="" class="float-left">Status</label>
                                                    <select name="status" id="" class="form-control">
                                                        <?php
                                                            if($data['STATUS']=="admin"){
                                                        ?>
                                                        <option selected value="admin">admin</option>
                                                        <option value="kasir">Kasir</option>
                                                        <?php
                                                            }else if($data['STATUS']=="kasir"){
                                                        ?>
                                                        <option selected value="kasir">Kasir</option>
                                                        <option value="admin">admin</option>
                                                        <?php 
                                                            }else{
                                                                
                                                            }
                                                        ?>


                                                    </select>
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
                            $username = $_POST['username'];
                            $status = $_POST['status'];
                            $query = mysqli_query($conn,"update pegawai set STATUS='".$status."' where ID_PEGAWAI='".$username."'");
                            if($query==1){
                                ?>
                        <meta http-equiv="refresh" content="0;url=user.php" />
                        <?php
                            }else{

                            }
                        }
                        ?>

                        <!-- edit kategori -->

                        <!-- hapus kategori -->
                        <?php
                        $query = mysqli_query($conn,"select * from pegawai");
                        while($data = mysqli_fetch_assoc($query)){
                        ?>
                        <div class="modal fade" id="hapusUser<?php echo $data['ID_PEGAWAI'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <input type="text" hidden name="username" value="<?php echo $data['ID_PEGAWAI']; ?>" class="form-control" placeholder="username" readonly>
                                            <p>Apakah ingin menghapus user <b>
                                                    <?php echo $data['NAMA_PEGAWAI']; ?></b> ?</p>
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
                            $username = $_POST['username'];
                            $query = mysqli_query($conn,"delete from pegawai where ID_PEGAWAI='".$username."'");
                            if ($query==1) {
                                ?>
                    <meta http-equiv="refresh" content="0;url=user.php" />
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
