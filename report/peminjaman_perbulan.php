<!DOCTYPE html>
<html>
    <head>
        <title>Cetak Data Peminjaman Buku Perbulan</title>
        <link href="../Assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body onload="print()">
        <!--Menampilkan data detail arsip-->
        <?php
        include '../config/koneksi.php';
        $ambilbln = $_POST['bulan'];
        $ambilthn = $_POST['tahun'];
        $bulanNama = '';
        if ($ambilbln == 12) {
            $bulanNama = "DESEMBER";
        } elseif ($ambilbln == 11) {
            $bulanNama = "NOVEMBER";
        } elseif ($ambilbln == 10) {
            $bulanNama = "OKTOBER";
        } elseif ($ambilbln == 9) {
            $bulanNama = "SEPTEMBER";
        } elseif ($ambilbln == 8) {
            $bulanNama = "AGUSTUS";
        } elseif ($ambilbln == 7) {
            $bulanNama = "JULI";
        } elseif ($ambilbln == 6) {
            $bulanNama = "JUNI";
        } elseif ($ambilbln == 5) {
            $bulanNama = "MEI";
        } elseif ($ambilbln == 4) {
            $bulanNama = "APRIL";
        } elseif ($ambilbln == 3) {
            $bulanNama = "MARET";
        } elseif ($ambilbln == 2) {
            $bulanNama = "FEBRUARI";
        } elseif ($ambilbln == 1) {
            $bulanNama = "JANUARI";
        }
        ?>

        <div class="container">
            <div class='row'>
                <div class="col-sm-12">
                    <!--dalam tabel-->
                    <div class="text-center">
                    <h2>Sistem Informasi Perpustakaan Jendela Ilmu </h2>
                    <h4>Jl. Perjuangan No.10B, Karyamulya, <br> Kec. Kesambi, Kota Cirebon, Jawa Barat 45135</h4>
                        <hr>
                        <h3>DATA PEMINJAMAN BUKU BULAN <?php echo "$bulanNama $ambilthn"; ?></h3>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th width="17%"><center>Judul Buku</center></th>
                                    <th width="10%"><center>Peminjam</center></th>
                                    <th width="14%"><center>Tanggal Pinjam</center></th>
                                    <th><center>Tanggal Kembali</center></th>
                                    <th><center>Lama Pinjam</center></th>
                                </tr>
                            </thead>
                            <tbody>
                            <!--ambil data dari database, dan tampilkan kedalam tabel-->
                            <?php
                            //buat sql untuk tampilan data, gunakan kata kunci select
                            $sql = "SELECT * FROM peminjaman WHERE substr(tgl_pinjam,1,7)='$ambilthn-$ambilbln'";
                            $query = mysqli_query($koneksi, $sql) or die("SQL Anda Salah");

                            //Baca hasil query dari database, gunakan perulangan untuk
                            //Menampilkan data lebih dari satu. disini akan digunakan
                            //while dan fungsi mysqli_fetch_array
                            //Membuat variabel untuk menampilkan nomor urut
                            $nomor = 0;

                            //Melakukan perulangan untuk menampilkan data
                            while ($data = mysqli_fetch_array($query)) {
                                $nomor++; //Penambahan satu untuk nilai var nomor
                                ?>
                                <tr>
                                    <td><?= $nomor ?></td>
                                    <td><?= $data['judul_buku'] ?></td>
                                    <td><?= $data['peminjam'] ?></td>
                                    <td><?= $data['tgl_pinjam'] ?></td>
                                    <td><?= $data['tgl_kembali'] ?></td>
                                    <td><?= $data['lama_pinjam'] ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="8" class="text-right">
                                    Cirebon, &nbsp <?= date("d-m-Y") ?>
                                    <br><br><br><br>
                                    <u>Kepala Perpustakaan<strong></u><br>
                                    +62 822 7277 7466
                                </td>
                              </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
