<?php

$sql = "SELECT *FROM user WHERE username ='" . $_GET['id'] . "'";
//proses query ke database
$query = mysqli_query($koneksi, $sql) or die("SQL Detail error");
//Merubaha data hasil query kedalam bentuk array
$data = mysqli_fetch_array($query);

if ($_POST) {
    $id = $_POST['username'];
    $password = $_POST['password'];
    $pwd_enkripsi = md5($password);
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $levell = (int)$_POST['level']; // Mengganti $level menjadi $levell
    $ket = $_POST['ket'];
    
    $sql = "UPDATE user SET username ='$id', passowrd='$pwd_enkripsi', email='$email', nama='$nama', `level`='$levell', ket='$ket' WHERE username ='$id'";

    // Execute the query
    $query = mysqli_query($koneksi, $sql) or die("SQL Edit Error");

    if ($query) {
        echo "<script>
            swal({
                title: 'Success!',
                text: 'Data User berhasil diubah.',
                icon: 'success',
                button: 'OK'
            }).then(function() {
                window.location.assign('?page=user&actions=tampil');
            });
        </script>";
    } else {
        echo "<script>
            swal({
                title: 'Error!',
                text: 'Edit Data Gagal.',
                icon: 'error',
                button: 'OK'
            });
        </script>";
    }
}
?>

<style>
     /* CSS untuk memposisikan tombol di tengah */
     .swal-footer {
        text-align: center;
    }
    .swal-button-container {
        display: inline-block;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Form Update Data User</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                        
                        <div class="form-group">
                            <label for="username" class="col-sm-3 control-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" name="username" value="<?= $data['username'] ?>" class="form-control" id="inputEmail3" placeholder="Username" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="paswd" value="<?= $data['paswd'] ?>" class="form-control" id="inputEmail3" placeholder="Pasword">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" name="email" value="<?= $data['email'] ?>" class="form-control" id="inputEmail3" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="col-sm-3 control-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control" id="inputEmail3" placeholder="Nama">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="level" class="col-sm-3 control-label">Level</label>
                            <div class="col-sm-9">
                                <input type="text" name="levell" value="<?= $data['level'] ?>" class="form-control" id="levell" placeholder="Level">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="col-sm-3 control-label">Keterangan</label>
                            <div class="col-sm-9">
                                <input type="text" name="ket" value="<?= $data['ket'] ?>" class="form-control" id="inputEmail3" placeholder="Keterangan">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success">
                                    <span class="fa fa-edit"></span> Update Data User
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="panel-footer">
                    <a href="?page=user&actions=tampil" class="btn btn-danger btn-sm">
                        Kembali Ke Data User
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
