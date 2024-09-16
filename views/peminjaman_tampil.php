<?php
if (!isset($_SESSION['idsesi'])) {
    echo "<script> window.location.assign('../index.php'); </script>";
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">

<style>
     body {
            background-color: #072e33;
            color: #0f969c;
        }
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
                <div class="panel-heading" >
                    <h3 class="panel-title"><span class="fa fa-user-plus"></span> Riwayat Peminjaman</h3>
                </div>
                <div class="panel-body">
                    <table id="dtskripsi" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Judul Buku</th>
                                <th>Nama Peminjam</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Lama Pinjaman</th>
                                <th>Denda</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Ambil data dari database, dan tampilkan ke dalam tabel -->
                            <?php
                            // Buat sql untuk tampilan data, gunakan kata kunci select
                            $sql = "SELECT * FROM peminjaman";
                            $query = mysqli_query($koneksi, $sql) or die("SQL Anda Salah");

                            // Membaca hasil query dari database, gunakan perulangan untuk
                            // Menampilkan data lebih dari satu. Di sini akan digunakan
                            // while dan fungsi mysqli_fetch_array
                            // Membuat variabel untuk menampilkan nomor urut
                            $nomor = 0;

                            // Melakukan perulangan untuk menampilkan data
                            while ($data = mysqli_fetch_array($query)) {
                                $nomor++; // Penambahan satu untuk nilai variabel nomor

                                // Hitung denda jika ada keterlambatan
                                $denda = 0;
                                $maxLamaPinjam = 7; // Misal batas waktu pinjam 7 hari
                                $dendaPerHari = 1000; // Denda per hari keterlambatan

                                if (!empty($data['tgl_kembali'])) {
                                    $tglPinjam = strtotime($data['tgl_pinjam']);
                                    $tglKembali = strtotime($data['tgl_kembali']);
                                    $lamaPinjam = ($tglKembali - $tglPinjam) / (60 * 60 * 24);

                                    if ($lamaPinjam > $maxLamaPinjam) {
                                        $denda = ($lamaPinjam - $maxLamaPinjam) * $dendaPerHari;
                                    }
                                } else {
                                    $lamaPinjam = '-';
                                }
                            ?>
                                <tr>
                                    <td><?= $nomor ?></td>
                                    <td><?= $data['judul_buku'] ?></td>
                                    <td><?= $data['peminjam'] ?></td>
                                    <td><?= $data['tgl_pinjam'] ?></td>
                                    <td>
                                        <?php if (empty($data['tgl_kembali'])) : ?>
                                            &nbsp;<a href="?page=peminjaman&actions=kembaliBuku&judulbuku=<?= $data['judul_buku'] ?>" class="btn btn-info btn-xs">
                                                <span class="fa fa-forward"></span>
                                            </a>
                                        <?php else : ?>
                                            <?= $data['tgl_kembali'] ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $lamaPinjam ?> hari</td>
                                    <td><?= $denda > 0 ? "Rp " . number_format($denda, 0, ',', '.') : "-" ?></td>
                                    <td>
                                        <a href="?page=peminjaman&actions=detail&id=<?= $data['id'] ?>" class="btn btn-info btn-xs">
                                            <span class="fa fa-eye"></span>
                                        </a>
                                        <a href="#" onclick="alert('Untuk Memenuhi Laporan data Peminjaman ini tidak dapat dihapus.'); return false;" class="btn btn-danger btn-xs">
                                            <span class="fa fa-remove"></span>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Tutup Perulangan data -->
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>