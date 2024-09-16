<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Jendela Ilmu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <link rel="stylesheet" href="style/beranda.css">
    <style>
    body {
            background-color: #072e33;
            color: #0f969c;
        }
</style>
</head>

<body style="background-color: #294D61">
    <div class="container mt-4">
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-info">
                    <strong>Selamat Datang di Sistem Informasi Perpustakaan Jendela Ilmu</strong>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Kolom kedua -->
            <div class="col-sm-9 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #072E33;">
                        <h3 class="panel-title" style="color: white;">Daftar Buku</h3>
                    </div>
                    <div class="panel-body" style="background-color: #052E33;">
                        <div class="row-flex" >
                            <?php
                            // Query untuk mengambil data buku
                            $sql = "SELECT * FROM buku";
                            $query = mysqli_query($koneksi, $sql) or die("SQL Anda Salah");

                            // Menampilkan data
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                                <div class="col-flex">
                                    <div class="card" >
                                        <img src="uploads/<?= $data['gambar_buku'] ?>" class="card-img-top" alt="<?= $data['judul_buku'] ?>">
                                        <div class="card-body" style="background-color: #6da5c0;">
                                        
                                            <h5 class="card-title" style="color:white;"><?= $data['judul_buku'] ?></h5>
                                            <p class="card-text"><strong>Pengarang:</strong> <?= $data['nama_pengarang'] ?></p>
                                            <p class="card-text"><strong>Tahun Terbit:</strong> <?= $data['tahun_terbit'] ?></p>
                                            <p class="card-text"><strong>Loker Buku:</strong> <?= $data['loker_buku'] ?></p>
                                            <p class="card-text"><strong>Status:</strong> <?= $data['status'] ?></p>
                                          
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>



            
            <!-- Akhir kolom kedua -->
            <div class="col-sm-3 col-xs-12">
                <?php if (isset($_GET['error'])) { ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            swal("Gagal!", "Login Gagal, Coba Lagi.", "error").then(() => {
                                setTimeout(() => {
                                    window.location.href = 'index.php';
                                }, 500);
                            });
                        });
                    </script>
                <?php } ?>

                <?php if (isset($_GET['success'])) { ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            swal("Berhasil!", "Login Berhasil.", "success").then(() => {
                                setTimeout(() => {
                                    window.location.href = 'index_admin.php';
                                }, 500);
                            });
                        });
                    </script>
                <?php } ?>

                <?php if (!isset($_SESSION['username'])) { ?>
                    <div class="panel panel-success">
                        <div class="panel-heading" style="background-color: #052E33;">
                            <h3 class="panel-title" style="color: white">Masuk Ke Sistem</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" action="proses_login.php" method="post">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" name="user" class="form-control input-sm" placeholder="Username" required="" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="password" name="pwd" class="form-control input-sm" placeholder="Password" required="" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" name="login" value="login" class="btn btn-success btn-block" style="background-color: #052E33;">
                                            <span class="fa fa-unlock-alt" ></span> Login Sistem
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</body>

</html>