<?php
$judulbuku = $_GET['judulbuku'];
$ambil = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE judul_buku ='$judulbuku'") or die("SQL Edit error");
$data = mysqli_fetch_array($ambil);
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Tanggal Kembali Pinjaman Buku</h3>
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
                                <input type="text" name="peminjam" value="<?= $data['peminjam'] ?>" class="form-control" id="peminjam" readonly="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tglPinjam" class="col-sm-3 control-label">Tanggal Pinjam</label>
                            <div class="col-sm-9">
                                <input type="text" name="tglPinjam" value="<?= $data['tgl_pinjam'] ?>" class="form-control" id="tglPinjam" readonly="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tglKembali" class="col-sm-3 control-label">Tanggal Kembali</label>
                            <div class="col-sm-3">
                                <input type="date" name="tglKembali" class="form-control" id="tglKembali" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success">
                                    <span class="fa fa-save"></span> Simpan Tanggal
                                </button>
                                <a href="?page=peminjaman&actions=tampil" class="btn btn-danger">
                                    <span class="fa fa-ban"></span> Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if ($_POST) {
    // Ambil data dari form
    $judulbuku = $_POST['judulbuku'];
    $tglPinjam = $data['tgl_pinjam'];
    $tglKembali = $_POST['tglKembali'];

    // Hitung lama pinjaman
    $lamaPinjam = (strtotime($tglKembali) - strtotime($tglPinjam)) / (60 * 60 * 24);

    // Hitung denda jika terlambat
    $maxLamaPinjam = 7; // Misal batas waktu pinjam 7 hari
    $dendaPerHari = 1000; // Denda per hari keterlambatan
    $denda = 0;

    if ($lamaPinjam > $maxLamaPinjam) {
        $denda = ($lamaPinjam - $maxLamaPinjam) * $dendaPerHari;
    }

    // Buat sql untuk menyimpan peminjaman
    $sql = "UPDATE peminjaman SET tgl_kembali='$tglKembali', lama_pinjam='$lamaPinjam' WHERE judul_buku='$judulbuku'";

    // Buat sql untuk mengubah status buku
    $sqlBuku = "UPDATE buku SET status='Ada' WHERE judul_buku='$judulbuku'";

    // Buat sql untuk menambahkan denda ke kas perpustakaan
    if ($denda > 0) {
        $sqlDenda = "INSERT INTO kas (jumlah, keterangan) VALUES ('$denda', 'Denda keterlambatan pengembalian buku $judulbuku')";
        $queryDenda = mysqli_query($koneksi, $sqlDenda) or die("SQL Simpan Denda Error: " . mysqli_error($koneksi));
    }

    $query = mysqli_query($koneksi, $sql) or die("SQL Simpan Data Buku Error: " . mysqli_error($koneksi));
    $queryBuku = mysqli_query($koneksi, $sqlBuku) or die("SQL Simpan Data Buku Error: " . mysqli_error($koneksi));

    if ($query && $queryBuku) {
        echo "<script>window.location.assign('?page=peminjaman&actions=tampil');</script>";
    } else {
        echo "<script>alert('Simpan Data Gagal');</script>";
    }
}
?>