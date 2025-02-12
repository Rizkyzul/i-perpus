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
                    <h3 class="panel-title">Form Tambah Data User</h3>
                </div>
                <div class="panel-body">
                    <!--membuat form untuk tambah data-->
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                            <label for="username" class="col-sm-3 control-label">User Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="username" class="form-control" id="inputEmail3" placeholder="Inputkan Username" required>
                            </div>
                    </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="paswd" class="form-control" id="inputEmail3" placeholder="Inputkan Pasword" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" name="email" class="form-control" id="inputEmail3" placeholder="Inputkan Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="col-sm-3 control-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" class="form-control" id="inputEmail3" placeholder="Inputkan Nama" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="level" class="col-sm-3 control-label">Level</label>
                            <div class="col-sm-9">
                                <input type="text" name="levell" class="form-control" id="inputEmail3" placeholder="Inputkan Level" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ket" class="col-sm-3 control-label">Keterangan</label>
                            <div class="col-sm-9">
                                <input type="text" name="ket" class="form-control" id="inputEmail3" placeholder="Inputkan keterangan" >
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success">
                                    <span class="fa fa-save"></span> Simpan Data User</button>
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

<?php
if ($_POST) {
    
    $username = $_POST['username'];
    $paswd = $_POST['password'];
    $pwd_enkripsi = md5($paswd);
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $levell = (int)$_POST['levell'];
    $ket = $_POST['ket'];

    

    
        $sql = "INSERT INTO user (username, password, email, nama,  `level`, ket) 
                VALUES ('$username', '$pwd_enkripsi', '$email', '$nama', '$levell', '$ket')";
    

    $query = mysqli_query($koneksi, $sql) or die("SQL Simpan User Error: " . mysqli_error($koneksi));
    if ($query) {
        echo "<script>
                swal('Berhasil!', 'Data User berhasil ditambahkan.', 'success')
                .then(() => {
                    window.location.assign('?page=User&actions=tampil');
                });
              </script>";
    } else {
        echo "<script>
                swal('Gagal!', 'Data User gagal ditambahkan.', 'error');
              </script>";
    }
}
?>