<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Informasi Detail Peminjaman Buku</h3>
                </div>
                <div class="panel-body">
                    <!--Menampilkan data detail Buku-->
                    <?php
                    $sql = "SELECT * FROM peminjaman WHERE id='" . $_GET['id'] . "'";
                    //proses query ke database
                    $query = mysqli_query($koneksi, $sql) or die("SQL Detail error");
                    //Merubah data hasil query ke dalam bentuk array
                    //$data = mysqli_fetch_array($query);

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

                        <!--dalam tabel--->
                        <table class="table table-bordered table-striped table-hover">
                            <tr>
                                <td width="200">Judul Buku</td>
                                <td><?= $data['judul_buku'] ?></td>
                            </tr>
                            <tr>
                                <td>Nama Peminjam</td>
                                <td><?= $data['peminjam'] ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Pinjam</td>
                                <td><?= $data['tgl_pinjam'] ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Kembali</td>
                                <td><?= $data['tgl_kembali'] ?></td>
                            </tr>
                            <tr>
                                <td>Lama Pinjam</td>
                                <td><?= $lamaPinjam ?> hari</td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td><?= $data['keterangan'] ?></td>
                            </tr>
                            <tr>
                                <td>Denda</td>
                                <td><?= $denda > 0 ? "Rp " . number_format($denda, 0, ',', '.') : "-" ?></td>
                            </tr>
                        <?php } ?>
                        </table>
                </div> <!--end panel-body-->
                <!--panel footer-->
                <div class="panel-footer">
                    <a href="?page=peminjaman&actions=tampil" class="btn btn-success btn-sm">
                        Kembali ke Data Peminjaman
                    </a>
                </div>
                <!--end panel footer-->
            </div>
        </div>
    </div>
</div>