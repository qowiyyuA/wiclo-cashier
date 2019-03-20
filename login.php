<?php include 'koneksi.php'?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Administrator</title>
    <?php include 'css.php'; ?>
</head>

<body>
    <br><br><br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 ">
            </div>
            <div class="col-sm-4 ">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        <h4>Log in to Cashier</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                Username
                                <input type="text" name="user" class="form-control" placeholder="Masukkan Username">
                            </div>
                            <div class="form-group">
                                Password
                                <input type="password" name="pass" class="form-control" placeholder="Masukkan Password">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="login" class="btn btn-success btn-block" value="Masuk">
                            </div>
                        </form>
                        <?php 
                            if(isset($_POST['login'])){
                                $user = $_POST['user'];
                                $pass = $_POST['pass'];

                                $query = mysqli_query($conn,"select * from pegawai where id_pegawai='".$user."' and password='".$pass."'");
                                $hasil = mysqli_num_rows($query);
                                if($hasil==1){
                                    while($data = mysqli_fetch_array($query)){
                                        $_SESSION['id'] = $data[0];
                                        $_SESSION['nama'] = $data[1];
                                        $_SESSION['status'] = $data[3];
                                        if($_SESSION['status']==="admin"){
                                            header("Location:index.php"); 
                                        }else{
                                            header("Location:penjualan.php");
                                        }                                       
                                    }
                                }else{
                                        echo "<script>alert('Login Gagal');</script>";
                                        header("Location:login.php");
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 ">
            </div>
        </div>
    </div>
    <?php include 'js.php'; ?>
</body>

</html>
