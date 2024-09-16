<?php
$judulbuku = $_GET['judulbuku'];
$ambil = mysqli_query($koneksi, "SELECT * FROM buku WHERE judul_buku ='$judulbuku'") or die("SQL Edit error");
$data = mysqli_fetch_array($ambil);
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">

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
                    <h3 class="panel-title">Tambah Data Pinjaman Buku</h3>
                </div>
                <div class="panel-body">
                    <!--membuat form untuk tambah data-->
                    <form class="form-horizontal" action="" method="post">
                        <div class="form-group">
                            <label for="judulbuku" class="col-sm-3 control-label">Judul Buku</label>
                            <div class="col-sm-9">
                                <input type="text" name="judulbuku" value="<?= $data['judul_buku'] ?>" class="form-control" id="judulbuku" readonly="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="peminjam" class="col-sm-3 control-label">Nama Peminjam</label>
                            <div class="col-sm-9">
                                <input type="text" name="peminjam" class="form-control" id="peminjam" placeholder="Nama Peminjam" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tglPinjam" class="col-sm-3 control-label">Tanggal Pinjam</label>
                            <div class="col-sm-3">
                                <input type="date" name="tglPinjam" class="form-control" id="tglPinjam" required>
                            </div>
                        </div>

                        <div class="form-group" style="display: none;">
                            <label for="tglKembali" class="col-sm-3 control-label">Tanggal Kembali</label>
                            <div class="col-sm-3">
                                <input type="date" name="tglKembali" class="form-control" id="tglKembali">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ket" class="col-sm-3 control-label">Keterangan</label>
                            <div class="col-sm-9">
                                <input type="text" name="ket" class="form-control" id="ket" placeholder="Keterangan">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success">
                                    <span class="fa fa-save"></span> Simpan Peminjaman
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <a href="?page=buku&actions=tampil" class="btn btn-danger btn-sm">
                        Kembali Ke Data Buku
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if ($_POST) {
    // Ambil data dari form
    $judulbuku = $_POST['judulbuku'];
    $peminjam = $_POST['peminjam'];
    $tglPinjam = $_POST['tglPinjam'];
    $tglKembali = $_POST['tglKembali'];
    $ket = $_POST['ket'];

    // Hitung lama pinjaman
    $lamaPinjam = (strtotime($tglKembali) - strtotime($tglPinjam)) / (60 * 60 * 24);

    // Buat sql untuk menyimpan peminjaman
    $sql = "INSERT INTO peminjaman (judul_buku, peminjam, tgl_pinjam, tgl_kembali, lama_pinjam, keterangan) 
            VALUES ('$judulbuku', '$peminjam', '$tglPinjam', '$tglKembali', '$lamaPinjam', '$ket')";

    // Buat sql untuk mengubah status buku
    $sqlBuku = "UPDATE buku SET status='Buku Dipinjam!' WHERE judul_buku='$judulbuku'";

    $query = mysqli_query($koneksi, $sql) or die("SQL Simpan Peminjaman Error: " . mysqli_error($koneksi));
    $queryBuku = mysqli_query($koneksi, $sqlBuku) or die("SQL Simpan Data Buku Error: " . mysqli_error($koneksi));

    if ($query && $queryBuku) {
        echo "<script>
                swal('Berhasil!', 'Peminjaman Buku berhasil ditambahkan.', 'success')
                .then(() => {
                    window.location.assign('?page=peminjaman&actions=tampil');
                });
              </script>";
    } else {
        echo "<script>
                swal('Gagal!', 'Peminjaman Buku gagal ditambahkan.', 'error');
              </script>";
    }
}
?>