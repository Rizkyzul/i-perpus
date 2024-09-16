<!DOCTYPE html>
<html>

<head>
    <title>Laporan Peminjaman Buku</title>
    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <style>
    body {
            background-color: #072e33;
            color: #0f969c;
        }
</style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="fa fa-user-plus"></span> Laporan Peminjaman Buku</h3>
                    </div>
                    <div class="panel-body">
                        <table id="deskripsi" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th width="17%">Judul Buku</th>
                                    <th>Nama Peminjam</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Lama Pinjam</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Ambil data dari database, dan tampilkan kedalam tabel -->
                                <?php
                                // Buat sql untuk tampilan data, gunakan kata kunci select
                                $sql = "SELECT * FROM peminjaman";
                                $query = mysqli_query($koneksi, $sql) or die("SQL Anda Salah");

                                // Membaca hasil query dari database, gunakan perulangan untuk menampilkan data lebih dari satu
                                $nomor = 0; // Variabel untuk menampilkan nomor urut
                                while ($data = mysqli_fetch_array($query)) {
                                    $nomor++; // Penambahan satu untuk nilai variabel nomor
                                ?>
                                    <tr>
                                        <td><?= $nomor ?></td>
                                        <td><?= $data['judul_buku'] ?></td>
                                        <td><?= $data['peminjam'] ?></td>
                                        <td><?= $data['tgl_pinjam'] ?></td>
                                        <td><?= $data['tgl_kembali'] ?></td>
                                        <td><?= $data['lama_pinjam'] ?> hari</td>
                                        <td>
                                            <a href="report/peminjaman_satu.php?id=<?= $data['id'] ?>" target="_blank" class="btn btn-info btn-xs">
                                                <span class="fa fa-print"></span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <a href="report/peminjaman_semua.php" target="_blank" class="btn btn-info btn-sm">
                                            <span class="fa fa-print"></span> Cetak Semua Data
                                        </a>
                                        <a href="#cetak_perbulan" class="btn btn-info btn-sm">
                                            <span class="fa fa-print"></span> Cetak Perbulan
                                        </a>
                                        <a href="#cetak_pertahun" class="btn btn-info btn-sm">
                                            <span class="fa fa-print"></span> Cetak Pertahun
                                        </a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="cetak_perbulan" class="modalDialog">
        <div>
            <a href="#" title="Close" class="close">X</a>
            <form target="_blank" action="report/peminjaman_perbulan.php" method="post">
                <h4>Pilih bulan</h4>
                <select name="bulan" class="form-control">
                    <option value="12">Desember</option>
                    <option value="11">November</option>
                    <option value="10">Oktober</option>
                    <option value="09">September</option>
                    <option value="08">Agustus</option>
                    <option value="07">Juli</option>
                    <option value="06">Juni</option>
                    <option value="05">Mei</option>
                    <option value="04">April</option>
                    <option value="03">Maret</option>
                    <option value="02">Februari</option>
                    <option value="01">Januari</option>
                </select>
                <h4>Pilih tahun</h4>
                <select name="tahun" class="form-control">
                    <?php
                    for ($i = date("Y"); $i > date("Y") - 5; $i--) { ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>
                </select>
                <button type="submit">OK</button>
            </form>
        </div>
    </div>

    <div id="cetak_pertahun" class="modalDialog">
        <div>
            <a href="#" title="Close" class="close">X</a>
            <form target="_blank" action="report/peminjaman_pertahun.php" method="post">
                <h4>Pilih tahun</h4>
                <select name="tahun" class="form-control">
                    <?php
                    for ($i = date("Y"); $i > date("Y") - 5; $i--) { ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>
                </select>
                <button type="submit">OK</button>
            </form>
        </div>
    </div>
</body>

</html>