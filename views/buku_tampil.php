<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
<link rel="stylesheet" href="/style/all.css">
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

    <?php
    if (!isset($_SESSION['idsesi'])) {
        echo "<script> window.location.assign('../index.php'); </script>";
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading" >
                        <h3 class="panel-title"><span class="fa fa-user-plus"></span> Data Buku</h3>
                    </div>
                    <div class="panel-body">
                        <table id="deskripsi" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Gambar Buku</th>
                                    <th>Loker Buku</th>
                                    <th>Nama Pengarang</th>
                                    <!-- <th>Tahun Terbit</th> -->
                                    <th>Judul Buku</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //buat sql untuk tampilan data, gunakan kata kunci select
                                $sql = "SELECT * FROM buku";
                                $query = mysqli_query($koneksi, $sql) or die("SQL Anda Salah");
                                //Baca hasil query dari databse, gunakan perulangan untuk 
                                //Menampilkan data lebh dari satu. disini akan digunakan
                                //while dan fungdi mysqli_fecth_array
                                //Membuat variabel untuk menampilkan nomor urut
                                $nomor = 0;
                                //Melakukan perulangan u/menampilkan data
                                while ($data = mysqli_fetch_array($query)) {
                                    $nomor++; //Penambahan satu untuk nilai var nomor
                                    $id = $data['id']; // Ambil ID dari data
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $nomor ?></td>
                                        <td class="text-center"><img src="uploads/<?= $data['gambar_buku'] ?>" width="80px" height="80px" class="rounded"></td>
                                        <td><?= $data['judul_buku'] ?></td>
                                        <td><?= $data['nama_pengarang'] ?></td>
                                        <td><?= $data['loker_buku'] ?></td>
                                        <!--<td><? //= $data['tahun_terbit'] 
                                                ?></td>-->
                                        <td><?= $data['status'] ?></td>
                                        <td class="text-center">
                                            <a href="?page=buku&actions=detail&id=<?= $data['id'] ?>" class="btn btn-info btn-xs">
                                                <span class="fa fa-eye"></span>
                                            </a>
                                            <a href="?page=buku&actions=edit&id=<?= $data['id'] ?>" class="btn btn-warning btn-xs">
                                                <span class="fa fa-edit"></span>
                                            </a>
                                            <?php if ($data['status'] === 'Ada') { ?>
                                                <a href="?page=peminjaman&actions=tambah&judulbuku=<?= $data['judul_buku'] ?>" class="btn btn-info btn-xs">
                                                    <span class="fa fa-arrow-right"></span>
                                                </a>
                                            <?php } else { ?>
                                                <a href="#" class="btn btn-info btn-xs disabled">
                                                    <span class="fa fa-arrow-right"></span>
                                                </a>
                                            <?php } ?>
                                            <a href="#" onclick="confirmDelete(<?= $id ?>)" class="btn btn-danger btn-xs">
                                                <span class="fa fa-remove"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <!--Tutup Perulangan data-->
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <a href="?page=buku&actions=tambah" class="btn btn-info btn-sm">
                                            Tambah Data Buku
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

    <!-- Script untuk konfirmasi Delete -->
    <script>
        function confirmDelete(id) {
            swal({
                title: "Apakah Anda yakin ingin menghapus data buku ini?",
                text: "Anda akan kehilangan data buku ini.",
                icon: "warning",
                buttons: {
                    cancel: "Batal",
                    confirm: {
                        text: "Ya, Hapus!",
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: true
                    }
                },
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = '?page=buku&actions=delete&id=' + id;
                }
            });
        }
    </script>

    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'success') {
            echo "<script>
            swal({
                title: 'Berhasil!',
                text: 'Data buku berhasil dihapus.',
                icon: 'success',
            }).then(() => {
                // Hapus parameter status dari URL
                const url = new URL(window.location.href);
                url.searchParams.delete('status');
                window.history.replaceState(null, '', url);
            });
        </script>";
        } elseif ($_GET['status'] == 'error') {
            echo "<script>
            swal({
                title: 'Gagal!',
                text: 'Data buku tidak berhasil dihapus.',
                icon: 'error',
            }).then(() => {
                // Hapus parameter status dari URL
                const url = new URL(window.location.href);
                url.searchParams.delete('status');
                window.history.replaceState(null, '', url);
            });
        </script>";
        }
    }
    ?>