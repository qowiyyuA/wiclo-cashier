<!DOCTYPE html>
<?php session_start(); ?>
<html>

<head>
    <title></title>
</head>

<body>
    <?php echo $_SESSION['query']; ?>
    <form method="post">
        <input type="month" name="t">
        <input type="submit" name="cek">
    </form>
    <?php 
        if(isset($_POST['cek'])){
            $hasil = $_POST['t'];
            echo $hasil;
        }
    ?>
    <label for="" class="float-left">Status</label>
    <select name="status" id="" class="form-control">
        <?php
        $data = "admin";
                                                            if($data===admin){
                                                        ?>
        <option selected value="admin">admin</option>
        <option value="pegawai">pegawai</option>
        <?php
                                                            }else if($data===pegawai){
                                                        ?>
        <option selected value="pegawai">pegawai</option>
        <option value="admin">admin</option>
        <?php 
                                                            }else{
                                                                
                                                            }
                                                        ?>


    </select>
</body>

</html>
